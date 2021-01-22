<div class="comment_post">
    <hr>
    <div class="post_option">
        <?php
            $post = new Post();
            if($post->i_own_post($COMMENT['postid'],$_SESSION['codeexchange_userid'])){
                echo"
                    <a href='delete.php?id= $COMMENT[postid] '>
                        Delete
                    </a>";      
            }
        ?>
    </div>

    <div class="post_profile">
        <a href="profile.php">
            <?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'] ?>
        </a>
    </div>

    <div class="post_content">
        <div id="description_sec">
            <?php echo nl2br(htmlspecialchars($COMMENT['post_description'])) ?>
        </div>
        <br>
        <div id="post_down_nav">
            <?php
                $likes = "";
                $likes = ($COMMENT['likes'] > 0) ? "(" .$COMMENT['likes']. ")"  : "";
            ?>
            <div id="nav">
                <a href="like.php?type=post&id=<?php echo $COMMENT['postid'] ?>">Like<?php echo $likes ?></a>
            </div>
        </div>
        <?php
        if($COMMENT['likes'] > 0){
            echo "<br>";
            echo "<a href='likes.php?type=post&id=$COMMENT[postid]'>";
            echo "<div id='wholikes'>";
            echo $COMMENT['likes']  . " people like this post";
            echo "</div>";
            echo "</a>";
        }

        ?>
    </div>
    <hr>
</div>
