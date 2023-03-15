<?php
include('db.php');
include('smtp/PHPMailerAutoload.php');
if(isset($_POST['id']) && $_POST['id']>0){
	$id=mysqli_real_escape_string($con,$_POST['id']);
	$res=mysqli_query($con,"select * from email_list where send='0' and id='$id'");
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		$email=$row['email'];
		$html="Hi Hello. <img src='TRACKLINK/track.php?id=$id' width='1px' height='1px'/>";
		smtp_mailer($email,'Test', $html);
		mysqli_query($con,"update email_list set send=1 where id='$id'");
		$status=true;
		$msg="Sent";
	}else{
		$status=false;
		$msg="Invalid Details";
	}
}else{
	$status=false;
	$msg="Id not found";
}

echo json_encode(array('status'=>$status,'msg'=>$msg));

function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.hostinger.com";
	$mail->Port = "465"; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "sunny@coderscapital.tech";
	$mail->Password = 'Sunny29@1971';
	$mail->SetFrom("sunny@coderscapital.tech");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		//echo $mail->ErrorInfo;
	}else{
		//echo 'Sent';
	}
}
?>