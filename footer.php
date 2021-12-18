
        <div class="sideBtns">
            <ul>
                <li><a href="https://jharkhandmahadev.in/contact-us.php"><i class="fa fa-commenting"></i>Contact Us</a></li>
                <li><a href="https://www.google.com/maps/dir//Jharkhand+Mahadev+Mandir,+Queens+Rd,+Vaishali+Nagar,+Jaipur,+Rajasthan+302021/@26.913389,75.755873,15z/data=!4m8!4m7!1m0!1m5!1m1!1s0x396db481ea878e47:0xf41670db6e8868c7!2m2!1d75.7558732!2d26.9133893?hl=en-GB" target="_blank"><i class="fa fa-map-o"></i>Direction</a></li>
                <li><a href="https://g2.ipcamlive.com/player/player.php?alias=5da01cf4792c7" target="_blank"><i class="fa fa-users"></i>Darshan</a></li>
            </ul>
        </div>
        <footer class="site-footer-out">
            <div class="container footerblock">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <h4 class="foot-title"><?php  echo get_option('footer_section1_title');?></h4>
                       <div class="facebook-new-plugin">
                             <div class="fb-page" data-href="https://www.facebook.com/jharkhandmahadevjpr" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/jharkhandmahadevjpr" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/jharkhandmahadevjprhttps://www.facebook.com/jharkhandmahadevjpr">Facebook</a></blockquote></div>                            
                        </div><br>
                         <?php //echo get_option('footer_section1_content');?>
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
                    <div class="col-md-3 col-sm-6">
                        <h4 class="foot-title"><?php  echo get_option('footer_section2_title');?></h4>
                        <?php echo get_option('footer_section2_content');?>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4 class="foot-title"><?php  echo get_option('footer_section3_title');?></h4>
                        <?php echo get_option('footer_section3_content');?>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <h4 class="foot-title"><?php  echo get_option('footer_section4_title');?></h4>
                        <?php //echo get_option('footer_section4_content');?>
                        <p><b>Jharkhand Mahadev Mandir</b></p>
                        <table cellpadding="5" class="contact-info-tab" cellspacing="0">                            
                            <tr>
                               <td width="40"><i class="fa fa-map-marker"></i></td> 
                               <td>Queens Road, Vaishali Nagar Jaipur, Rajasthan 302021</td>
                            </tr>
                            <tr>
                               <td><i class="fa fa-phone"></i></td> 
                               <td>0141-2350589</td>
                            </tr>
                            <tr>
                               <td><i class="fa fa-whatsapp"></i></td> 
                               <td>9828084970, 8005789340</td>
                            </tr>
                             <tr>
                               <td><i class="fa fa-envelope-o"></i></td> 
                               <td>jharkhandmahadev@gmail.com</td>
                            </tr>
                            <tr>
                              <td valign="top"><i class="fa fa-globe"></i></td>
                              <td>jharkhandmahadev.in<br>jharkhandnath.com</td>
                            </tr>
                        </table>
                       
                    </div>
                </div>
            </div>
            <div class="footerBottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            
                    <div class="copyright_container d-flex flex-sm-row flex-column">
                        <div style="text-align: center;" class="copyright_content col-md-12">
                            <p>Copyright @ 1918-2018 Jharkhand Mahadev |All Right Reserved |<a style="color: #980101; border-bottom: 0"href="http://dzoneindia.co.in/" target="_blank">Website Designed & Developed By DZONE INDIA.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <a id="back-to-top" href="#" class="btn btn-success btn-lg back-to-top" role="button" title="Click to return on the top page"><span class="glyphicon glyphicon-chevron-up"></span></a>

        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/owl.carousel.js"></script>
        <style type="text/css">
            .back-to-top {
                cursor: pointer;
                position: fixed;
                bottom: 20px;
                right: 20px;
                display:none;
            }

        </style>
		
		
		<!-- search model start-->
		 <div class="modal fade" id="searchmodel" role="dialog">
    <div class="modal-dialog search-box-main">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Search</h4>
        </div>
        <div class="modal-body search-box">
         <form>
            <div class="input-group">
              <input id="search" type="text" class="form-control" placeholder="Type Here To Search">
              <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            </div>
          </form>
        </div>
      </div>
      
    </div>
  </div>
		
		<!-- search model end-->
		
        <script type="text/javascript">
            $(document).ready(function(){
                 $(window).scroll(function () {
                        if ($(this).scrollTop() > 50) {
                            $('#back-to-top').fadeIn();
                        } else {
                            $('#back-to-top').fadeOut();
                        }
                    });
                    // scroll body to 0px on click
                    $('#back-to-top').click(function () {
                        //$('#back-to-top').tooltip('hide');
                        $('body,html').animate({
                            scrollTop: 0
                        }, 800);
                        return false;
                    });
                    
                    //$('#back-to-top').tooltip('show');

            });

            var header = document.getElementById("myHeader");
            var sticky = header.offsetTop;
            window.onscroll = function () 
            {
              header.classList.add("sticking");               
              myFunction();
            };
            function myFunction() 
            {
                if (window.pageYOffset > sticky) {
                    header.classList.remove("sticking");
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticking");
                    header.classList.remove("sticky");
                }
            }
        </script>
        <script type="text/javascript">
            $('#mySlider').owlCarousel({
                loop: true,
                margin: 10,
                autoPlay: 5000,
//                autoPlay: true,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
            $('#mySlider1').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        </script>
        <script type="text/javascript">
            function subscribes($this){
                var email= $this.elements['email'].value;
                if (email==null || email=='') {
                    alert('Please fill email.');
                    return false;
                }
                $.ajax({
                       type: "POST",
                       url: './subscribe.php',
                       dataType: 'json',
                       data: {email:email}, // serializes the form's elements.
                       success: function(data)
                       {
                           alert(data.msg); // show response from the php script.
                           if(data.status==true || data.status==1){
                                $this.reset();
                           }
                       }
                });
                return false;
            }

            function contactForm($this)
            {
                var first_name= $this.elements['first_name'].value;
                var last_name= $this.elements['last_name'].value;
                var state= $this.elements['state'].value;
                var country= $this.elements['country'].value;
                var captcha= $this.elements['captcha'].value;
                var message= $this.elements['message'].value;
                /*if (email==null || email=='') {
                    alert('Please fill email.');
                    return false;
                }*/

                $.ajax({
                       type: "POST",
                       url: './contactus.php',
                       dataType: 'json',
                       data: {first_name:first_name,last_name:last_name,state:state,country:country,captcha:captcha,message:message}, // serializes the form's elements.
                       success: function(data)
                       {
                           alert(data.msg); // show response from the php script.
                           if(data.status==true || data.status==1){
                                $this.reset();
                           }
                       }
                });

                return false;
            }
        </script>

    </body>
</html>