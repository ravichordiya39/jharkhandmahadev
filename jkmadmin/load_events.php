<?php
require_once './config/config.php';

$start = filter_input(INPUT_GET, 'start');
$end = filter_input(INPUT_GET, 'end');
//$connect = new PDO('mysql:host=localhost;dbname=dzonein2_jhar', 'root', '');
$data = array();
/*
$query = "SELECT * FROM events WHERE start_event BETWEEN '$start' AND '$end' OR end_event BETWEEN '$start' AND '$end' ORDER BY id";

$result = $db->query($query);

//$statement->execute();

//$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);*/
$query = "SELECT * FROM calendar_events where event_date BETWEEN '$start' AND '$end'";
$result = $db->query($query);
$html='';
foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["event_title"],
  'start'   => $row["event_date"],
  'className'=>'cal-event-details'    
 );
 $html.='<li><span class="cal-event-date">दिनांक : '.date('d M, Y',strtotime($row['event_date'])).'</span>
        	<b class="cal-event-title">'. $row['event_title'] .'</b><p>'.$row['details'].'</p></li>';
}
$data[]['htmlres']=$html;
echo json_encode($data);
?>