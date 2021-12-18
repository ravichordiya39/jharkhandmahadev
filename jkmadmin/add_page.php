<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

 $expensions= array("jpeg","jpg","png");
 $errors= array();
//serve POST method, After successful insert, redirect to customers.php page.
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
    $data_to_store = filter_input_array(INPUT_POST);

   if(isset($_FILES['banner']) && !empty($_FILES['banner']['name']))
   {
      $file_name = $_FILES['banner']['name'];
      $file_size = $_FILES['banner']['size'];
      $file_tmp = $_FILES['banner']['tmp_name'];
      $file_type = $_FILES['banner']['type'];
      $data_to_store['banner']='';
      $file_ext=strtolower(end(explode('.',$_FILES['banner']['name'])));

      list($bwidth, $bheight) = getimagesize($file_tmp);

      if($bwidth!=1200 && $bheight!=400)
      {
        $errors[]="Invalid Header Banner dimension, banner size must be 1200x400"; 
      }
      
      if(in_array($file_ext,$expensions)=== false)
      {
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 1097152) {
         $errors[]='File size must be less then 1 MB';
      }
      
      if(empty($errors)==true) {
        $filename=time().'.'.$file_ext;
         move_uploaded_file($file_tmp,"uploads/banner/".$filename);
            $data_to_store['banner'] = $filename;
         //echo "Success";
      }     
   }

   if(isset($_FILES['side_banner1']) && !empty($_FILES['side_banner1']['name']))
   {
      $b1_name = $_FILES['side_banner1']['name'];
      $b1_size = $_FILES['side_banner1']['size'];     
      $b1_tmp = $_FILES['side_banner1']['tmp_name'];
      
      $data_to_store['side_banner1']='';
      $b1_ext=strtolower(end(explode('.',$b1_name)));

      list($b1width, $b1height) = getimagesize($b1_tmp);

      if($b1width>500)
      {
        $errors[]="Sidebar Banner1 width must be less then 500px"; 
      }
      
      if(in_array($b1_ext,$expensions)=== false)
      {
         $errors[]="Sidebar Banner1 extension not allowed, please choose a JPEG or PNG file.";
      }

      if($b1_size > 597152) {
         $errors[]='File size must be less then 500kb';
      }
      
      if(empty($errors)==true) 
      {
        $filename1=time().'.'.$b1_ext;
         move_uploaded_file($b1_tmp,"uploads/banner/".$filename1);
          $data_to_store['side_banner1'] = $filename1;        
      }
      
   }

    if(isset($_FILES['side_banner2']) && !empty($_FILES['side_banner2']['name']))
   {
      $b2_name = $_FILES['side_banner2']['name'];
      $b2_size = $_FILES['side_banner2']['size'];     
      $b2_tmp = $_FILES['side_banner2']['tmp_name'];
      
      $data_to_update['side_banner2']='';
      $b2_ext=strtolower(end(explode('.',$b2_name)));

      list($b2width, $b2height) = getimagesize($b2_tmp);

      if($b2width>500)
      {
        $errors[]="Sidebar Banner 2 width must be less then 500px"; 
      }
      
      if(in_array($b2_ext,$expensions)=== false)
      {
         $errors[]="Sidebar Banner 2 extension not allowed, please choose a JPEG or PNG file.";
      }

      if($b2_size > 597152) {
         $errors[]='File size must be less then 500kb';
      }
      
      if(empty($errors)==true) 
      {
        $filename2=time().'.'.$b2_ext;
         move_uploaded_file($b2_tmp,"uploads/banner/".$filename2);
          $data_to_update['side_banner2'] = $filename2;        
      }
      
   }
  

   if(isset($_FILES['side_banner3']) && !empty($_FILES['side_banner3']['name']))
   {
      $b3_name = $_FILES['side_banner3']['name'];
      $b3_size = $_FILES['side_banner3']['size'];     
      $b3_tmp = $_FILES['side_banner3']['tmp_name'];
      
      $data_to_update['side_banner3']='';
      $b3_ext=strtolower(end(explode('.',$b3_name)));

      list($b3width, $b3height) = getimagesize($b3_tmp);

      if($b3width>500)
      {
        $errors[]="Sidebar Banner 3 width must be less then 500px"; 
      }
      
      if(in_array($b3_ext,$expensions)=== false)
      {
         $errors[]="Sidebar Banner 3 extension not allowed, please choose a JPEG or PNG file.";
      }

      if($b3_size > 597152) {
         $errors[]='File size must be less then 500kb';
      }
      
      if(empty($errors)==true) 
      {
        $filename3=time().'.'.$b3_ext;
         move_uploaded_file($b3_tmp,"uploads/banner/".$filename3);
          $data_to_update['side_banner3'] = $filename3;        
      }
   }
  

    if($errors && count($errors)>0)
   {
        foreach ($errors as $error) 
        {
          echo '<p style="text-transform:capitalize;">'.$error.'</p>';
        }        
        echo '<a href="add_page.php?operation=create">Go Back</a>';
        exit();
    }   

    //Insert timestamp
    $data_to_store['created_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $last_id = $db->insert ('pages', $data_to_store);
    
    if($last_id)
    {
    	$_SESSION['success'] = "Page added successfully!";
    	header('location: pages.php');
    	exit();
    }  
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
     <div class="col-md-6">
            <h2 class="page-header">Add Page</h2>
      </div>
      <div class="col-md-6">
        <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="pages.php">Page manager</a></li>
          <li>Add Page</li>
        </ul>
      </div>
        
</div>
    <form class="form" action="" method="post"  id="page_form" enctype="multipart/form-data">
       <?php  include_once('./forms/page_form.php'); ?>
    </form>
</div>

<script type="text/javascript" src="./lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 // $('.ckeditor').ckeditor();
   $("#page_form").validate({
       rules: {
            f_name: {
                required: true,
                minlength: 3
            },
            l_name: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>

<?php include_once 'includes/footer.php'; ?>