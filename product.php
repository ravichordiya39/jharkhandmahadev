<?php require_once('header.php'); 
if(isset($_GET['slug']) && !empty($_GET['slug']))
{
    $slug=$_GET['slug'];
}else
{
  echo '<script type="text/javascript">window.location="'.SITE_URL.'";</script>';
}
$db->where ("slug", $slug);
// $row = $db->get('menu');
$product = $db->getOne("products");
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
<div class="container">
    <div class="row">       
        <div class="col-sm-8 col-md-9 col-xs-12">
            <div class="page-header">
                <h1><img src="img/icon4.png"> <?php echo $product['title']; ?></h1>
            </div>
            <div class="product-content" style="overflow: hidden;">
               <div class="row"> 
                <div class="col-sm-8">
                  <?php 
                    if (isset($product['title']) && !empty($product['banner'])) { ?>
                        <div class="innerbanner">
                            <img src="./jkmadmin/uploads/puja/<?= $product['banner'] ?>" class="img-responsive">
                        </div>
                    <?php } 

                    if(isset($product['product_details'])) 
                    {
                      echo $product['product_details'];
                     } 
                  ?>
                </div>
                <div class="col-sm-4">
                    <ul class="product-details">
                        <li><label> बुकिंग  आरम्भ   तिथि</label><span><?php echo date('d-m-Y',strtotime($product['booking_start_date']));?></span>
                        </li>
                        <li><label>बुकिंग  की अंतिम  तिथि </label><span><?php echo date('d-m-Y',strtotime($product['booking_end_date']));?></span>
                        </li>
                        <li class="booking-amount"><label>बुकिंग राशि </label> <span class="price">Rs. <?php echo number_format($product['price'],0);?></span></li>
                    </ul>

                    <div class="product-note">
                        <?php echo $product['product_note'];?>
                    </div>

                    <button class="btn btn-success">बुक करें </button>
                </div>

               </div>
            </div>
        </div>
        <div class="col-sm-4 col-md-3 col-xs-12">
            <?php include('sidebar.php'); ?>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>
