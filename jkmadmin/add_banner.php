<?php

session_start();

require_once './config/config.php';

require_once './includes/auth_validate.php';





//serve POST method, After successful insert, redirect to customers.php page.

if ($_SERVER['REQUEST_METHOD'] == 'POST') 

{

    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.

    $data_to_store = filter_input_array(INPUT_POST);





   if(isset($_FILES['banner']) && !empty($_FILES['banner']['name'])){

      $errors= array();

      $file_name = $_FILES['banner']['name'];

      $file_size = $_FILES['banner']['size'];

      $file_tmp = $_FILES['banner']['tmp_name'];

      $file_type = $_FILES['banner']['type'];

      $data_to_store['banner']='';

      $file_ext=strtolower(end(explode('.',$_FILES['banner']['name'])));

      

      $expensions= array("jpeg","jpg","png");

      

      if(in_array($file_ext,$expensions)=== false){

         $errors[]="extension not allowed, please choose a JPEG or PNG file.";

      }

      

      if($file_size > 2097152) {

         $errors[]='File size must be excately 2 MB';

      }

      

      if(empty($errors)==true) {

        $filename=time().'.'.$file_ext;

         move_uploaded_file($file_tmp,"uploads/banners/".$filename);

            $data_to_store['banner'] = $filename;

         //echo "Success";

      }else{

        //print_r($errors);

      }

   }



    //Insert timestamp

    $data_to_store['created_at'] = date('Y-m-d H:i:s');

    $db = getDbInstance();

    $last_id = $db->insert ('banners', $data_to_store);

    

    if($last_id)

    {

    	$_SESSION['success'] = "Banner added successfully!";

    	header('location: banners.php');

    	exit();

    }  

}



//We are using same form for adding and editing. This is a create form so declare $edit = false.

$edit = false;



require_once 'includes/header.php'; 

?>

<div id="page-wrapper">

<div class="row">
   <div class="col-sm-6">
     <h2 class="page-header">Add banner</h2>
   </div>
   <div class="col-sm-6">
      <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="banners.php">Banner Manager</a></li>
          <li>Add Banner</li>
        </ul>
   </div>
</div>

    <form class="form" action="" method="post"  id="banner_form" enctype="multipart/form-data">

       <?php  include_once('./forms/banner_form.php'); ?>

    </form>

</div>





<script type="text/javascript">

$(document).ready(function(){

   $("#gallery_form").validate({

       rules: {

            title: {

                required: true,

                minlength: 3

            },

            banner: {

                required: true,

                //minlength: 3

            },   

        }

    });

});

</script>



<?php include_once 'includes/footer.php'; ?>