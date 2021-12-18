<?php 
require_once './jkmadmin/config/config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $username = filter_input(INPUT_POST, 'username');
    $passwd = filter_input(INPUT_POST, 'passwd');
    //$remember = filter_input(INPUT_POST, 'remember');
    $remember = NULL;
    $passwd=  md5($passwd);
    
    //Get DB instance. function is defined in config.php
    $db = getDbInstance();

    $db->where ("email", $username);
    $db->where ("passwd", $passwd);
    $row = $db->get('customers');
     
    if ($db->count >= 1) {
        $_SESSION['user_logged_in'] = TRUE;
        $_SESSION['admin_type'] = $row[0]['admin_type'];
        if($remember)
        {
          setcookie('username',$username , time() + (86400 * 90), "/");
          setcookie('password',$passwd , time() + (86400 * 90), "/");
        }
        header('Location:index.php');
        exit;
    } else {
        $_SESSION['login_failure'] = "Invalid user name or password";
        header('Location:index.php');
        exit;
    }
  
}