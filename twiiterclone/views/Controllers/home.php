<?php
// ホームコントローラー

// 設定を読み込み
include_once '../config.php';
// ユーザーデータ操作モデルを読み込み
include_once '../util.php';

// ログインしているか
$user = getUserSession();
if (!$user) {
    // ログインしていない
    header('Location:' . HOME_URL .'Controllers/sign-in.php');
    exit;
}

// 画面表示
$view_user = $user;

// ツイート一覧作成
// TODO:あとでDBから取得
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

include_once '../views/home.php';