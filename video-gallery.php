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


$videos = getVideos();
?>

<?php if (isset($page['title']) && !empty($page['banner'])) { ?>
    <div class="innerbanner">
        <img src="./jkmadmin/uploads/banner/<?= $page['banner'] ?>" class="img-responsive">
    </div>
<?php } ?>


<div class="container">
    <div class="row">       
        <div class="col-sm-8 col-xs-12">
        	 <div class="page-header">
                <h1><img src="img/icon4.png"> वीडियो गैलरी</h1>
            </div>
           <div class="image-gallery-outer">
           	<ul id="video-gallery-outer">
           	 <?php               
             if($videos && count($videos)>0)           	          	   
             {
           	  foreach ($videos as $videoData): 
                if(!empty($videoData['video']))
                {
                 ?>	            
                 <li class="gallery-video-out">                 
                  <iframe class="gallery-video" src="<?php echo $videoData['video']; ?>" frameborder="0" 
                     allow="autoplay; encrypted-media" allowfullscreen></iframe>
                 </li>	                          
	              <?php 
                }
              endforeach; 
             }
           ?>
	        </ul>
           </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <?php include('sidebar.php'); ?>
        </div>
    </div>
</div>
 
<?php require_once('footer.php'); ?>
