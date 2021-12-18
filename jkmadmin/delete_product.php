<?php 

session_start();

require_once 'includes/auth_validate.php';

require_once './config/config.php';

$del_id = filter_input(INPUT_POST, 'del_id');

if ($del_id && $_SERVER['REQUEST_METHOD'] == 'POST') 

{



	if($_SESSION['admin_type']!='super'){

		$_SESSION['failure'] = "You don't have permission to perform this action";

    	header('location: products.php');

        exit;



	}

    $product_id = $del_id;



    $db = getDbInstance();



    $db->where('id', $product_id);

    //Get data to pre-populate the form.

    $customer = $db->getOne("products");



    $db->where('id', $product_id);

    $status = $db->delete('products');

    

    if ($status) 

    {

        $filename=$customer['banner'];

        unlink("uploads/puja/".$filename);

        $_SESSION['info'] = "Product deleted successfully!";

        header('location: products.php');

        exit;

    }

    else

    {

    	$_SESSION['failure'] = "Unable to delete Product";

    	header('location: products.php');

        exit;



    }

    

}