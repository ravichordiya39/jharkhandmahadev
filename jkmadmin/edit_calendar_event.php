<?php 
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include_once 'includes/header.php';
$db = getDbInstance();
$evData=array();

if(isset($_GET['id']) && !empty($_GET['id']))
{
  $evID = trim($_GET['id']);
  $query = "SELECT * FROM calendar_events where id='$evID'";
  $evData = $db->query($query);  
  if(count($evData)<1)
  {
    echo '<script type="text/javascript">window.location="calendar.php";</script>';
  }
  $evData=$evData[0];
}
else
{
  echo '<script type="text/javascript">window.location="calendar.php";</script>';
}


//Store Data
if(isset($_POST['eventSub']))
{
  $data_to_store = filter_input_array(INPUT_POST);    
  $data_to_store['event_date'] =date('Y-m-d',strtotime($data_to_store['event_date']));
  $db->where('event_date',$data_to_store['event_date']);

 unset($data_to_store['eventSub']);
 $db->where('id',$evID);
 $last_id = $db->update('calendar_events',$data_to_store);     
  if($last_id)
  {        
    $_SESSION['success']='Event successfully updated';
    echo '<script type="text/javascript">setTimeout(function(){window.location="calendar.php";},2000)</script>';      
  }
}
elseif(isset($_POST['eventDelete']))
{
  // die($evID);
  $db->where('id',$evID);
  $last_id = $db->delete('calendar_events');     
  if($last_id)
  {        
    $_SESSION['success']='Event successfully deleted';
    //echo '<script type="text/javascript">window.location="calendar.php";</script>';      
    echo '<script type="text/javascript">setTimeout(function(){window.location="calendar.php"},2000)</script>';      
  }
}

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header"><i class="fa fa-calendar"></i> Edit Event</h1>
        </div>
        <div class="col-lg-6" style="">
            <div class="page-action-links text-right">
	            <a href="calendar.php">
	            	<button class="btn btn-success"> View Calendar</button>
	            </a>
            </div>
        </div>
    </div>
    <?php include('./includes/flash_messages.php') ?>

    <div class="panel panel-default" style="width:600px; max-width:100%;">
    	<div class="panel-heading">
    		Add Event
    	</div>
    	<div class="panel-body">
    		<form method="post" id="add-event">
          <div class="row">
            <div class="col-sm-8 col-md-8">
              <div class="form-group">
                <label>Event title</label>
                <input type="text" name="event_title" class="form-control" placeholder="Enter event title" 
                value="<?php if(isset($evData['event_title'])){echo $evData['event_title']; }?>" required>
              </div>
            </div>
            <div class="col-sm-4 col-md-4">
              <div class="form-group">
                <label>Event Date</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" name="event_date" class="form-control eventdate" value="<?php if($evData['event_date']){echo date('m/d/Y',strtotime($evData['event_date'])); }?>" placeholder="Event date" required>
                 </div> 
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Details</label>
                <?php /*<input type="text" name="details" class="form-control" value="<?php if(isset($evData['details'])){echo $evData['details']; }?>" placeholder="Details"> */ ?>
                <textarea name="details" rows="3" class="form-control"  placeholder="Details"><?php if(isset($evData['details'])){echo $evData['details']; }?></textarea>
              </div>
            </div>
            <div class="col-xs-12 text-right">              
              <input type="submit" name="eventSub" value="Save Event" class="btn btn-primary">
              <input type="submit" name="eventDelete" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?')">
            </div>
          </div>
        </form>
    	</div>
    </div>

 </div> <!--# page wrapper-->
 <script>

  $(document).ready(function() 
  {
    $('.eventdate').datepicker();   
  });

</script>
<?php include_once './includes/footer.php'; ?>
