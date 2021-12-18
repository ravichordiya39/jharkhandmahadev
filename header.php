<?php        
session_start();
require_once './load.php';
$upcoming_events = getUpcomingEvents();
$news_updates = getNewsUpdates();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>झारखंड महादेव</title>
        <meta http-equiv="Content-Type" content="charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="https://fonts.googleapis.com/css?family=Muli|Raleway" rel="stylesheet"> -->
        <link href="https://fonts.googleapis.com/css?family=Karma:500,600|Noto+Sans" rel="stylesheet">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link href="./css/font-awesome.min.css" rel="stylesheet">
        <link href="./css/owl.carousel.css" rel="stylesheet">        
        <script src="./js/jquery.min.js"></script>
        <link href="./css/homestyle.css" rel="stylesheet" type="text/css"/>
        <link href="./css/style.css" rel="stylesheet" type="text/css"/>        
    </head>

    <body>
      <?php
        $topmenu=getMainMenu();
        if(isset($_GET['slug']))
        {
          $slug=$_GET['slug'];
        }
        else
        {
          $slug='home';
        }
        ?>
        <div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <header>
            <div class="topHead">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-xs-5 rmp-right">
                            <ul class="social-icon">
                                <li><a href="<?php echo get_option('facebook_page_link');?>" target="_blank">
                                    <i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?php echo get_option('twitter_page_link');?>" target="_blank">
                                    <i class="fa fa-twitter"></i></a></li>
                                <li>
                                    <a href="<?php echo get_option('instagram_page_link');?>" target="_blank">
                                    <i class="fa fa-instagram"></i></a>
                                </li>
                                
                                <li><a href="<?php echo get_option('youtube_page_link');?>" target="_blank">
                                    <i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3 col-md-4 col-xs-7">
                          <ul class="live-darshan-n-srch">
                            <li><a href="https://g2.ipcamlive.com/player/player.php?alias=5da01cf4792c7" class="button live-darshan-btn" target="_blank"> 
                            	<img src="img/icon4.png"> Live Darshan</a></li>
                          </ul>
                        </div>

                        <div class="col-sm-6 col-md-6 col-xs-12">
                            <ul class="list-right">   

                                <li><a href="contact-us.php">Contact</a></li>                               
                                <li><a href="https://www.google.com/maps/dir//Jharkhand+Mahadev+Mandir,+Queens+Rd,+Vaishali+Nagar,+Jaipur,+Rajasthan+302021/@26.913389,75.755873,15z/data=!4m8!4m7!1m0!1m5!1m1!1s0x396db481ea878e47:0xf41670db6e8868c7!2m2!1d75.7558732!2d26.9133893?hl=en-GB" target="_blank" rel="noreferrer noopener">Get Direction</a></li>                                
                                <?php 
                                   if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']==true) 
                                   {

                                     if(in_array($_SESSION['admin_type'], ['admin','super'])) 
                                       { ?>
                                         <li><a href="<?php echo ADMIN_URL; ?>">Downloads</a></li>
                                 <?php }else
                                        { ?>
                                        <li><a href="./dashboard.php">Downloads</a></li>
                                <?php }
                                 }else{ ?>
                                    <li><a href="#" data-toggle="modal" data-target=".loginpoup">Downloads</a></li>
                                <?php } ?>
                                <?php 
                                if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true ) 
                                {
                                    if (in_array($_SESSION['admin_type'], ['admin','super'])) 
                                      { ?>
                                        <li><a href="<?php echo ADMIN_URL; ?>">Dashboard</a></li>
                                    <?php }else
                                    { ?>
                                        <li><a href="./dashboard.php">Dashboard</a></li>
                                <?php }
                                 }else{ ?>
                                  
                                    <li><a href="login-signup.php" >Login / Sign up </a></li>

                                <?php } ?>
                                <li class="hidden-xs">
                                <div class="search-btn-sec">
                                 <a class="searbtn" data-toggle="modal" data-target="#searchmodel">
                                  <i class="fa fa-search" aria-hidden="true"></i> 
                                  <!-- <span class="hidden-xs">Search</span> --> </a>
                                </div>
                              </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-inverse" id="myHeader">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
                        <!-- <a class="navbar-brand slogo" href="index.php"><img src="img/logo-350x51-1.png" alt="Jharkhand Mahadev"></a> -->
                        <a class="navbar-brand slogo" href="index.php"><img src="img/logo.png" alt="Jharkhand Mahadev"></a>                        
                    </div>

                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right main-menu">
                            <li <?= ($slug=='home')?'class="active"':'' ?>><a href="./index.php">Home</a></li>
                            <?php 
                            foreach ($topmenu as $key => $menu) 
                            { ?>
                                <li class="<?php if($slug==$menu['slug']){ echo 'active ';}  if($slug==$menu['slug']){ echo 'active';} ?>">
                                    <?php
                                    if($menu['type']=='link')
                                    {
                                       echo '<a href="'.$menu['custom_link'].'">'.$menu['title'].'</a>'; 
                                    } 
                                    elseif ($menu['type']=='menu')
                                    {
                                       echo '<a href="javascript:void(0)">'.$menu['title'].'</a>'; 
                                    }
                                    else
                                    {
                                       echo '<a href="./page.php?slug='.$menu['slug'].'">'.$menu['title'].'</a>'; 
                                    }
                                    ?>
                                                               
                                 <?php 
                                  if(isset($menu['children']) && count($menu['children'])>0)
                                  {
                                    $submenuArr = $menu['children'];
                                    echo '<ul class="sub-menu">';
                                      foreach($submenuArr as $submenu) 
                                      { ?>
                                          <li <?= ($slug==$submenu['slug'])?'class="active"':'' ?>>
                                            <?php
                                                if($submenu['type']=='link')
                                                {
                                                   echo '<a href="'.$submenu['custom_link'].'">'.$submenu['title'].'</a>'; 
                                                } 
                                                elseif ($submenu['type']=='menu')
                                                {
                                                   echo '<a href="javascript:void(0)">'.$submenu['title'].'</a>'; 
                                                }
                                                else
                                                {
                                                   echo '<a href="./page.php?slug='.$submenu['slug'].'">'.$submenu['title'].'</a>'; 
                                                }
                                                ?>
                                           
                                            </a>
                                          </li>
                                      <?php 
                                      }
                                    echo '</ul>';
                                  }
                                 ?>
                                </li>
                            <?php 
                            }
                           ?>
                            
                            <!-- <li><a href="./page.php">Pilgrim Services</a></li>
                            <li><a href="./page.php">Online Booking</a></li>
                            <li><a href="./page.php">Media</a></li>
                            <li><a href="./page.php">Tourism</a></li>
                            <li><a data-toggle="modal" data-target="#searchmodel">Search</a></li> -->
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <?php
                //print_r($_SESSION);
                if(isset($_SESSION['login_failure'])){ ?>
                <div class="alert alert-danger alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']);?>
                </div>
                <?php } ?>
                <?php
                //print_r($_SESSION);
                if(isset($_SESSION['success'])){ ?>
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']);?>
                </div>
                <?php } ?>
            </div>
        </header>

