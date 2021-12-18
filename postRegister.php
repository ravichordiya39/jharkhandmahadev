<?php 
require_once './jkmadmin/config/config.php';
session_start();
//If user has previously selected "remember me option", his credentials are stored in cookies.
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$db = getDbInstance();
	$data_to_store = filter_input_array(INPUT_POST);
	unset($data_to_store['confirm_passwd']);
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $passwd = filter_input(INPUT_POST, 'passwd');
    $confirm_passwd = filter_input(INPUT_POST, 'confirm_passwd');
    if ($passwd <> $confirm_passwd) 
    {
    	//Allow user to login.
        $_SESSION['login_failure'] = 'Password missmatch.';
        header('Location:index.php');
        exit;
    }else{
	    $passwd=  md5($passwd);
		$db->where ("email", $email);
	    $row = $db->get('customers');
	    if ($db->count >= 1) 
	    {
	    	//Allow user to login.
	        $_SESSION['login_failure'] = 'User already exists.';
	        header('Location:index.php');
	        exit;
	    }
	    else //Username Or password might be changed. Unset cookie
	    {
		    //Insert timestamp
		    $data_to_store['passwd'] = $passwd;
		    $data_to_store['created_at'] = date('Y-m-d H:i:s');
		    $last_id = $db->insert ('customers', $data_to_store);
		    
		    if($last_id)
		    {
		    	$_SESSION['success'] = "Registered successfully!";
		    	redirect('index.php');
		    	exit();
		    }  else{
		    	$_SESSION['login_failure'] = "Something went wrong!";
		    	redirect('index.php');
		    	exit();
		    }
	    }
	}
}

?>
