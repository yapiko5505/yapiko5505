<?php 
// ユーザーデータ処理

/**
 * ユーザーを作成
 * 
 * @param array $data
 * @return void
 */

function createUser(array $data) 
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続チェック
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。:' . $mysqli->connect_error . "\n";
        exit;
    }

    // 新規登録のSQLを作成
    $query = 'INSERT INTO users (email, name, nickname, password) VALUES (?, ?, ?, ?)';
    $statement =$mysqli->prepare($query);

    // パスワードをハッシュ値に変換
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    // ?の部分にセットする内容
    // 第一引数のsは変数の型を指定(s=string)
    $statement->bind_param('ssss', $data['email'], $data['name'], $data['nickname'], $data['password']);

    // 処理を実行
    $response = $statement->execute();
    if($response === false) {
        echo 'エラーメッセージ:'. $mysqli->error . "\n";
    }

    // 接続を解放
    $statement->close();
    $mysqli->close();

    return $response;
}


/**
 * ユーザー情報取得：ログインチェック
 * 
 * @param string $email
 * @param string $password
 * @return array|false
 */
function findUserAndCheckPassword(string $email, string $password) 
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // 接続チェック
    if ($mysqli->connect_errno) {
        echo 'MySQLの接続に失敗しました。:' . $mysqli->connect_error . "\n";
        exit;
    }

    // 入力値をエスケープ
    $email = $mysqli->real_escape_string($email);

    // クエリを作成
    // 
    $query = 'SELECT * FROM users WHERE email = "'.$email.'"';

    // SQL実行
    $result = $mysqli->query($query);
    if (!$result) {
        // MySQL処理中にエラー発生
        echo 'エラーメッセージ:'.$mysqli->error."\n";
        $mysqli->close();
        return false;
    }

    // ユーザー情報を取得
    $user = $result->fetch_array(MYSQLI_ASSOC);
    if(!$user) {
        // ユーザーが存在しない
        $mysqli->close();
        return false;
    }

    // パスワードチェック
    if(!password_verify($password, $user['password'])) {
        // パスワード不一致
        $mysqli->close();
        return false;
    }

    $mysqli->close();

    return $user;
}