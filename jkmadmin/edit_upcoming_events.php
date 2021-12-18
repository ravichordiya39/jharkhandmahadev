<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
// Sanitize if you want

$customer_id = filter_input(INPUT_GET, 'upcoming_events_id', FILTER_VALIDATE_INT);

$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 

($operation == 'edit') ? $edit = true : $edit = false;

 $db = getDbInstance();

//If edit variable is set, we are performing the update operation.

if($edit)
{

    $db->where('id', $customer_id);
    //Get data to pre-populate the form.

    $customer = $db->getOne("upcoming_events");
}

//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 

if ($_SERVER['REQUEST_METHOD'] == 'POST') 

{

    //Get customer id form query string parameter.

    $customer_id = filter_input(INPUT_GET, 'upcoming_events_id', FILTER_SANITIZE_STRING);



    //Get input data

    $data_to_update = filter_input_array(INPUT_POST);

    

    //print_r($_FILES);exit();

   if(isset($_FILES['banner']) && !empty($_FILES['banner']['name'])){

      $errors= array();

      $file_name = $_FILES['banner']['name'];

      $file_size = $_FILES['banner']['size'];

      $file_tmp = $_FILES['banner']['tmp_name'];

      $file_type = $_FILES['banner']['type'];

      $file_ext=strtolower(end(explode('.',$_FILES['banner']['name'])));

      

      $expensions= array("jpeg","jpg","png");

      

      if(in_array($file_ext,$expensions)=== false){

         $errors[]="extension not allowed, please choose a JPEG or PNG file.";

      }

      

      if($file_size > 2097152) {

         $errors[]='File size must be excately 2 MB';

      }

      

      if(empty($errors)==true) {

        $filename=$customer['banner'];

         move_uploaded_file($file_tmp,"uploads/upcoming_events/".$filename);

            $data_to_update['banner'] = $filename;

         //echo "Success";

      }else{

        print_r($errors);exit();

      }

   }else{

        unset($data_to_update['banner']);

   }



    $data_to_update['updated_at'] = date('Y-m-d H:i:s');

    $db = getDbInstance();

    $db->where('id',$customer_id);

    $stat = $db->update('upcoming_events', $data_to_update);



    if($stat)

    {

        $_SESSION['success'] = "Upcoming event updated successfully!";

        //Redirect to the listing page,

        header('location: upcoming_events.php');

        //Important! Don't execute the rest put the exit/die. 

        exit();

    }

}



?>





<?php

    include_once 'includes/header.php';

?>

<div id="page-wrapper">

    <div class="row">
      <div class="col-sm-6">
        <h2 class="page-header">Update Upcoming Events</h2>
      </div>
        
       <div class="col-sm-6">
        <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="upcoming_events.php">Upcoming Events</a></li>
          <li>Update Events</li>
        </ul>
      </div> 
    </div>

    <!-- Flash messages -->

    <?php

        include('./includes/flash_messages.php')

    ?>



    <form class="" action="" method="post" enctype="multipart/form-data" id="upcoming_events_form">

        

        <?php

            //Include the common form for add and edit  

            require_once('./forms/upcoming_event_form.php'); 

        ?>

    </form>

</div>









<?php include_once 'includes/footer.php'; ?>