<?php
///////////////////////////////////////
// プロフィールコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込み
include_once '../util.php';

// ユーザーデータ操作モデルを読み込む
include_once '../Models/users.php';
// ツイートデータ操作モデルを読み込む
include_once '../Models/tweets.php';

// ログインチェック
$user = getUserSession();
if (!$user) {
    // ログインしていない
    header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
    exit;
}
//------------------------
//ユーザー情報を変更
//------------------------
//ニックネームとユーザー名とメールアドレスが入力されている場合
if(isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['email'])) {
    $data = [
        'id' => $user['id'],
        'name' => $_POST['name'],
        'nickname' => $_POST['nickname'],
        'email' => $_POST['email'],
    ];
    //パスワードが入力されていた場合パスワード変更
    if(isset($_POST['password']) && $_POST['password'] !== ''){
        $data['password'] = $_POST['password'];
    }
    //ファイルがアップロードされていた場合->画像をアップロード
    if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
        $data['image_name'] = uploadImage($user, $_FILES['image'], 'user');
    }    
    //更新を実行し、成功した場合
    if(updateUser($data)){
        //更新後のユーザー情報をセッションに保存しなおす
        $user = findUser($user['id']);
        saveUserSession($user);
        //リロード
        header('Location: ' . HOME_URL . 'Controllers/profile.php');
    }
}

//------------------------
//表示するユーザーIDを取得(デフォルトはログインユーザー)
//------------------------
//URLにuser_idがある場合->それを対象ユーザーとする
$requested_user_id = $user['id'];
if(isset($_GET['user_id'])){
    $requested_user_id = $_GET['user_id'];
}

//----------------------
//表示用の変数
//---------------------
//ユーザー情報
$view_user = $user;
//プロフィール詳細を取得
$view_requested_user = findUser($requested_user_id, $user['id']);
// ツイート一覧
$view_tweets = findTweets($user, null, [$requested_user_id]);
// 画面表示
include_once '../Views/profile.php';

