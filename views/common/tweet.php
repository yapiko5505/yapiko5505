<div class="tweet">
    <div class="user">
         <a href="profile.php?user_id=1">
             <img src="<?php echo buildImagePath($view_tweet['user_image_name'], 'user');?>" alt="">
         </a>
    </div>
    <div class="content">
        <div class="name">
            <a href="profile.php?user_id=<?php echo htmlspecialchars($view_tweet['user_id']); ?>">
                <span class="nickname"><?php echo htmlspecialchars($view_tweet['user_nickname']); ?></span>
                <span class="user-name">@<?php echo htmlspecialchars($view_tweet['user_name']); ?> ・<?php echo convertToDayTimeAgo($view_tweet['tweet_created_at'] ); ?></span>
            </a>
        </div>

        <p><?php echo htmlspecialchars($view_tweet['tweet_body']); ?></p>

        <?php if(isset($view_tweet['tweet_image_name'])): ?>
            <img src="<?php echo buildImagePath($view_tweet['tweet_image_name'], 'tweet') ?>" alt="" class="post-image">
        <?php endif; ?>
     
        <div class="icon-list">
            <div class= "like js-Like" data-like-id="<?php echo htmlspecialchars($view_tweet['Like_id']); ?>">
                <?php 
                    if (isset($view_tweet['Like_id'])) {
                        // いいねしている場合
                        echo '<img src="' .HOME_URL .'views\img\icon-heart-twitterblue.svg" alt="">';
                    } else {
                        echo '<img src="' .HOME_URL .'views\img\icon-heart.svg" alt="">';
                    }
                ?>
            </div>
            <div class="Like-count js-Like-count"><?php echo htmlspecialchars($view_tweet['Like_count']); ?></div>
        </div>
    </div>
</div>