<?php
//****************************************************
// phpmailer サンプルコード
// SMTPサーバとは：https://www.kagoya.jp/howto/rentalserver/smtpserver/
// つまり本物のメールサーバへ認証させてメールを送信させる手法
// メールソフトのoutlookやthunderbirdなどもこういう設定を行い受信される
// 今回はPHP自信ががサーバへ認証を行い、送付する。
//****************************************************

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once( dirname( __FILE__ ).'/PHPMailer/src/PHPMailer.php' );
require_once( dirname( __FILE__ ).'/PHPMailer/src/Exception.php' );
require_once( dirname( __FILE__ ).'/PHPMailer/src/SMTP.php' );

$mail = new PHPMailer(true);

try {
    //送信先情報
    $to         = "nakatsuka@techis.jp";　//送信先アドレス
    $toname    = "送信先の名前";
    //smtp設定情報
    $username  = "○○○○○@gmail.com"; //取得した捨てGmail
    $useralias = "techis-Gmail";
    $password  = "qyxgmmwvjpzdbhqj"; //取得したアプリパスワード
    $subject = "テスト件名";
    $body = "\r\n"
        . "------------------------------\r\n"
        . "ここは本文です。\r\n"
        . "------------------------------\r\n"
        . "\r\n"
    ;
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

?>
