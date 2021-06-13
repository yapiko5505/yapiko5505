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
    <title>検索画面/twitterクローン</title>
    <meta name="discription" content="検索画面です">

</head>
<body class="home">
    <div class="container">
        <?php include_once('../views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>検索</h1>
                
            </div>

            <form action="search.php" method="get">
                <div class="search-area">
                    <input type="text" class="form-control" placeholder="キーワード検索" name="keyword" value="">
                    <button type="submit" class="btn">検索</button>
                </div>
            </form>

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