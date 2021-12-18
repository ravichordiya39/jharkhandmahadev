<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';


// Sanitize if you want
$customer_id = filter_input(INPUT_GET, 'page_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//If edit variable is set, we are performing the update operation.
if($edit)
{
    $db->where('id', $customer_id);
    //Get data to pre-populate the form.
    $customer = $db->getOne("pages");
}
 $expensions= array("jpeg","jpg","png");
$errors=array();


//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //Get customer id form query string parameter.
    $customer_id = filter_input(INPUT_GET, 'page_id', FILTER_SANITIZE_STRING);

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
         $errors[]='File size must be excately 1 MB';
      }
      
      if(empty($errors)==true) 
      {
       
        if(empty($customer['banner']))
        {
         $filename=time().'.'.$file_ext;   
        }
        else
        {
          $filename=$customer['banner'];
        }
       
         move_uploaded_file($file_tmp,"uploads/banner/".$filename);
            $data_to_update['banner'] = $filename;
         //echo "Success";
      }
      else
      {
        //print_r($errors);exit();
        foreach ($errors as $error) 
        {
          echo '<p style="text-transform:capitalize;">'.$error.'</p>';
        }        
        echo '<a href="edit_page.php?page_id='.$_GET['page_id'].'&operation=edit">Go Back</a>';
        exit();
      }
   }
   else
   {
        unset($data_to_update['banner']);
   }

   if(isset($_FILES['side_banner1']) && !empty($_FILES['side_banner1']['name']))
   {
      $b1_name = $_FILES['side_banner1']['name'];
      $b1_size = $_FILES['side_banner1']['size'];     
      $b1_tmp = $_FILES['side_banner1']['tmp_name'];
      
      $data_to_update['side_banner1']='';
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
        if(empty($customer['side_banner1']))
        {
          $filename1=time().'.'.$b1_ext;
        }
        else
        {
          $filename1=$customer['side_banner1'];
        }
       
         move_uploaded_file($b1_tmp,"uploads/banner/".$filename1);
          $data_to_update['side_banner1'] = $filename1;        
      }
      else
      {
        foreach ($errors as $error) 
        {
          echo '<p style="text-transform:capitalize;">'.$error.'</p>';
        }        
        echo '<a href="edit_page.php?page_id='.$_GET['page_id'].'&operation=edit">Go Back</a>';
        exit();
      }
   }
   else
   {
    unset($data_to_update['side_banner1']);
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
        $errors[]="Sidebar Banner1 width must be less then 500px"; 
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
       
        if(empty($customer['side_banner2']))
        {
          $filename2=time().'.'.$b2_ext;
        }
        else
        {
          $filename2=$customer['side_banner2'];
        }

         move_uploaded_file($b2_tmp,"uploads/banner/".$filename2);
          $data_to_update['side_banner2'] = $filename2;        
      }
      else
      {
        foreach ($errors as $error) 
        {
          echo '<p style="text-transform:capitalize;">'.$error.'</p>';
        }        
        echo '<a href="edit_page.php?page_id='.$_GET['page_id'].'&operation=edit">Go Back</a>';
        exit();
      }
   }
   else
   {
    unset($data_to_update['side_banner2']);
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
        $errors[]="Sidebar Banner1 width must be less then 500px"; 
      }
      
      if(in_array($b3_ext,$expensions)=== false)
      {
         $errors[]="Sidebar Banner 2 extension not allowed, please choose a JPEG or PNG file.";
      }

      if($b3_size > 597152) {
         $errors[]='File size must be less then 500kb';
      }
      
      if(empty($errors)==true) 
      {
        if(empty($customer['side_banner3']))
        {
          $filename3=time().'.'.$b2_ext;
        }
        else
        {
          $filename3=$customer['side_banner3'];
        }
        
         move_uploaded_file($b3_tmp,"uploads/banner/".$filename3);
          $data_to_update['side_banner3'] = $filename3;        
      }
      else
      {
        foreach ($errors as $error) 
        {
          echo '<p style="text-transform:capitalize;">'.$error.'</p>';
        }        
        echo '<a href="edit_page.php?page_id='.$_GET['page_id'].'&operation=edit">Go Back</a>';
        exit();
      }
   }
   else
   {
    unset($data_to_update['side_banner3']);
   }

  
   if($errors && count($errors)>0)
   {
        foreach ($errors as $error) 
        {
          echo '<p style="text-transform:capitalize;">'.$error.'</p>';
        }        
        echo '<a href="edit_page.php?page_id='.$_GET['page_id'].'&operation=edit">Go Back</a>';
        exit();
    }    

    $data_to_update['updated_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $db->where('id',$customer_id);
    
    $stat = $db->update('pages', $data_to_update);

    if($stat)
    {
        $_SESSION['success'] = "Page updated successfully!";
        //Redirect to the listing page,
        header('location: pages.php');
        //Important! Don't execute the rest put the exit/die. 
        exit();
    }
}

    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
      <div class="col-sm-6">
        <h1 class="page-header">Update Page</h1>
      </div>
      <div class="col-sm-6">
        <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="pages.php">Page manager</a></li>
          <li>Update Page</li>
        </ul>
      </div>  
    </div>
    <!-- Flash messages -->
    <?php
        include('./includes/flash_messages.php')
    ?>

    <form class="" action="" method="post" enctype="multipart/form-data" id="page_form">
        
        <?php
            //Include the common form for add and edit  
            require_once('./forms/page_form.php'); 
        ?>
    </form>
</div>


<?php include_once 'includes/footer.php'; ?>