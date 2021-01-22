<div class="post_body">
    <div class="post_content">
        <div class="user_name delete_username">
            <text>
                <a href="profile.php">
                    <h5><?php echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'] ?></h5>
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
    </div>
</div>