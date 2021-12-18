<?php

session_start();

require_once './config/config.php';

require_once './includes/auth_validate.php';





//serve POST method, After successful insert, redirect to customers.php page.

if ($_SERVER['REQUEST_METHOD'] == 'POST') 

{

    //Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.

    $data_to_store = filter_input_array(INPUT_POST);



    //Insert timestamp

    $data_to_store['created_at'] = date('Y-m-d H:i:s');

    $db = getDbInstance();

    $last_id = $db->insert ('videos', $data_to_store);

    

    if($last_id)

    {

    	$_SESSION['success'] = "Video added successfully!";

    	header('location: videos.php');

    	exit();

    }  

}



//We are using same form for adding and editing. This is a create form so declare $edit = false.

$edit = false;



require_once 'includes/header.php'; 

?>

<div id="page-wrapper">

<div class="row">
 <div class="col-sm-6">
     <h2 class="page-header">Add video</h2> </div>
   <div class="col-sm-6">
      <ul class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="videos.php">Video Manager</a></li>
          <li>Add Video</li>
        </ul>
   </div>
 </div>

    <form class="form" action="" method="post"  id="video_form" enctype="multipart/form-data">

       <?php  include_once('./forms/video_form.php'); ?>

    </form>

</div>





<script type="text/javascript">

$(document).ready(function(){

   $("#page_form").validate({

       rules: {

            title: {

                required: true,

                minlength: 3

            },

            video: {

                required: true

            },   

        }

    });

});

</script>



<?php include_once 'includes/footer.php'; ?>