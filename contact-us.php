<?php require_once('header.php'); ?>
<div class="container" style="font-family:'Noto Sans', sans-serif;">
    <div class="row">       
        <div class="col-sm-8 col-xs-12">
            <div class="page-header">
                <h1><img src="img/icon4.png"> Contact Us</h1>
            </div>
            <div id="contact">
              <div class="row">

               <div class="col-md-7">                
               <div class="form">
                <div id="sendmessage">Your message has been sent. Thank you!</div>
                <div id="errormessage"></div>
                <form action="" method="post" role="form" class="contactForm">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                    <div class="validation"></div>
                  </div>
                  <div class="form-group">
                  <div class="text-left"><button type="submit">Send Message</button></div>
                </div>
                </form>
              </div> 
            </div>
            <div class="col-md-5">
               <div class="info">
               <div>                
                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                <p style="font-size:18px;color:inherit;">+91 9828084970<br> +91 8005789340</p>
                
               </div> 
                <div>
                  <i class="fa fa-map-marker"></i>
                  <p> Jharkhand Mahadev Mandir <br>Queens Road, Vaishali Nagar Jaipur, Rajasthan, India 302021</p>
                </div>

                <div>
                  <i class="fa fa-envelope"></i>
                  <p>info@jharkhandmahadev.in</p>
                </div>

                <div>
                  <i class="fa fa-phone"></i>
                  <p>+91 0141-2350589</p>
                </div>
              </div>

            
            </div>
           </div> 
          </div>
         </div> 
        <div class="col-sm-4 col-xs-12">
            <?php include('sidebar.php'); ?>
        </div>
    </div>
</div>
<script src="contactform/contactform.js"></script>
<?php require_once('footer.php'); ?>
