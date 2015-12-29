<?php
 	$message = "From : ".$_POST['vnama']."<br>E-mail : " . $_POST['vemail']."<br>Phone : "  . $_POST['vphone']."<br>Message :<br>"  . $_POST['vmessage'] ;
		
	require("../js/PHPMailer_5.2.0/class.phpmailer.php");

	$mail = new PHPMailer();

	$mail->Host = "mail.maxel.id"; // SMTP server
	$mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
	$mail->SMTPAuth = true;                  // enable SMTP authentication
	// sets the SMTP server
	$mail->Port = 587; 
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	//$mail->Username = "contact@kristalindobiolab.com";  // SMTP username
	$mail->Username = "liana@maxel.id";  // SMTP username
	$mail->Password = "liana123"; // SMTP password

	$mail->From = "liana@maxel.id";
	$mail->FromName = "MAXEL IT Solution";
	$mail->AddAddress("cleyra.ff9@gmail.com");                  // name is optional
	
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML

	$mail->Subject = "Contact Us";
	$mail->Body    = $message;

	if(!$mail->Send())
	{
	   echo "Message could not be sent. <p><br>Mailer Error: " . $mail->ErrorInfo;
	   exit;
	}else{
		echo "<script>alert('Message has been sent');window.location='../contact'</script>";
	}
?>