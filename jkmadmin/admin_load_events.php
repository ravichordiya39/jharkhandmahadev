<?php
require_once './config/config.php';
$start = filter_input(INPUT_GET, 'start');
$end = filter_input(INPUT_GET, 'end');
$data = array();

$query = "SELECT * FROM calendar_events where event_date BETWEEN '$start' AND '$end'";
$result = $db->query($query);
foreach($result as $row)
{
  $evId = $row['id'];
  $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["event_title"],
  'start'   => $row["event_date"],
  'url'   => 'edit_calendar_event.php?id='.$evId,
  'className'=>'cal-event-details'  
  );
}
echo json_encode($data);
?>