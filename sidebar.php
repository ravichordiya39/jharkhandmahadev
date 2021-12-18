<?php
$pujaone = getProductOne();
$videoone = getVideosOne();
?>
<div class="sidebar-outer">
 <div class="side1">
    <?php      
     if(isset($page) && isset($page['side_banner1']) && !empty($page['side_banner1']))
     {
     	echo '<img src="'.BANNER_URL.'/'.$page['side_banner1'].'">';
     }

     if(isset($page) && isset($page['side_banner2']) && !empty($page['side_banner2']))
     {
     	echo '<img src="'.BANNER_URL.'/'.$page['side_banner2'].'">';
     }

     if(isset($page) && isset($page['side_banner3']) && !empty($page['side_banner3']))
     {
     	echo '<img src="'.BANNER_URL.'/'.$page['side_banner3'].'">';
     }
    ?>
 </div>
<div class="clearfix"></div>
</div>

