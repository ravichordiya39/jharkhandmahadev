<?php 
require_once './jkmadmin/config/config.php';
require_once './mailer/smtp.php';
//session_start();
//If user has previously selected "remember me option", his credentials are stored in cookies.
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$db = getDbInstance();
	//$data_to_store = filter_input_array(INPUT_POST);
    $email = filter_input(INPUT_POST, 'email');
    $data_to_store['email']=$email;
	$db->where ("email", $email);
    $row = $db->get('subscribes');
    if ($db->count >= 1) 
    {
    	//Allow user to login.
        echo json_encode(['status'=>0,'msg'=>'You already subscriber.']);
        //header('Location:register.php');
        exit();
    }
    else //Username Or password might be changed. Unset cookie
    {
	    //Insert timestamp
	    $data_to_store['created_at'] = date('Y-m-d H:i:s');
	    $last_id = $db->insert ('subscribes', $data_to_store);
	    
	    if($last_id)
	    {
	    	$to = "jharkhandmahadev@gmail.com";
			$subject = "New user subscribe us";

			$msg = "
			<html>
			<head>
			<title>New user subscribe you.</title>
			</head>
			<body>
			<p>".$email." is subscribe us.</p>
			</body>
			</html>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <jharkhandmahadev@gmail.com>' . "\r\n";
			//$headers .= 'Cc: myboss@example.com' . "\r\n";

			//$status=mail($to,$subject,$msg,$headers);
	    	//$_SESSION['success'] = "Subscribe successfully!";
	    	//echo json_encode(['status'=>1,'msg'=>'Subscribe successfully!']);
	    	$mail->setFrom($email, $email);
			//Set an alternative reply-to address
			$mail->addReplyTo($email, $email);
			//Set who the message is to be sent to
			$mail->addAddress($to, 'Jharkhand mahadev');
			//Set the subject line
			$mail->Subject = $subject;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($msg, dirname(__FILE__));
			//Replace the plain text body with one created manually
			//$mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			//$mail->addAttachment();

	    
		    if($mail->send())
		    {
		    	echo json_encode(['status'=>1,'msg'=>'Subscribe successfully!']);
		    	//header('Location: index.php');
		    	//exit();
		    }  else{
		    	//$_SESSION['login_failure'] = "Something went wrong!";
	        	echo json_encode(['status'=>0,'msg'=>'Something went wrong!']);
		    	//header('Location: index.php');
		    	//exit();
		    }
	    	//header('Location: index.php');
	    	exit();
	    }  else{
	    	//$_SESSION['login_failure'] = "Something went wrong!";
        	echo json_encode(['status'=>0,'msg'=>'Something went wrong!']);
	    	//header('Location: index.php');
	    	exit();
	    }
    }
}

exit();
?>
