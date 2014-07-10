<?php



	
	//check for user table
	//if it doesn't exist, create it (first time this script is run)


	


	
	//validation
	if(!isset($email)){
		
		$response = array("status"=>"fail", "resp"=>"Payment wasn't processed ");

		$jResponse = json_encode($response);
		echo($jResponse);
		
	}





	
		


	require 'class.phpmailer.php';

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'm@thecoded.com';                            // SMTP username
$mail->Password = 'reprapLife4029';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'm@thecoded.com';
$mail->FromName = 'the {c}0dEd';
//$mail->AddAddress('mariah@ppincjobs.com', 'Mariah');  // Add a recipient
$mail->AddAddress($email);               // Name is optional
$mail->AddReplyTo('m@thecoded.com', 'the {c}0dEd');
//$mail->AddCC('cc@example.com');
//$mail->AddBCC('bcc@example.com');

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'There was an issue processing acredit card';
$mail->Body    = 'Someone failed to pay for an order';
$mail->AltBody = 'Someone failed to pay for an order.';
if(!$mail->Send()) {
   //echo 'Message could not be sent.';
   //echo 'Mailer Error: ' . $mail->ErrorInfo;
   //exit;
}

//echo 'Message has been sent to'. $email;



	
	

?>