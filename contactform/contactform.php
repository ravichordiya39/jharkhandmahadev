<?php 
if(isset($_POST))
{
  //print_r($_POST);
  if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']))
  {
  	echo '<strong>Error!</strong> Fill the all required fields';
  }
  else
  {
  	echo 'OK';
  }
}
?>