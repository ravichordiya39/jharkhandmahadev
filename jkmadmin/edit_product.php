<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
//Sanitize if you want
$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
$operation = filter_input(INPUT_GET, 'operation',FILTER_SANITIZE_STRING); 
($operation == 'edit') ? $edit = true : $edit = false;
 $db = getDbInstance();

//If edit variable is set, we are performing the update operation.
if($edit)
{
  $db->where('id', $product_id);
    
  $product = $db->getOne("products");  
}
//Handle update request. As the form's action attribute is set to the same script, but 'POST' method, 
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  $product_id = filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_STRING);
  //Get input data
  $data_to_update = filter_input_array(INPUT_POST);

  $data_to_update['slug']=convert_to_slug($_POST['title']);
  $slug = trim($data_to_update['slug']);
  //Check Slug not exists
 
  $productExt = $db->query("select id from products where slug='$slug' and id!='$product_id'");   
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
            $filename=$product['banner'];
            move_uploaded_file($file_tmp,"uploads/puja/".$filename);
            $data_to_update['banner'] = $filename;
             //echo "Success";
          }
          else
          {
            print_r($errors);exit();
          }
       }
       else
       {
        unset($data_to_update['banner']);
       }

       $data_to_update['updated_at'] = date('Y-m-d H:i:s');
        $db = getDbInstance();
        $db->where('id',$product_id);
       
        $data_to_update['booking_end_date']= date('Y-m-d',strtotime($_POST['booking_end_date']));
        $data_to_update['booking_start_date']= date('Y-m-d',strtotime($_POST['booking_start_date']));
        $data_to_update['slug']= $slug;

        $stat = $db->update('products', $data_to_update);

        if($stat)
        {
          $_SESSION['success'] = "Product updated successfully!";
          //Redirect to the listing page,
          header('location: products.php');
          //Important! Don't execute the rest put the exit/die. 
          exit();
        }
    }  
 }

 include_once 'includes/header.php';
?>
<div id="page-wrapper">
  <div class="row">
     <div class="col-sm-6">
        <h2 class="page-header">Update product</h2>
     </div>
      <div class="col-sm-6">
      <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="products.php">Product Manager</a></li>
          <li>Edit Product</li>
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
                  <input type="text" name="title" value="<?php echo $edit ? $product['title'] : ''; ?>" placeholder="Title" class="form-control" required="required" id="title" >
             </div>      
          </div>
          <div class="col-sm-4 col-md-3">
               <div class="form-group">
                  <label for="title">Tagline *</label>
                    <input type="text" name="tagline" value="<?php echo $edit ? $product['tagline'] : ''; ?>" placeholder="Tagline" class="form-control" required="required" id = "tagline" >
              </div>       
          </div>
          <div class="col-sm-4 col-md-3">
             <div class="form-group">
                <label for="price">Price *</label>
                  <input type="number" name="price" value="<?php echo $edit ? $product['price'] : ''; ?>" placeholder="price" class="form-control" required="required" id = "price" >
            </div> 
          </div>
          <div class="col-xs-12">
            <h4>Booking Details</h4><hr>
          </div>  

          <div class="col-sm-4 col-md-3">
            <div class="form-group">
              <label>Booking start date</label>

              <input type="text" name="booking_start_date" class="form-control datepicker" value="<?php  echo $edit ? $product['booking_start_date']:''; ?>" required="required">
            </div>
          </div>

          <div class="col-sm-4 col-md-3">
            <div class="form-group">
              <label>Booking end date</label>
              <input type="text" name="booking_end_date" class="form-control datepicker" value="<?php echo $edit ? $product['booking_end_date']:'';?>" 
               required="required">
            </div>
          </div>

          <div class="col-sm-4 col-md-3">
            <div class="form-group">
              <label>Addon product?</label><br>
              <div class="radio-outer">
              <input type="radio" name="is_addon_product" value="Yes" <?php if(isset($product['is_addon_product']) && $product['is_addon_product']=='Yes'){echo 'checked';} ?>> Yes</div>
              <div class="radio-outer">
              <input type="radio" name="is_addon_product" value="No" <?php if(isset($product['is_addon_product']) && $product['is_addon_product']=='No'){echo 'checked';} ?>> No</div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Product details *</label>
              <textarea name="product_details" class="form-control ckeditor" required><?php echo $edit ? $product['product_details']:'';?></textarea>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Product Note *</label>
              <textarea name="product_note" class="form-control ckeditor" required><?php echo $edit ? $product['product_note']:'';?></textarea>
            </div>
          </div>
          
             <div class="col-sm-3">
              <div class="form-group">
                  <label for="banner">Upload Banner *</label>
                  <input type="file" name="banner" class="form-control" id = "banner">                  
              </div> 
            </div>
            <div class="col-sm-4">
              <?php if(!empty($product['banner'])){ ?><img src="uploads/puja/<?php echo htmlspecialchars($product['banner']); ?>" width="100"><?php } ?> 
            </div>

            <div class="col-sm-12">
              <div class="form-group text-right">            
                <button type="submit" class="btn btn-primary">Update Product</button>
              </div>
            </div>  
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