<?php
session_start();
require_once './config/config.php';
require_once '../functions.php';
require_once './includes/auth_validate.php';
require_once 'includes/header.php'; 
?>

<div id="page-wrapper">
    <div class="row">
       <div class="col-sm-6"><h2 class="page-header">Home Page Setting</h2></div>     
       <div class="col-sm-6">  
         <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li>Home Page Setting</li>
        </ul> 
      </div>  
    </div>

    <?php 
     if(isset($_POST['homeSetting']))
     {
        $mandir_timings = trim($_POST['mandir_timings']);
        $ss = update_option('mandir_timings',$mandir_timings);

        $home_page_welcome_content = trim($_POST['home_page_welcome_content']);
        update_option('home_page_welcome_content',$home_page_welcome_content);
        update_option('news_flash',$_POST['news_flash']);    
        $important_request_content = trim($_POST['important_request_content']);
        $important_information_content = trim($_POST['important_information_content']);
        update_option('important_request_content',$important_request_content);    
        update_option('important_information_content',$important_information_content); 

         update_option('visesh_request_content',trim($_POST['visesh_request_content'])); 
         update_option('live_darshan_title',trim($_POST['live_darshan_title'])); 
         #980101
           

        if($ss)
        {
           echo '<div class="alert alert-success"><strong>Success! </strong> Data update successfully</div>'; 
        }
        else
        {
           echo '<div class="alert alert-danger"><strong>Error! </strong> Something went wrong please try again</div>';     
        }
     }
    ?>

    <form class="form" action="" method="post"  id="home-page-setting" enctype="multipart/form-data">       
       <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Live Darshan Heading</label>
                <input type="text" name="live_darshan_title" class="form-control" value="<?php echo get_option('live_darshan_title');?>" placeholder="Enter Live Darshan Heading">
            </div>
        </div>
       </div>
       <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>दिन अनुसूची</label>
                <textarea class="ckeditor" name="mandir_timings" class="form-control"><?php echo get_option('mandir_timings');?></textarea>
            </div>
        </div>

         <div class="col-sm-6">
            <div class="form-group">
                <label>News Flash</label>
                <textarea class="ckeditor" name="news_flash" class="form-control"><?php echo get_option('news_flash');?></textarea>
            </div>
        </div>
       </div>

       <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Welcome Content</label>
                <textarea class="ckeditor" name="home_page_welcome_content" class="form-control"><?php echo get_option('home_page_welcome_content');?></textarea>
            </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
                <label>विशेष आग्रह</label>
                <textarea class="ckeditor" name="visesh_request_content" class="form-control"><?php echo get_option('visesh_request_content');?></textarea>
            </div>
        </div>
       </div>

       <div class="row">        
        <div class="col-sm-6">
          <label>विनम्र  निवेदन </label>
            <div class="form-group">                
                <textarea class="ckeditor" name="important_request_content" class="form-control"><?php echo get_option('important_request_content');?></textarea>
            </div>
        </div>
        <div class="col-sm-6">
          <label>विशेष सूचना </label>
            <div class="form-group">                
                <textarea class="ckeditor" name="important_information_content" class="form-control"><?php echo get_option('important_information_content');?></textarea>
            </div>
        </div>
       </div>


       <div class="row">
        <div class="col-sm-12">
           <div class="form-group">
             <input type="submit" name="homeSetting" value="Save" class="btn btn-primary"><br><br>
           </div>
        </div>
       </div>
    </form>

</div>
<script type="text/javascript" src="./lib/ckeditor/ckeditor.js"></script>
<?php include_once 'includes/footer.php'; ?>