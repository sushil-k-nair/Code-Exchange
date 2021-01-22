<?php

class Profile
{
    function get_profile($id){
        $DB = new Database();
        $query = "select * from users where userid = '$id' limit 1";
        return $DB->read($query);
         
    }
}