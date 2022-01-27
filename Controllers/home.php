<?php
///////////////////////////////////////
// ホームコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';

// ログインチェック
$user = getUserSession();
if (!$user) {
    // ログインしていない
    header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
    exit;
}
 
// 表示用の変数
$view_user = $user;
// ツイート一覧
// TODO: モデルから取得する
$view_tweets=[
    [
        'user_id' => 1,
        'user_name' => '初雪',
        'user_nickname' => '@hatuyuki',
        'user_image_name' => 'sample-person.jpg',
        'tweet_body' => 'いまプログラミングをしていますyowwww',
        'tweet_image_name' => null,
        'tweet_created_at' => '2022-01-14 22:00:00',
        'like_id' => null,
        'like_count' => 0,    
    ],
    [
        'user_id' => 2,
        'user_name' => 'ゆき',
        'user_nickname' => '@yuki',
        'user_image_name' => null,
        'tweet_body' => 'コワーキングスペースをオープンしましたwwwww',
        'tweet_image_name' => 'sample-post.jpg',
        'tweet_created_at' => '2022-01-04 14:00:00',
        'like_id' => 65,
        'like_count' => 65,  
    ]
];

// 画面表示
include_once '../Views/home.php';

