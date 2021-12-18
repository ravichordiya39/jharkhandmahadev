<?php
session_start();
require_once './config/config.php';
require_once '../functions.php';
require_once './includes/auth_validate.php';
require_once 'includes/header.php'; 
?>

<div id="page-wrapper">
    <div class="row">
     <div class="col-sm-6"><h2 class="page-header">Social Media Setting</h2></div>  
      <div class="col-sm-6">  
         <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li>Social Media Setting</li>
        </ul> 
      </div>        
    </div>

    <?php 
     if(isset($_POST['socialSetting']))
     {
        
        update_option('facebook_page_link',trim($_POST['facebook_page_link']));
        update_option('instagram_page_link',trim($_POST['instagram_page_link']));
        update_option('twitter_page_link',trim($_POST['twitter_page_link']));
        update_option('youtube_page_link',trim($_POST['youtube_page_link']));

      
         echo '<div class="alert alert-success"><strong>Success! </strong> Social Media Setting  update successfully</div>'; 
        
     }
    ?>

    <form class="form" action="" method="post"  id="home-page-setting" enctype="multipart/form-data">       

       <div class="form-group">
        <label>Facebook</label>
        <input type="text" name="facebook_page_link" class="form-control" value="<?php echo get_option('facebook_page_link');?>" placeholder="Enter facebook page link">
       </div>

       <div class="form-group">
        <label>Instagram</label>
        <input type="text" name="instagram_page_link" class="form-control" value="<?php echo get_option('instagram_page_link');?>" placeholder="Enter Instagram page link">
       </div>

       <div class="form-group">
        <label>Twitter</label>
        <input type="text" name="twitter_page_link" class="form-control" value="<?php echo get_option('twitter_page_link');?>" placeholder="Enter twitter page link">
       </div>

        <div class="form-group">
        <label>Youtube</label>
        <input type="text" name="youtube_page_link" class="form-control" value="<?php echo get_option('youtube_page_link');?>" placeholder="Enter Youtube page link">
       </div>
       


       <div class="row">
        <div class="col-sm-12">
           <div class="form-group">
             <input type="submit" name="socialSetting" value="Save" class="btn btn-primary"><br><br>
           </div>
        </div>
       </div>
    </form>

</div>
<script type="text/javascript" src="./lib/ckeditor/ckeditor.js"></script>
<?php include_once 'includes/footer.php'; ?>