<?php
// 发送邮件
// 参数：$to发送给谁，邮件地址
// $title邮件标题
// $msg邮件内容，支持HTML格式
function send_mail($to,$title,$msg){
	// vendor('PHPMailer.PHPMailerAutoload.php');
	vendor('PHPMailer.class#phpmailer');
	vendor('PHPMailer.class#smtp');
	$config = C('Think_Email');
	$mail = new PHPMailer;

    $mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $config['HOST'];  // Specify main and backup SMTP servers
	$mail->SMTPAuth = $config['SMTPAuth'];                               // Enable SMTP authentication
	$mail->Username = $config['USERNAME'];                 // SMTP username
	$mail->Password = $config['PASSWORD'];                           // SMTP password
	$mail->SMTPSecure = $config['SMTPSecure'];                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = $config['PORT'];                                    // TCP port to connect to

	$mail->setFrom($mail->Username,'段娜');
	$mail->addAddress($to,$to);   



	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $title;
	$mail->Body    = $msg;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
	    echo '发送失败: ' . $mail->ErrorInfo;
	} else {
	    echo '发送成功';
	}

}