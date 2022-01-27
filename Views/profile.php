<?php
//設定関連を読み込む
include_once('../config.php');
//便利な関数を読み込む
include_once('../util.php');

//////////////////////////////////
///////////ツイート一覧////////////
//////////////////////////////////
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
];

?>

<!DOCTYPE html>
<html lang="ja">
 
<head>
    <?php include_once('../Views/common/head.php'); ?>
    <title>プロフィール画面 / Twitterクローン</title>
    <meta name="description" content="プロフィール画面です">
</head>
 
<body class="home profile text-center">
    <div class="container">
        <?php include_once('../Views/common/side.php'); ?>
        <div class="main">
            <div class="main-header">
                <h1>初雪</h1>
            </div>
            <!-- プロフィール -->
            <div class="profile-area">
                <div class="top">
                    <div class="user"><img src="../Views/img_uploaded/user/sample-person.jpg" alt=""></div>

                    <?php if(isset($_GET['user_id'])) :?>
                        <!-- 相手のページ -->
                        <?php if(isset($_GET['case'])) :?>
                                <button class="btn btn-sm ">フォローを外す</button>
                            <?php else :?>
                                <button class="btn btn-sm btn-reverse">フォローする</button>
                            <?php endif; ?>
                        <?php else :?>
                        <!-- 自分のページ -->

                    <button class="btn btn-reverse btn-sm" data-bs-toggle="modal" data-bs-target="#js-modal">プロフィール編集</button>
                        <?php endif; ?>
                    <div class="modal fade" id="js-modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="profile.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title">プロフィールを編集</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="user">
                                            <img src="../Views/img_uploaded/user/sample-person.jpg" alt="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="mb-1">プロフィール写真</label>
                                            <input type="file" class="form-control form-control-sm" name="image">
                                        </div>

                                        <input type="text" class="form-control mb-4" name="nickname" value="初雪" placeholder="ニックネーム" maxlength="50" required autofocus>
                                        <input type="text" class="form-control mb-4" name="name" value="hatuyuki" placeholder="ユーザー名、例)tarou123" maxlength="50" required>              
                                        <input type="email" class="form-control mb-4" name="emall" value="hatuyuki@gmail.jp" placeholder="メールアドレス" maxlength="254" required>                
                                        <input type="password" class="form-control mb-4" name="password" value="" placeholder="パスワードを変更する場合は入力してください" minlength="4" maxlength="128" required>
                                    </div>               
                                    
                                    <div class="modal-footer">
                                        <button class="btn btn-reverse" data-bs-dismiss="modal">キャンセル</button>
                                        <button class="btn" type="submit">保存する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="name">初雪</div>
                <div class="text-muted">@hatuyuki</div>

                <div class="follow-follower">
                    <div class="follow-count">1</div>
                    <div class="follow-text">フォロー中</div>
                    <div class="follow-count">1</div>
                    <div class="follow-text">フォロワー</div>
                </div>
            </div>
            
            <!-- 仕切りエリア -->
            <div class="ditch"></div>
            
            <!-- つぶやき一覧エリア -->
            <?php if (empty($view_tweets)) : ?>
                <p class="p-3">ツイートがありません</p>
            <?php else: ?>
                <div class="tweet-list">
                    <?php foreach($view_tweets as $view_tweet):?>
                        <?php include('../Views/common/tweet.php'); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include_once('../Views/common/foot.php'); ?>
</body>
 
</html>
