<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$customer_id = filter_input(INPUT_GET, 'menu_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $customer_id = filter_input(INPUT_GET, 'menu_id', FILTER_SANITIZE_STRING);

    //Get input data
    $data_to_update = filter_input_array(INPUT_POST);
    
    //$data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $db->where('id',$customer_id);
    $stat = $db->update('menu', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Menu successfully!";
        //Redirect to the listing page,
        header('location: menu.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}
    
//Get data to pre-populate the form.
$pages = $db->get("pages");


//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $customer_id);
    //Get data to pre-populate the form.
    $customer = $db->getOne("menu");
    //print_r($customer);
}

include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-sm-6">
          <h2 class="page-header">Update Menu</h2>
        </div>
       <div class="col-sm-6">  
         <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="menu.php">Menu Manager</a></li>
          <li>Update Menu</li>
        </ul> 
      </div>  
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="menu_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/menu_form.php'); 
        ?>
    </form>
</div>




<?php include_once 'includes/footer.php'; ?>