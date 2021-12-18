<?php 
require_once './mailer/smtp.php';
session_start();
//If user has previously selected "remember me option", his credentials are stored in cookies.
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	//$data_to_store = filter_input_array(INPUT_POST);
	//{first_name:first_name,last_name:last_name,state:state,country:country,captcha:captcha,message:message}
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $state = filter_input(INPUT_POST, 'state');
    $country = filter_input(INPUT_POST, 'country');
    $captcha = filter_input(INPUT_POST, 'captcha');
    $message = filter_input(INPUT_POST, 'message');
    if ($captcha != $_SESSION['captcha']) 
    {
    	//Allow user to login.
        echo json_encode(['status'=>0,'msg'=>'Invalid captcha.']);
        //header('Location:register.php');
        exit();
    }
    else if (empty($first_name) || empty($last_name) || empty($state) || empty($country) || empty($message)) 
    {
    	//Allow user to login.
        echo json_encode(['status'=>0,'msg'=>'Please fill all input box.']);
        //header('Location:register.php');
        exit();
    }
    else //Username Or password might be changed. Unset cookie
    {
	    //Insert timestamp
	    
	    	//$_SESSION['success'] = "Subscribe successfully!";
	    	$to = "jharkhandmahadev@gmail.com";
			$subject = "Contact email";

			$msg = "
			<html>
			<head>
			<title>".$subject."</title>
			</head>
			<body>
			<p>This email is contact email</p>
			<table>
			<tr>
			<th>First name</th>
			<th>Last name</th>
			<th>State</th>
			<th>Country</th>
			<th>Message</th>
			</tr>
			<tr>
			<td>".$first_name."</td>
			<td>".$last_name."</td>
			<td>".$state."</td>
			<td>".$country."</td>
			<td>".$message."</td>
			</tr>
			</table>
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
			//Set who the message is to be sent from
			$mail->setFrom($mail->Username, $first_name.' '.$last_name);
			//$mail->setFrom('vinodsaraswat8@gmail.com', $first_name.' '.$last_name);
			//Set an alternative reply-to address
			$mail->addReplyTo($mail->Username, $first_name.' '.$last_name);
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
		    	echo json_encode(['status'=>1,'msg'=>'Mail send successfully!']);
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
