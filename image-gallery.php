<?php require_once('header.php'); ?>
<?php
if(isset($_GET['slug']))
{
   $slug=$_GET['slug'];
}
else
{
  $slug='';
}
$db->where ("slug", $slug);
// $row = $db->get('menu');

?>
<style type="text/css">    
    .innerpagehead{background: url(./image/headingbg.png);  background-position: center center; background-repeat: repeat-x;   padding: 3px; text-align: center; color: #fff;    margin-top: 20px;margin-bottom: 15px; border-radius: 50px; }
.innerpagehead h2{line-height: 20px; font-size: 24px; text-align: left;text-indent: 15px;}
.side1 h2{    font-size: 24px;
    border-bottom: 1px solid #ccc;
    padding: 0 0 15px 0;
    margin-bottom: 17px;
    font-weight: 600;
    color: #c7271b;}
.side1{padding-bottom: 15px;    float: left;  width: 100%;}
.contantSecInr{padding-right: 100px;}
.contantSecInr h1,.contantSecInr h2,.contantSecInr h3,.contantSecInr h4,.contantSecInr h5,.contantSecInr h6,.contantSecInr p,.contantSecInr span,.contantSecInr ul{padding:5px 0;}
.contantSecInr img{padding: 10px 0;}
.side1 p{font-size: 14px;}
.side1 span{font-size:12px; color: #999; display: block;}
.side1 li{list-style: none;}
.side1 ul{margin: 0; padding: 0;}
img{max-width: 100%;}
body{background: #fff;}
</style>
<?php if (isset($page['title']) && !empty($page['banner'])) { ?>
    <div class="innerbanner">
        <img src="./jkmadmin/uploads/banner/<?= $page['banner'] ?>" class="img-responsive">
    </div>
<?php } ?>


<div class="container">
    <div class="row">       
        <div class="col-xs-12">
        	 <div class="page-header">
                <h1><img src="img/icon4.png"> मीडिया गैलरी</h1>
            </div>
           <div class="image-gallery-outer">
           	<!-- <ul id="img-gallery-outer"> -->
              <div class="gal" id="img-gallery-outer">
           	 <?php            	           	  
           	   $gallerys = getGallery();           	   
           	    foreach ($gallerys as $key => $gallery): ?>	                           
                 <a href="<?php echo GALLERY_URL.$gallery['banner'] ?>"   data-src="<?php echo GALLERY_URL.$gallery['banner'] ?>">
                  <img src="<?php echo GALLERY_URL.$gallery['banner'] ?>" alt="" class="img-responsive"/>                  
                </a>
                <!--</li> -->	                          
	         <?php endforeach ?>
	       <!--  </ul> -->
           </div>
        </div>
       </div>
    </div>
</div>
 <link href="<?php echo SITE_URL;?>/css/lightgallery.min.css" rel="stylesheet">
 <script src="<?php echo SITE_URL;?>/js/lightgallery-all.min.js"></script>
 <script src="<?php echo SITE_URL;?>/js/jquery.mousewheel.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function()
   {
 	 $('#img-gallery-outer').lightGallery();
   });
 </script>
<?php require_once('footer.php'); ?>
