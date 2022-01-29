<?php
///////////////////////////////////////
// サインアップコントローラー
///////////////////////////////////////
 
// 設定を読み込み
include_once '../config.php';
// 便利な関数を読み込む
include_once '../util.php';
// ユーザーデータ操作モデルを読み込み
include_once '../Models/users.php';
 
// 登録項目がすべて入力されていれば
if (isset($_POST['nickname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $data = [
        'nickname' => $_POST['nickname'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];

    //----------------------
    //TODO:バリエーション
    //----------------------
    //文字数制限（すべての入力項目に対して行う）
    $length = mb_strlen($data['nickname']);
    if ($length < 1 || $length > 50){
        $error_messages[] = 'ニックネームは1~50文字にしてください';
    }//メールアドレス




    // ユーザーを作成し、成功すれば
    if (createUser($data)) {
        // ログイン画面に遷移
        header('Location: ' . HOME_URL . 'Controllers/sign-in.php');
        exit;
    }
}
 
// 画面表示
include_once '../Views/sign-up.php';