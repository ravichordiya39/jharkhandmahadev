<?php
session_start();
require_once './config/config.php';
require_once '../functions.php';
require_once './includes/auth_validate.php';
require_once 'includes/header.php'; 
?>

<div id="page-wrapper">
    <div class="row">
     <div class="col-sm-6"><h2 class="page-header">Footer  Setting</h2></div> 
     <div class="col-sm-6">  
         <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li>Footer Setting</li>
        </ul> 
      </div>     
    </div>

    <?php 
     if(isset($_POST['saveFootSetting']))
     {        
        update_option('footer_section1_title',$_POST['footer_section1_title']);
        update_option('footer_section1_content',$_POST['footer_section1_content']);

        update_option('footer_section2_title',$_POST['footer_section2_title']);
        update_option('footer_section2_content',$_POST['footer_section2_content']);

        update_option('footer_section3_title',$_POST['footer_section3_title']);
        update_option('footer_section3_content',$_POST['footer_section3_content']);

        update_option('footer_section4_title',$_POST['footer_section4_title']);
        update_option('footer_section4_content',$_POST['footer_section4_content']);


       
        echo '<div class="alert alert-success"><strong>Success! </strong> Setting saved successfully</div>'; 
        
     }
    ?>
    <div class="footer-setting-out">
      <form method="post" name="update_footer_setting">
        <div class="row">
            <div class="col-sm-6">
                <h4>Footer widget 1</h4>
                <div class="form-group">
                    <input type="text" name="footer_section1_title" class="form-control" placeholder="Enter section 1 title" value="<?php echo get_option('footer_section1_title');?>" required>                
                </div>
                <div class="form-group">
                    <textarea class="ckeditor" name="footer_section1_content" class="form-control"><?php echo get_option('footer_section1_content');?></textarea>
                </div>          
            </div>

            <div class="col-sm-6">
                <h4>Footer widget 2</h4>
                <div class="form-group">
                    <input type="text" name="footer_section2_title" class="form-control" value="<?php echo get_option('footer_section2_title');?>" placeholder="Enter section 2 title" required>                
                </div>
                <div class="form-group">
                    <textarea class="ckeditor" name="footer_section2_content" class="form-control"><?php echo get_option('footer_section2_content');?></textarea>
                </div>
            </div>
      </div>
      <div class="row">
               <div class="col-sm-6">
                <h4>Footer widget 3</h4>
                <div class="form-group">
                    <input type="text" name="footer_section3_title" class="form-control" value="<?php echo get_option('footer_section3_title');?>" placeholder="Enter section 3 title"  required>                
                </div>
                <div class="form-group">
                    <textarea class="ckeditor" name="footer_section3_content" class="form-control"><?php echo get_option('footer_section3_content');?></textarea>
                </div>
            </div>

               <div class="col-sm-6">
                <h4>Footer widget 4</h4>
                <div class="form-group">
                    <input type="text" name="footer_section4_title" class="form-control" value="<?php echo get_option('footer_section4_title');?>" placeholder="Enter section 4 title" required>                
                </div>
                <div class="form-group">
                    <textarea class="ckeditor" name="footer_section4_content" class="form-control"><?php echo get_option('footer_section4_content');?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                <input type="submit" name="saveFootSetting" value="Save" class="btn btn-primary">
               </div> 
            </div>
        </div>
       </form>
       </div>  
</div>
<script type="text/javascript" src="./lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.editorConfig = function( config ) {
    config.toolbar = [
        { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
        '/',
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        //{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        { name: 'about', items: [ 'About' ] }
    ];
};
</script>
<?php include_once 'includes/footer.php'; ?>