<?php require_once('header.php'); ?>
<?php
if(isset($_GET['slug'])){
    $slug=$_GET['slug'];
}else{
    $slug='';
}
$db->where ("slug", $slug);
// $row = $db->get('menu');
$page = $db->getOne("pages");
//print_r($page);
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
       <div class="container"> 
        <img src="./jkmadmin/uploads/banner/<?= $page['banner'] ?>" class="img-responsive">
       </div>
    </div>
<?php } ?>


<div class="container">
    <div class="row">       
        <div class="<?php if(!empty($page['page_type']) && $page['page_type']=='fullwidth'){ echo 'col-xs-12'; }else{echo 'col-sm-8';}?>">
            <div class="page-header">
                <h1><img src="img/icon4.png"> <?php echo $page['title']; ?></h1>
            </div>
            <div class="contantSecInr" style="overflow: hidden;">
                <?php if (isset($page['content'])) {
                    echo $page['content'];
                }else{ ?>
                    <div class="innerpagehead"><h2>Page not found.</h2></div>
                <?php } ?>
            </div>
        </div>
        <?php 
         if($page['page_type']!='fullwidth')
         {
        ?>
        <div class="col-sm-4 col-xs-12">            
            <?php include('sidebar.php'); ?>
        </div>
    <?php } ?>
    </div>
</div>
<?php require_once('footer.php'); ?>
