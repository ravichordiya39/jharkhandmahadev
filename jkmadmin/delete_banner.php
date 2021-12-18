<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: banners.php');
        exit;

	}
    $customer_id = $del_id;

    $db = getDbInstance();

    //Get data to pre-populate the form.
    $customer = $db->getOne("banners");

    $db->where('id', $customer_id);
    $status = $db->delete('banners');
    
    if ($status) 
    {
        $filename=$customer['banner'];
        unlink("uploads/banners/".$filename);
        $_SESSION['info'] = "Banner deleted successfully!";
        header('location: banners.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete banner";
    	header('location: banners.php');
        exit;

    }
    
}