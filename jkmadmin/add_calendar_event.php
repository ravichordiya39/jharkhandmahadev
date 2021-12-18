<?php 
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include_once 'includes/header.php';

?>
<div id="page-wrapper">
  <?php 
   $db = getDbInstance();
  //Store Data
  if(isset($_POST['eventSub']))
  {
    $data_to_store = filter_input_array(INPUT_POST);  
    $event_date =$data_to_store['event_date'];
   $data_to_store['event_date'] = date('Y-m-d',strtotime($event_date));
   // $data_to_store['event_date'] =date('Y-m-d',strtotime($data_to_store['event_date']));

    $db->where('event_date',$data_to_store['event_date']);

    $eventExt = $db->getOne("calendar_events");   
    
    if(count($eventExt)>0)
    {
      $_SESSION['failure'] = "Event already at ".$event_date;   
    }
    else
    {
       unset($data_to_store['eventSub']);
       
       $last_id = $db->insert('calendar_events',$data_to_store);     
        if($last_id)
        {        
           $_SESSION['success']='Event successfully added';        
          echo '<script type="text/javascript">setTimeout(function(){window.location="calendar.php"},2000)</script>';              
      }
    }
  }

  ?>
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header"><i class="fa fa-calendar"></i> Add Event</h1>
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
            <div class="col-sm-4 col-md-4">
              <div class="form-group">
                <label>Event title</label>
                <input type="text" name="event_title" class="form-control" placeholder="Enter event title" value="<?php if(isset($_POST['event_title'])){echo $_POST['event_title']; }?>" required>
              </div>
            </div>
            <div class="col-sm-4 col-md-3">
              <div class="form-group">
                <label>Event Date</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" name="event_date" class="form-control eventdate" value="<?php if(isset($_POST['event_date'])){echo $_POST['event_date']; }?>" placeholder="Event date" required>
                 </div> 
              </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-group">
                <label>Details</label>
                <?php /*<input type="text" name="details" class="form-control" value="<?php if(isset($_POST['details'])){echo $_POST['details']; }?>" placeholder="Details">*/?>
                <textarea name="details" rows="3" class="form-control" placeholder="Details"><?php if(isset($_POST['details'])){echo $_POST['details']; }?></textarea>
              </div>
            </div>
            <div class="col-xs-12 text-right">
              <input type="submit" name="eventSub" value="Save Event" class="btn btn-primary">
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
