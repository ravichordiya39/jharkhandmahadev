<?php
session_start();
require_once './config/config.php';
require_once './includes/auth_validate.php';

//serve POST method, After successful insert, redirect to customers.php page.

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $data_to_store = filter_input_array(INPUT_POST);
    //Insert timestamp
    $data_to_store['created_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $last_id = $db->insert('news_updates', $data_to_store);   

    if($last_id)
    {
    	$_SESSION['success'] = "News added successfully!";
    	header('location: news_updates.php');
    	exit();
    }  
}
//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;
require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
  <div class="col-sm-6"><h2 class="page-header">Add news</h2></div>
  <div class="col-sm-6">
    <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li><a href="news_updates.php">News Manager</a></li>
      <li>Add News</li>
    </ul>
  </div> 
</div>

    <form class="form" action="" method="post"  id="news_updates_form" enctype="multipart/form-data">

       <?php  include_once('./forms/news_update_form.php'); ?>

    </form>

</div>





<script type="text/javascript">

$(document).ready(function(){

   $("#news_updates_form").validate({

       rules: {

            tagline: {

                required: true,

                minlength: 10,

                maxlength: 255

            }  

        }

    });

});

</script>



<?php include_once 'includes/footer.php'; ?>