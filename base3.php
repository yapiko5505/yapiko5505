<?php
// var_dump($_POST);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once( dirname( __FILE__ ).'/PHPMailer/src/PHPMailer.php' );
require_once( dirname( __FILE__ ).'/PHPMailer/src/Exception.php' );
require_once( dirname( __FILE__ ).'/PHPMailer/src/SMTP.php' );

$mail = new PHPMailer(true);

try {
    //送信先情報
    $to         = "nakatsuka@techis.jp";//送信先アドレス
    $toname    = "テスト 太郎";
    //smtp設定情報
    $username  = "yapiko7725@gmail.com"; //取得した捨てGmail
    $useralias = "techis-Gmail";
    $password  = "mrbnpziaswzrazwb"; //取得したアプリパスワード
    $subject = "会員登録のお知らせ";
    $body = "会員登録完了致しました。以下の情報で登録致します。\n";
    $body = "氏名" . $_POST['your_name'] . "\n";
    $body = "かな" . $_POST['your_kana'] . "\n";
    $body = "電話" . $_POST['your_phone'] . "\n";
    $body = "mail" . $_POST['email'] . "\n";
    $body = "生まれ年" . $_POST['year'] . "\n";
    $body = "性別" . $_POST['gender'] . "\n";
    $body = "メールマガジン" . $_POST['want'] . "\n";
         "------------------------------\r\n"
    
    //メール送信
    $mail->SMTPDebug = 2; //デバッグ用
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = "utf-8";
    $mail->Encoding = "base64";
    $mail->setFrom($username , $useralias);
    $mail->addAddress($to, $toname);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    //送信開始
    $mail->send();
    echo '成功';
} catch (Exception $e) {
    echo '失敗: ', $mail->ErrorInfo;
}

// 変数の初期化
$page_flag = 0;
$clean = array();
$error = array();

// サニタイズ
if( !empty($_POST) ){
	var_dump($_POST);
	foreach( $_POST as $key => $value ) {
		$clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
	}

	var_dump($_POST);
}



if( !empty($_POST['btn_confirm']) ) { 

	$error = validation($clean);

	if( empty($error) ){
	$page_flag = 1;
	}

} elseif( !empty($_POST['btn_submit']) ) {
	// データベースに接続
	$mysqli = new mysqli( 'localhost', 'root', '', 'form1');

	// 接続エラーの確認
	if( $mysqli->connect_errno ) {
		$error_message[] = '書き込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
	} else {
		
		
		// 文字コード設定
		$mysqli->set_charset('utf8');
				
		// 書き込み日時を取得
		$now_date = date("Y-m-d H:i:s");
		
		// データを登録するSQL作成
		$sql = "INSERT INTO names (name, phone, email, year, gender, want)
		VALUES ('".$clean['your_name']."', '".$clean['your_phone']."', '".$clean['email']."',
		".$clean['year'].", '".$clean['gender']."', ".$clean['want'].")";
		
		// データを登録
		$res = $mysqli->query($sql);
	
		if( $res ) {
			$success_message = 'メッセージを書き込みました。';
		} else {
			$error_message[] = '書き込みに失敗しました。';
		}
	
		// データベースの接続を閉じる
		$mysqli->close();
	}
var_dump($res);

	$page_flag = 2;

}

