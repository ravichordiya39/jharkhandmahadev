<?php
if(!session_start()){session_start();}
require_once './config/config.php';
require_once './includes/auth_validate.php';
//serve POST method, After successful insert, redirect to customers.php page.
if($_SERVER['REQUEST_METHOD']== 'POST') 
{
   $db = getDbInstance();
   //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
  $data_to_store = filter_input_array(INPUT_POST);  
  $data_to_store['slug']=convert_to_slug($_POST['title']);
  $db->where('slug', $data_to_store['slug']);
  $productExt = $db->get("products");   
  if(count($productExt)>0)
  {
    $_SESSION['failure'] = "Product title already exists!";   
  }
  else
  {
      if(isset($_FILES['banner']) && !empty($_FILES['banner']['name']))
      {
          $errors= array();
          $file_name = $_FILES['banner']['name'];
          $file_size = $_FILES['banner']['size'];
          $file_tmp = $_FILES['banner']['tmp_name'];
          $file_type = $_FILES['banner']['type'];
          $data_to_store['banner']='';
          $file_ext=strtolower(end(explode('.',$_FILES['banner']['name'])));     

          $expensions= array("jpeg","jpg","png");
          if(in_array($file_ext,$expensions)=== false)
          {
             $errors[]="extension not allowed, please choose a JPEG or PNG file.";
          }     

          if($file_size > 2097152) 
          {
            $errors[]='File size must be excately 2 MB';
          }     

          if(empty($errors)==true) 
          {
            $filename=time().'.'.$file_ext;
            move_uploaded_file($file_tmp,"uploads/puja/".$filename);
            $data_to_store['banner'] = $filename;
            //echo "Success";
          }
          else
          {
            print_r($errors);
          }
       }

       //Insert timestamp
        $data_to_store['created_at'] = date('Y-m-d H:i:s');

       
        $data_to_store['booking_end_date']= date('Y-m-d',strtotime($_POST['booking_end_date']));
        $data_to_store['booking_start_date']= date('Y-m-d',strtotime($_POST['booking_start_date']));
        
        
       
       $last_id = $db->insert('products',$data_to_store);
        if($last_id)
        {
          $_SESSION['success'] = "Product added successfully!";
          header('location: products.php');
          exit();
        }
  }
     
}

//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;
require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
  <div class="row">
     <div class="col-sm-6">
        <h2 class="page-header">Add product</h2>
     </div>
     <div class="col-sm-6">
      <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="products.php">Product manager</a></li>
          <li>Add Product</li>
        </ul>
     </div>
  </div>
  <?php include('./includes/flash_messages.php') ?>
  <div class="panel panel-default">
    <div class="panel-heading">Enter Product Details</div>
    <div class="panel-body">
      <form class="form" action="" method="post"  id="product_form" enctype="multipart/form-data">  
        <div class="row">
          <div class="col-sm-4 col-md-3">
             <div class="form-group">
                <label for="title">Title *</label>
                  <input type="text" name="title" value="<?php if(isset($_POST['title'])){echo $_POST['title'];}?>" placeholder="Title" class="form-control" required="required" id="title" >
             </div>      
          </div>
          <div class="col-sm-4 col-md-3">
               <div class="form-group">
                  <label for="title">Tagline *</label>
                    <input type="text" name="tagline" value="<?php if(isset($_POST['tagline'])){echo $_POST['tagline'];}?>" placeholder="Tagline" class="form-control" required="required" id = "tagline" >
              </div>       
          </div>
          <div class="col-sm-4 col-md-3">
             <div class="form-group">
                <label for="price">Price *</label>
                  <input type="number" name="price" value="<?php if(isset($_POST['price'])){echo $_POST['price'];}?>" placeholder="price" class="form-control" required="required" id = "price" >
            </div> 
          </div>
          <div class="col-xs-12">
            <h4>Booking Details</h4><hr>
          </div>  

          <div class="col-sm-4 col-md-3">
            <div class="form-group">
              <label>Booking Start Date</label>
              <input type="text" name="booking_start_date" class="form-control datepicker" value="<?php if(isset($_POST['booking_start_date'])){echo $_POST['booking_start_date']; } ?>" required>
            </div>
          </div>

          <div class="col-sm-4 col-md-3">
            <div class="form-group">
              <label>Booking end date</label>
              <input type="text" name="booking_end_date" class="form-control datepicker" value="<?php if(isset($_POST['booking_end_date'])){echo $_POST['booking_end_date']; } ?>" required>
            </div>
          </div>

          <div class="col-sm-4 col-md-3">
            <div class="form-group">
              <label>Addon product?</label><br>
              <div class="radio-outer">
              <input type="radio" name="is_addon_product" value="Yes" checked=""> Yes</div>
              <div class="radio-outer">
              <input type="radio" name="is_addon_product" value="No"> No</div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Product details *</label>
              <textarea name="product_details" class="form-control ckeditor" required><?php if(isset($_POST['product_details'])){echo $_POST['product_details'];}?></textarea>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Product Note *</label>
              <textarea name="product_note" class="form-control ckeditor" required><?php if(isset($_POST['product_note'])){echo $_POST['product_note'];}?></textarea>
            </div>
          </div>

           <div class="col-sm-4">
            <div class="form-group">
                <label for="banner">Upload Banner *</label>
                  <input type="file" name="banner" class="form-control" id = "banner" >
            </div> 
          </div>
        </div>

        <div class="form-group text-right">            
            <button type="submit" class="btn btn-primary">Save Product</button>
        </div>            
      </form>
     </div><!--Close panel body--> 
 </div><!--Close panel default-->
</div>
<script type="text/javascript" src="./lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
   $("#product_form").validate({
       rules: {
            title: {
                required: true, minlength: 3
            },
            booking_end_date:{required:true},
            booking_start_date:{required:true},            
            product_details:{required:true},            
            price: {
                required: true,
                numeric: true
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