<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: gallery.php');
        exit;

	}
    $customer_id = $del_id;

    $db = getDbInstance();

    $db->where('id', $customer_id);
    //Get data to pre-populate the form.
    $customer = $db->getOne("gallery");

    $db->where('id', $customer_id);
    $status = $db->delete('gallery');
    
    if ($status) 
    {
        $filename=$customer['banner'];
        unlink("uploads/gallery/".$filename);
        $_SESSION['info'] = "Gallery deleted successfully!";
        header('location: gallery.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete gallery";
    	header('location: gallery.php');
        exit;

    }
    
}