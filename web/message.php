<?php
/*
 * message.php - 接收 HTTP POST Request ，檢查訊息內容，若是收到約定的訊息就用 E-Mail 寄出警告信通知使用者。
 *
 * Shiaobin 2015/01/31
 * */

// 引入 PHPMailer 函式庫
require 'PHPMailer/PHPMailerAutoload.php';

// 取得訊息
if (isset($_POST["message"]))
{
	$message = htmlspecialchars($_POST["message"]);
}
else
{
	$message = "";
}

// 檢查訊息，寄出警告信
if ($message === "1 intruder alert")
{
	$mail = new PHPMailer;
	$mail->CharSet = 'UTF-8';
	$mail->isSMTP();
	$mail->Host = 'msa.hinet.net';
	$mail->SMTPAuth = false;
	$mail->Port = 25;

	$mail->From = 'Shiaobin@shiaobin.com';
	$mail->FromName = 'Hackalert';
	$mail->addAddress('Shiaobin@gmail.com', 'Shiaobin');
	$mail->addAddress('mactzang0531@yahoo.com.tw');
	$mail->addReplyTo('Shiaobin@shiaobin.com', 'Shiaobin');

	$mail->isHTML(false);

	$mail->Subject = '入侵警報';
	$mail->Body    = '警告，發現入侵者！';

	// 若寄信失敗，顯示錯誤訊息
	if(!$mail->send())
	{
	    echo '4 Sending mail failed.\n';
	    echo 'PHPMailer error: ' . $mail->ErrorInfo;
	}
}
?>