function validation($data) {

	$error = array();

	// 氏名のバリデーション
	if( empty($data['your_name']) ) {
		$error[] = "「氏名」は入力してください。";

	} elseif( 20 < mb_strlen($data['your_name']) ) {
		$error[] = "「氏名」は20文字以内で入力してください。";
	}

	// カナのバリデーション
	if( empty($data['your_kana']) ) {
		$error[] = "「カナ」は入力してください。";

	} elseif( 20 < mb_strlen($data['your_kana']) ) {
		$error[] = "「カナ」は20文字以内で入力してください。";
	}

	// 電話のバリデーション
	if( empty($data['your_phone']) ) {
		$error[] = "「電話」は入力してください。";

	} elseif( !preg_match('/^[0-9]+$/',$data['your_phone']) ) {
		$error[] ="「電話」は数字で入力してください。";
	}
	

	// emailのバリデーション
	if( empty($data['email']) ) {
		$error[] = "「email」は入力してください。";

	} elseif( !preg_match( '/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['email']) ) {
		$error[] = "「email」はアルファベットを入力してください。";
	}

	return $error;
}


?>


<!DOCTYPE>
<html lang="ja">
<head>
<title>お問い合わせフォーム</title>
<style rel="stylesheet" type="text/css">
body {
	padding: 20px;
	text-align: center;
}

h1 {
	margin-bottom: 20px;
	padding: 20px 0;
	color: #209eff;
	font-size: 122%;
	border-top: 1px solid #999;
	border-bottom: 1px solid #999;
}

input[type=text] {
	padding: 5px 10px;
	font-size: 86%;
	border: none;
	border-radius: 3px;
	background: #ddf0ff;
}

input[name=btn_confirm],
input[name=btn_submit],
input[name=btn_back] {
	margin-top: 10px;
	padding: 5px 20px;
	font-size: 100%;
	color: #fff;
	cursor: pointer;
	border: none;
	border-radius: 3px;
	box-shadow: 0 3px 0 #2887d1;
	background: #4eaaf1;
}

input[name=btn_back] {
	margin-right: 20px;
	box-shadow: 0 3px 0 #777;
	background: #999;
}

.element_wrap {
	margin-bottom: 10px;
	padding: 10px 0;
	border-bottom: 1px solid #ccc;
	text-align: left;
}

label {
	display: inline-block;
	margin-bottom: 10px;
	font-weight: bold;
	width: 150px;
}

.element_wrap p {
	display: inline-block;
	margin:  0;
	text-align: left;
}

.error_list {
	padding: 10px 30px;
	color: #ff2e5a;
	font-size: 86%;
	text-align: left;
	border: 1px solid #ff2e5a;
	border-radius: 5px;
}

</style>
</head>
<body>
<h1>会員登録フォーム</h1>
<?php if ( $page_flag === 1 ): ?>

	<form method="post" action="">
	<div class="element_wrap">
		<label>名前</label>
		<p><?php echo $_POST['your_name']; ?></p>
	</div>
	<div class="element_wrap">
		<label>カナ</label>
		<p><?php echo $_POST['your_kana']; ?></p>
	</div>
	<div class="element_wrap">
		<label>電話</label>
		<p><?php echo $_POST['your_phone']; ?></p>
	</div>
	<div class="element_wrap">
		<label>mail</label>
		<p><?php echo $_POST['email']; ?></p>
	</div>
	<div class="element_wrap">
		<label>生まれ年</label>
		<p><?php echo $_POST['year']; ?></p>
	</div>
	<div class="element_wrap">
		<label>性別</label>
		<p><?php echo $_POST['gender']; ?></p>
	</div>
	<div class="element_wrap">
		<label>メールマガジン</label>
		<p><?php if( $_POST['want'] === "1" ){ echo '同意する'; }
		else{ echo '同意しない'; } ?></p>
	</div>

	<input type="submit" name="btn_submit" value="登録">
	<input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
	<input type="hidden" name="your_kana" value="<?php echo $_POST['your_kana']; ?>">
	<input type="hidden" name="your_phone" value="<?php echo $_POST['your_phone']; ?>">
	<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
	<input type="hidden" name="year" value="<?php echo $_POST['year']; ?>">
	<input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>">
	<input type="hidden" name="want" value="<?php echo $_POST['want']; ?>">
</form>

<?php elseif ( $page_flag === 2 ): ?>

<p>送信が完了しました。</p>

<?php else: ?>

<?php if ( !empty($error) ): ?>
	<ul class="error_list">
		<?php foreach ( $error as $value ): ?>
			<li><?php echo $value; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
<form method="post" action="">
	<div class="element_wrap">
		<label>名前</label>
		<input type="text" name="your_name" value="">
	</div>
    <div class="element_wrap">
	    <label>カナ</label>
	    <input type="text" name="your_kana" value="">
    </div>
    <div class="element_wrap">
	    <label>電話</label>
	    <input type="text" name="your_phone" value="">
    </div>
	<div class="element_wrap">
		<label>mail</label>
		<input type="text" name="email" value="">
	</div>
	<div class="element_wrap">
		<label>生まれ年</label>
		<select name="year">
		<option value="">-</option>
		<option value="1980">1980</option>
		<option value="1981">1981</option>
		<option value="1982">1982</option>
		<option value="1983">1983</option>
		<option value="1984">1984</option>
		<option value="1985">1985</option>
		<option value="1986">1986</option>
		<option value="1987">1987</option>
		<option value="1988">1988</option>
		<option value="1989">1989</option>
		<option value="1990">1990</option>
		<option value="1991">1991</option>
		<option value="1992">1992</option>
		<option value="1993">1993</option>
		<option value="1994">1994</option>
		<option value="1995">1995</option>
		<option value="1996">1996</option>
		<option value="1997">1997</option>
		<option value="1998">1998</option>
		<option value="1999">1999</option>
		<option value="2000">2000</option>
		<option value="2001">2001</option>
		<option value="2002">2002</option>
</select>
	</div>
    <div class="element_wrap">
	    <label>性別</label>
	    <input type="radio" name="gender" value="男性"> 男性
        <input type="radio" name="gender" value="女性"> 女性
    </div>
    <div class="element_wrap">
	    <label for = "want">
	    <input id = "want" type="checkbox" name="want" value="1">
		メールマガジン</label>
    </div>
	<input type="submit" name="btn_confirm" value="次へ">
</form>

<?php endif; ?>
</body>
</html>