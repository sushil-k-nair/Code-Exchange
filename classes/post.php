<?php

class Post
{
    private $error = "";

    public function create_post($userid, $data)
    {
        if(!empty($data['post_title']))
        {
            $post_title = addslashes($data['post_title']);
            $post_description = addslashes($data['post_description']);
            $postid = $this->create_postid();
            $parent = 0;

            if(isset($data['parent']) && is_numeric($data['parent'])){
                $parent = $data['parent'];
            }
            
            $query = "insert into posts (postid,userid,post_title,post_description,parent) values ('$postid','$userid','$post_title','$post_description','$parent')";
        
            
            
            $DB = new Database();
            $DB->save($query);
        }else{
            $this->error .= "Please type something to post!<br>";
        }

        return $this->error;
    }

    public function post_comment($userid, $data)
    {
        if(!empty($data['post_comment']))
        {
            $post_description = addslashes($data['post_comment']);
            $postid = $this->create_postid();
            $parent = 0;
            $DB = new Database();

            if(isset($data['parent']) && is_numeric($data['parent'])){
                $parent = $data['parent'];
                $sql = "update posts set comments = comments + 1 where postid = '$parent' limit 1";
                $DB->save($sql);
            }
            
            $query = "insert into posts (postid,userid,post_description,parent) values ('$postid','$userid','$post_description','$parent')";
            $DB->save($query);
        }else{
            $this->error .= "Please type something to post!<br>";
        }

        return $this->error;
    }

    public function get_posts($id)
    {
        $query = "select * from posts where parent = 0 and userid = '$id' order by id desc limit 10";
        
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function get_comment($id)
    {
        $query = "select * from posts where parent = '$id' order by id asc limit 10";
        
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function get_one_post($postid)
    {
        
        if(!is_numeric($postid)){
            return false;
        }
        $query = "select * from posts where postid = '$postid' limit 1";
        
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function delete_post($postid)
    {
        if(!is_numeric($postid)){
            return false;
        }
        $DB = new Database();
        $sql = "select parent from posts where postid = '$postid' limit 1";
        $result = $DB->read($sql);
        if(is_array($result)){
           
            if($result[0]['parent'] > 0){

                $parent = $result[0]['parent'];
                $sql = "update posts set comments = comments - 1 where postid = '$parent' limit 1";
                $DB->save($sql);
            } 
        }
            
        $query = "delete from posts where postid = '$postid' limit 1";
        
        
        $DB->read($query);
    }

    public function i_own_post($postid,$codeexchange_userid)
    {
        
        if(!is_numeric($postid)){
            return false;
        }
        $query = "select * from posts where postid = '$postid' limit 1";
        
        $DB = new Database();
        $result = $DB->read($query);

        if(is_array($result)){
            if($result[0]['userid'] == $codeexchange_userid){
                return true;
            }
        }

        return false;
    }

    public function get_all_posts($id)
    {
        $query = "select * from posts where parent = 0 order by id desc limit 10";
        
        $DB = new Database();
        $result = $DB->read($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function get_likes($id,$type)
    {
        $DB = new Database;
        if($type == "post" && is_numeric($id)){

            //like details
            $sql = "select likes from likes where type = 'post' && contentid = '$id' limit 1";
            $result = $DB->read($sql);
            if(is_array($result)){
                $likes  = json_decode($result[0]['likes'], true);
                return  $likes;
            }
        }
        return false;
    }

    public function like_post($id,$type,$codeexchange_userid)
    {
        if($type == "post"){

            $DB = new Database;
            
            //add like details
            $sql = "select likes from likes where type = 'post' && contentid = '$id' limit 1";
            $result = $DB->read($sql);
            if(is_array($result)){
                $likes  = json_decode($result[0]['likes'], true);

                $user_ids = array_column($likes, "userid");

                if(!in_array($codeexchange_userid, $user_ids)){

                    $arr["userid"] = $codeexchange_userid;
                    $arr["date"] = date("Y-m-d H:i:s");

                    $likes[] = $arr;
                    $likes_string = json_encode($likes);
                    
                    $sql = "update likes set likes = '$likes_string' where type = 'post' && contentid = '$id' limit 1";
                    $DB->save($sql);

                    // adding post table
                    $sql = "update posts set likes = likes + 1 where postid = '$id' limit 1";
                    $DB->save($sql);
                }else{
                    $key = array_search($codeexchange_userid, $user_ids);
                    unset($likes[$key]);

                    $likes_string = json_encode($likes);
                    
                    $sql = "update likes set likes = '$likes_string' where type = 'post' && contentid = '$id' limit 1";
                    $DB->save($sql);

                    // adding post table
                    $sql = "update posts set likes = likes - 1 where postid = '$id' limit 1";
                    $DB->save($sql);

                }

            }else{
                $arr["userid"] = $codeexchange_userid;
                $arr["date"] = date("Y-m-d H:i:s");

                $arr2[] = $arr;
                $likes = json_encode($arr2);

                $sql = "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
                $DB->save($sql);

                // adding post table
                $sql = "update posts set likes = likes + 1 where postid = '$id' limit 1";
                $DB->save($sql);
            }

        }
    }

    private function create_postid()
    {
        $length = rand(4,19);
        $number = "";
        for ($i=0; $i < $length; $i++){
            $new_rand = rand(0,9);
            $number = $number . $new_rand;
        }
        return $number;
    } 
}

?>