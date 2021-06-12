<?php
// 設定関連を読み込む
include_once('../config.php');
// 便利な関数を読み込む
include_once('../util.php');

// ツイート一覧作成
$view_tweets = [
    [
        'user_id' => 1,
        'user_name' =>'taro',
        'user_nickname' =>'太郎',
        'user_image_name' => '\sample-person.jpg',
        'tweet_body' => '今プログラミングをしています。',
        'tweet_image_name' => null,
        'tweet_created_at' => '2021-03-15 14:00:00',
        'Like_id' => null,
        'Like_count' => 0,
    ],

    [
        'user_id' => 2,
        'user_name' =>'jiro',
        'user_nickname' =>'次郎',
        'user_image_name' => null,
        'tweet_body' => 'コワーキングスペースをオープンしました!',
        'tweet_image_name' => 'sample-post.jpg',
        'tweet_created_at' => '2021-03-14 14:00:00',
        'Like_id' => 1,
        'Like_count' => 1,
    ],
];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    
    <?php include_once('../views/common/head.php'); ?>
    <title>ホーム画面/twitterクローン</title>
    <meta name="discription" content="ホーム画面です">

</head>
<body class="home">
    <div class="container">
        <?php include_once('../views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>ホーム</h1>
                
            </div>
            <div class="tweet-post">
                <div class="my-icon">
                    <img src="<?php echo HOME_URL; ?>views\img_uploaded\user\sample-person.jpg" alt="">
                </div>
                <div class="input-area">
                    <form action="post.php" method="post" enctype="multipart/form-data">
                        <textarea name="body" placeholder="いまどうしてる？" maxlength="140"></textarea>
                        <div class="bottom-area">
                            <div class="mb-0">
                                <input type="file" name="image" class="form-control form-control-sm">
                            </div>
                            <button class="btn" type="submit">つぶやく</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="ditch"></div>

            <?php if (empty($view_tweets)): ?>
                <p class="p-3">ツイートがまだありません</p>
            <?php else: ?>
                <div class="tweet-list">
                    <?php foreach ($view_tweets as $view_tweet): ?>
                        <?php include('../views/common/tweet.php'); ?>
                    <?php endforeach; ?>

                </div>
            <?php endif;?>
        </div>
    </div>

    <?php include_once('../views/common/foot.php'); ?>
</body>

</html>