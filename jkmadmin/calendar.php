<?php 
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
include_once 'includes/header.php';
?>
<link href='./css/fullcalendar.min.css' rel='stylesheet' />
<script src='./js/moment.min.js'></script>
<script src='./js/fullcalendar.min.js'></script>
<script src="./js/locale-all.js"></script>
<div id="page-wrapper">
  <div class="row">
      <div class="col-lg-6">
          <h1 class="page-header"><i class="fa fa-calendar"></i> Calendar Event Manager</h1>
      </div>
      <div class="col-lg-6" style="">
          <div class="page-action-links text-right">
            <a href="add_calendar_event.php">
            	<button class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Event </button>
            </a>
          </div>
      </div>
  </div>
    
    <?php 
    if(isset($_SESSION['success'])){echo $_SESSION['success'];}
    //include('./includes/flash_messages.php') 
    ?>

    <div class="panel panel-default">
    	<div class="panel-heading">
    		Calender
    	</div>
    	<div class="panel-body">
    		<div id="calendar" class="event-calendar"></div>
    	</div>
    </div>
 </div> <!--# page wrapper-->
 
 <script type="text/javascript">
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      //defaultDate: '2019-01-12',
      locale: 'hi',
      header:{
	     center:'title',
	     left:'prev,next today',
	     right:'month,agendaWeek,agendaDay'
	   },
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: 'admin_load_events.php',
      selectable:false,
      selectHelper:true,
      editable:false
    });

  });

</script>
<?php include_once './includes/footer.php'; ?>
