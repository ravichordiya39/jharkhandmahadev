<?php 
session_start();
require_once 'includes/auth_validate.php';
require_once './config/config.php';
$del_id = filter_input(INPUT_POST, 'del_id');
if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 
{

	if($_SESSION['admin_type']!='super'){
		$_SESSION['failure'] = "You don't have permission to perform this action";
    	header('location: upcoming_events.php');
        exit;

	}
    $customer_id = $del_id;

    $db = getDbInstance();

    $db->where('id', $customer_id);
    //Get data to pre-populate the form.
    $customer = $db->getOne("upcoming_events");

    $db->where('id', $customer_id);
    $status = $db->delete('upcoming_events');
    
    if ($status) 
    {
        $filename=$customer['banner'];
        unlink("uploads/upcoming_events/".$filename);
        $_SESSION['info'] = "Upcoming event deleted successfully!";
        header('location: upcoming_events.php');
        exit;
    }
    else
    {
    	$_SESSION['failure'] = "Unable to delete upcoming event";
    	header('location: upcoming_events.php');
        exit;

    }
    
}