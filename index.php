<?php require_once('header.php'); ?>
<link rel="stylesheet" href="./jkmadmin/css/fullcalendar.css" />

 <script src="./jkmadmin/js/jquery-ui.min.js"></script>
 <link href="<?php echo SITE_URL;?>/css/lightgallery.min.css" rel="stylesheet">
 <script src="./jkmadmin/js/moment.min.js"></script>
 <script src="./jkmadmin/js/fullcalendar.min.js"></script>
 <script src="./jkmadmin/js/locale-all.js"></script>
 <script src="<?php echo SITE_URL;?>/js/lightgallery-all.min.js"></script>
 <script src="<?php echo SITE_URL;?>/js/jquery.mousewheel.min.js"></script>
 <script type="text/javascript">   
  $(document).ready(function() 
  {
   var calendar = $('#calendar').fullCalendar({
    locale: 'hi',
    editable:false,
    header:{
     center:'title',
     left:'prev,next today',
     right:'month,agendaWeek,agendaDay'
    },
    events:{
        url:'jkmadmin/load_events.php',  
        type:'GET',
        success:function(res)
        {          
          len = res.length;  
          var arrindex =(len-1);          
          $('.calenar-events-list').html(res[arrindex].htmlres);
        }
    }, 
    selectable:false,
    selectHelper:true,
    editable:false
    });
    $('#home-img-gallery').lightGallery();


  });
   
  </script>
<?php
//Get DB instance. function is defined in config.php
//Get data to pre-populate the form.
 
$query_date = date('d-m-Y',time());
$startDate = date('Y-m-01', strtotime($query_date));
$endDate = date('Y-m-t', strtotime($query_date));

$gallerys = getGallery(4);
$calendarEvents = getCalendarEvents($startDate,$endDate);
$products = getProduct();
$banners = getBanners();

$ol='<ol class="carousel-indicators">';
$slides='<div class="carousel-inner" role="listbox">';
foreach ($banners as $key => $banner) {
    $active='';
    if($key==0){
        $active='active';
    }
    $ol.='<li data-target="#myCarousel" data-slide-to="'.$key.'" class="'.$active.'"></li>';
    $slides.='<div class="item '.$active.'">
                <img src="./jkmadmin/uploads/banners/'.$banner['banner'].'" alt="Image">                    
            </div>';
}
$ol.='</ol>';
$slides.='</div>';
?>
<section class="sliderSec">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!-- <?= $ol ?> -->
        <?= $slides ?>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="newsUpdate">
        <div class="container">
         <marquee>
            <?php echo get_option('news_flash');?>
         </marquee>
        </div> 
        <audio controls autoplay loop>            
            <source src="om-namou-shiby.mp3" type="audio/mpeg">            
        </audio> 
    </div>
    <div class="slider-overlay"></div>
</section>
<section class="aboutSec">
    <div class="container">    
         <h3 class="hm-section-heading"> झाड़खंड महादेव , जयपुर में आपका स्वागत है</h3>
        <div class="row">
            <div class="col-sm-5 col-md-5">
                <img src="img/about.jpg" class="img-responsive jhk-img" style="width:100%" alt="Image">               
            </div>
            <div class="col-sm-7 col-md-7">
            <div class="about-jhk-text">        
              <?php echo get_option('home_page_welcome_content');?> 
            </div>
           </div>
            
        </div>
    </div>
</section>
<section class="liveSec">
    <div class="container">
        <h3 class="hm-section-heading en-head">Live Darshan</h3>
        <div class="row">
            <div class="col-sm-12">
                <div class="live_darshan">
<iframe src="https://g2.ipcamlive.com/player/player.php?alias=5da01cf4792c7" width="800px" height="600px" 
frameborder="0" allowfullscreen></iframe>
                </div>
                <h4 class="text-center" style="color:#980101;"><?php echo get_option('live_darshan_title');?></h4>
            </div> 
        </div>
    </div>
</section>
<section class="online-booking-sec">
    <div class="container">    
        <h3 class="hm-section-heading en-head"><!-- ऑनलाइन दर्ज करना --> Online Booking</h3>
        <div class="row">
            <ul class="online-booking-products">
            <?php foreach ($products as $key => $product): ?>
                <li class="booking-item-block">
                    <h4 class="booking-title"><strong><?= $product['title'] ?></strong></h4>
                    <div class="booking-box">                        
                        <img src="./jkmadmin/uploads/puja/<?= $product['banner'] ?>" class="img-responsive" alt=""/>  
                        <!-- <div class="booknow-hover">
                            <a href="product.php?slug=<?php echo $product['slug'];?>">Book Now</a>
                        </div>   -->                    
                    </div>
                    
                </li>
            <?php endforeach ?>
           </ul> 
        </div>
    </div>
