<?php   
function m_mail($dot_title,$dot_logo,$dot_smtpHost,$dot_smtpUsername,$dot_smtpPassword,$dot_smtpPort,$dot_SMTPorMAIL,$dot_TLSorSSL,$EmailUserEmail,$Emailsubject,$emailMessage){ 
	$header  = "MIME-Version: 1.0\r\n";
	$header .= "Mailer: ".$dot_title."\r\n";
	$headers = "From: ".$dot_smtpUsername."\r\n";
	$headers .= "Reply-To: ".$dot_smtpUsername."\r\n";
	$header .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
	 
	require_once('PHPMailer/PHPMailer.php');
    require_once('PHPMailer/SMTP.php');
    require_once('PHPMailer/Exception.php');
	
	$mail = new PHPMailer\PHPMailer\PHPMailer;
	  
	if($dot_SMTPorMAIL == 'mail'){
		$mail->IsMail();
	}else if($dot_SMTPorMAIL == 'smtp'){
		$mail->isSMTP();
		$mail->Host          = $dot_smtpHost; // Specify main and backup SMTP servers
		$mail->SMTPAuth      = true;
		$mail->SMTPKeepAlive = true;
		$mail->Username      = $dot_smtpUsername; // SMTP username
		$mail->Password      = $dot_smtpPassword; // SMTP password
		$mail->SMTPSecure    = $dot_TLSorSSL; // Enable TLS encryption, `ssl` also accepted
		$mail->Port          = $dot_smtpPort;
		$mail->SMTPOptions   = array(
		'ssl' => array(
		 'verify_peer' => false,
		 'verify_peer_name' => false,
		 'allow_self_signed' => true
		)
		);
	}else {
	   return false;
	}
	
	$mail->setFrom($dot_smtpUsername, $dot_title);
	$send          = false;
	$mail->CharSet = "UTF-8";	
	$mail->addAddress($EmailUserEmail);
	$mail->Subject = $Emailsubject;
	$mail->MsgHTML($emailMessage);
	$mail->IsHTML(true);
	$send = $mail->send();
	$mail->ClearAddresses();   
	echo 'sended';
}
?>