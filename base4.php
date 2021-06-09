<?php 

// 変数とタイムゾーンを初期化
$auto_reply_subject =  null;
$auto_reply_text = null;
date_default_timezone_set('Asia/Tokyo');
// 件名を設定
$auto_reply_subject ='会員登録のお知らせ';
// 本文を設定
$auto_reply_text = "会員登録完了致しました。以下の情報で登録致します。\n";
$auto_reply_text .="氏名" . $_POST['your_name'] . "\n";
$auto_reply_text .="かな" . $_POST['your_kana'] . "\n";
$auto_reply_text .="電話" . $_POST['your_phone'] . "\n";
$auto_reply_text .="mail" . $_POST['email'] . "\n";
$auto_reply_text .="生まれ年" . $_POST['year'] . "\n";
$auto_reply_text .="性別" . $_POST['gender'] . "\n";
$auto_reply_text .="メールマガジン" . $_POST['want'] . "\n";
// メール送信
// mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text);



?>