</section>
<section class="eventSec">
    <div class="container">    
        <h3 class="hm-section-heading">महादेव पूजा कार्यक्रम</h3>       
        <div class="row">
            <div class="col-sm-4">
                <h3 class="hm-worship-heading">दिन अनुसूची</h3>
                <div class="notic-list-bg">  
                  <div class="notic-content-inner">
                   <?php echo get_option('mandir_timings');?>                                      
                  </div>
                </div>
            </div>
            <div class="col-sm-4">
             <div id="calendar"></div>
             
            </div>
            <div class="col-sm-4"> 
                <h3 class="hm-worship-heading">सिद्धांत पंचांग</h3>
                <div class="notic-list-bg">                
                    <div class="notic-content-inner">
                    <!-- <marquee behavior="scroll" direction="up" height="225" onmouseout="this.start();" onmouseover="this.stop();" scrollamount="3"> -->
                        <?php if($calendarEvents && count($calendarEvents)>0){?>
                        <ul class="calenar-events-list">
                            <?php foreach ($calendarEvents as $key => $calendarEvent): ?>
                                <li><span class="cal-event-date">दिनांक : <?php echo date('d M, Y',strtotime($calendarEvent['event_date']))?></span>
                                	<b class="cal-event-title"><?= $calendarEvent['event_title'] ?></b>
                                  <?php  if($calendarEvent['details']){ echo '<p>'.$calendarEvent['details'].'</p>'; }?>
                                </li>                               
                            <?php endforeach ?>
                        </ul>
                    <?php } ?>
                    <!-- </marquee> -->
                   </div> 
                </div>
            </div>
        </div>
    </div>    
</section>
<section id="important-notification">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="hm-worship-heading">विनम्र निवेदन</h3>
                <div class="important-appeal">
                    
                    <?php echo get_option('important_request_content');?>
                </div>
            </div>
            <div class="col-sm-6">
                <h3 class="hm-worship-heading">सयन आरती समय</h3>
                <div class="important-notification">                    
                    <?php echo get_option('important_information_content');?>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="worshipSec">
    <div class="container">    
        <div class="row">
            <div class="col-sm-4">
                <h4 class="hm-section-sub-heading">विशेष समाचार</h4>
                <div class="news-block-out">                
                 <marquee behavior="scroll" direction="up" height="290" onmouseout="this.start();" onmouseover="this.stop();" scrollamount="3">
                    <ul>
                        <?php foreach ($news_updates as $key => $news_update): ?>
                            <li><a><?= $news_update['tagline'] ?></a></li>
                            <div class="clearfix"></div>     
                        <?php endforeach ?>
                    </ul>
                 </marquee>
                </div> 
            </div>
            <div class="col-sm-4"> 
                <h4 class="hm-section-sub-heading">विशेष आग्रह</h4>
                <div class="news-block-out">
                  <marquee behavior="scroll" direction="up" height="290" onmouseout="this.start();" onmouseover="this.stop();" scrollamount="3">
                     <?php
                      echo get_option('visesh_request_content');
                     ?>
                 </marquee>
               
               </div> 
            </div>
            <div class="col-sm-4"> 
                <h4 class="hm-section-sub-heading">आने वाले  त्यौहार</h4>
                <div class="news-block-out"> 
            <?php foreach ($upcoming_events as $key => $upcoming_event): ?>
                <div class="row newtabs">
                    <div class="col-xs-4">
                        <img src="./jkmadmin/uploads/upcoming_events/<?= $upcoming_event['banner'] ?>" alt="" class="img-responsive"/>
                    </div>
                    <div class="col-xs-8">
                        <p class="text-justified" ><?= $upcoming_event['tagline'] ?><span style="color:#fff;">Date: <?= $upcoming_event['event_date'] ?></span></p>
                    </div>
                </div>    
                <div class="clearfix"></div>     
            <?php endforeach ?>
             </div>
            </div>
        </div>
    </div>
