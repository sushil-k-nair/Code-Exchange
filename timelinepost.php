<div class="post_sp">
    <div class="post_body">
        <div class="post_content">
            <div class="user_name">
                <text>
                    <a href="profile.php?id=<?php echo $ROW_USER['userid']; ?>">
                        <?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'] ?>
                    </a>
                </text>
            </div>
            <hr>
            <p>
                <?php echo htmlspecialchars($ROW['post_title']) ?>
            </p>
            <hr>
            <p>
                <?php echo nl2br(htmlspecialchars($ROW['post_description'])) ?>
            </p>
            <hr>
            <div class="lit_nav">
                <?php
                $likes = "";
                $likes = ($ROW['likes'] > 0) ? "(" . $ROW['likes'] . ")"  : "";
                ?>
                <div class="like">
                    <a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">Like<?php echo $likes ?></a>
                </div>

                <?php
                $comments = "";
                if ($ROW['comments'] > 0) {
                    $comments = "(" . $ROW['comments'] . ")";
                }
                ?>

                <div class="Comment">
                    <a href="single_post.php?type=post&id=<?php echo $ROW['postid'] ?>">Comment<?php echo $comments ?></a>
                </div>

                <div class="Delete">
                    <?php
                    $post = new Post();
                    if ($post->i_own_post($ROW['postid'], $_SESSION['codeexchange_userid'])) {
                        echo "
                    <a href='delete.php?id= $ROW[postid] '>
                        Delete
                    </a>";
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div class="user_likes">
                <?php
                if ($ROW['likes'] > 0) {
                    echo "<br>";
                    echo "<a href='likes.php?type=post&id=$ROW[postid]'>";
                    echo "<p>";
                    echo $ROW['likes']  . " people like this post";
                    echo "</p>";
                    echo "</a>";
                }
                ?>
            </div>
            <hr>
        </div>
    </div>
</div>