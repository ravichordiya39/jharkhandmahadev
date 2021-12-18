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
    //$data_to_store['created_at'] = date('Y-m-d H:i:s');
    $db = getDbInstance();
    $last_id = $db->insert ('menu', $data_to_store);
    
    if($last_id)
    {
    	$_SESSION['success'] = "Menu added successfully!";
    	header('location: menu.php');
    	exit();
    }  
}
$pages = $db->get("pages");
//We are using same form for adding and editing. This is a create form so declare $edit = false.
$edit = false;

require_once 'includes/header.php'; 
?>
<div id="page-wrapper">
<div class="row">
    <div class="col-sm-6">
      <h2 class="page-header">Add Menu</h2>
    </div>
    <div class="col-sm-6">  
     <ul class="breadcrumb">
       <li><a href="index.php">Home</a></li>
       <li><a href="menu.php">Menu Manager</a></li>
       <li>Add Menu</li>
    </ul>
   </div>    
</div>
    <form class="form" action="" method="post"  id="menu_form" enctype="multipart/form-data">
       <?php  include_once('./forms/menu_form.php'); ?>
    </form>
</div>


<script type="text/javascript">
$(document).ready(function(){
   $("#menu_form").validate({
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