</section>
<section class="galSec1">
    <div class="container"> 
    
    	<div class="row">
	     <div class="col-sm-6">
	     	<h3 class="hm-section-heading">Gallery</h3> 
	        <div class="home-img-gallery-sec">
               <ul id="home-img-gallery">
	            <?php foreach ($gallerys as $key => $gallery): ?>	            
                <li class="gallery-img-out" data-src="<?php echo GALLERY_URL.$gallery['banner'] ?>">
                 <a href="javascript:void(0);">
                  <img src="<?php echo GALLERY_URL.$gallery['banner'] ?>" alt="" class="img-responsive"/>
                  <div class="hover-box"><div class="hover-sicon"><img src="./img/zoom.png"></div>
                </a>
                </li>	                          
	            <?php endforeach ?>
               </ul> 
	        </div>
            <div class="clearfix"></div>
	        <a class="view-more" href="<?php  echo SITE_URL.'/image-gallery.php';?>"><span>View more</span></a>
	     </div>  
	     <div class="col-sm-6">  
	     <h3 class="hm-section-heading">Mahadev Darshan</h3> 
	     	 <iframe class="single-videosec" src="https://www.youtube.com/embed/Ya4uSmboJxo" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	     	 <a href="<?php echo SITE_URL.'/video-gallery.php';?>" class="view-more"><span>View more</span></a>
	     </div>
	   </div>  
   </div>
</section>

<section class="feedSec">
    <div class="container">
        <h3 class="hm-section-heading">Get in touch with us</h3>
        <div class="row">
            <div class="col-md-6">
                <!-- <h3 class="hm-section-heading">Found Us on Map</h3> -->
              <div class="hm-map-outer">
                <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3557.688037647237!2d75.75368451439613!3d26.913394066541162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db481ea878e47%3A0xf41670db6e8868c7!2sJharkhand+Mahadev+Mandir!5e0!3m2!1sen!2sin!4v1536227020830" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>  
            </div>
            <div class="col-md-6">
                <!-- <h3 class="hm-section-heading">Contact Us/ Feedback</h3> -->
                <div class="hm-contact-frm-out">
                    <form onsubmit="return contactForm(this);">                        
                            <div class="col-xs-6">
                                <div class="form-group">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name"/>
                                </div>  
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name"/>
                                </div>
                            </div>                        
                        
                            <div class="col-xs-6">
                                <div class="form-group">
                                  <input type="text" name="state" class="form-control" placeholder="State"/>
                                </div>  
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                 <input type="text" name="country" class="form-control" placeholder="Country"/>
                                </div>
                            </div>
                        
                        
                            <div class="col-xs-6">
                                <div class="form-group">
                                <div class="checkbox">
                                    <!-- <label><input type="checkbox" value="">I'm not a robot</label> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                    <img src="img/logo_48.png" style="display:inline;"><br>
                                    <span>reCAPTCHA</span> -->
                                    <img src="captcha.php">
                                </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                <input type="text" name="captcha" class="form-control" placeholder="Enter Code"/>
                                </div>
                            </div>
                                              
                        <div class="col-xs-12">
                            <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 text-right">
                            <input type="submit" class="btn btn-success" value="Submit"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="subSec">
    <div class="container">    
        <div class="row">    
            <div class="col-sm-4">
                <h4>We Accept</h4>
                <img src="img/payment-gateway.png" class="img-responsive" alt=""/>
            </div>
            <div class="col-sm-4">
                <h4>Socail Connect</h4>
                <ul>
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                    <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                    <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <h4>अपडेट के लिए सब्सक्राइबर</h4>
                <div class="form-horizontal">
                    <form method="post" onsubmit="return subscribes(this);">
                        <div class="form-group">
                            <div class="col-xs-7">
                                <input type="email" name="email" class="form-control" placeholder="Enter Email"/>
                            </div>
                            <div class="col-xs-5">
                                <input type="submit" class="btn btn-success" value="Submit"/>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->

<style type="text/css">
/*popup start*/
.modal .modal-dialog{margin: 100px auto;}
.body-message p{padding: 0 0 10px 0;}
.modal h4{ font-size: 18px; font-weight: 600;}
.modal textarea{min-height: 150px; color: #333;}
.modal select{color: #333;}
.modal select option{color: #333;}
.modal-footer .signup_social1{ padding-top: 20px;  width: 100%; margin: auto; float: left;}

.modal-header{ background: #fe7e00; color: #fff;}
.modal-header button{color: #fff; opacity: 1;}

.feedback_button button{ padding: 10px 20px;  border-radius: 3px;}
.btn-orange { background: #f68734; color: #fff;}
.btn-orange:hover,.btn-orange:focus{background:transparent;border-color:#c74814;color:#c74814}
</style>

<!-- ----------------------- -->

<?php require_once('footer.php'); ?>
