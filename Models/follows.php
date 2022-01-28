<?php
/////////////////////////
///フォローデータを処理///
/////////////////////////
/**
 * フォローを作成
 *
 * @param array $data
 * @return int|false
 */
function createFollow(array $data)
{
    // DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続エラーがある場合->処理停止
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。:' . $mysqli->connect_error . "\n";
        exit;
    }
    //------------------------------
    //SQLクエリを作成(新規登録)
    //------------------------------
    $query = 'INSERT INTO follows (follow_user_id, followed_user_id) VALUES (?, ?)';
    $statement = $mysqli->prepare($query);

    //プレースホルダに値をセット
    $statement->bind_param('ii', $data['follow_user_id'], $data['followed_user_id']);
    //---------------------
    //戻り値を作成
    //---------------------
    //クエリを実行し、SQLエラーでない場合
    if($statement->execute()) {
        //戻り値用の変数にセット:インサートID(follows.id)
        $response = $mysqli->insert_id;
    } else {
        $response = false;
        echo 'エラーメッセージ :' . $mysqli->error . "\n";
    }
    //--------------------------
    //後処理
    //--------------------------
    //DB接続を開放
    $statement->close();
    $mysqli->close();

    return $response;
}


///
/**
 * フォローを取り消し
 *
 * @param array $data
 * @return bool
 */
function deleteFollow(array $data)
{
    // DB接続
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続エラーがある場合->処理停止
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。:' . $mysqli->connect_error . "\n";
        exit;
    }
    //更新日時を追加
    $data['updated_at'] = date('Y-m-d H:i:s');

    //-----------------------
    //SQLクエリを作成
    //-----------------------
    //論理削除のクエリを作成
    $query = 'UPDATE follows SET status = "deleted", updated_at = ? WHERE id = ? AND follow_user_id = ?';
    $statement = $mysqli->prepare($query); 

    //プレースホルダに値をセット
    $statement->bind_param('sii', $data['updated_at'], $data['follow_id'], $data['follow_user_id']);
    //---------------------
    //戻り値を作成
    //---------------------
    $response = $statement->execute();
     
    //SQLエラーの場合->エラー表示
    if($response === false) {
        echo 'エラーメッセージ :' . $mysqli->error . "\n";
    }
    
    //--------------------------
    //後処理
    //--------------------------
    //DB接続を開放
    $statement->close();
    $mysqli->close();

    return $response;
}