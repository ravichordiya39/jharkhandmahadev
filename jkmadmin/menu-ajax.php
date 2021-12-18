<?php 
if(!session_start()){session_start();}
require_once './config/config.php';

$db = getDbInstance();



 if(isset($_POST['dataj']))
  { 
  	//print_r($_POST['dataj']);
 	$menuArr= $_POST['dataj'];

 	$datahtml="";

 	if($menuArr && count($menuArr)>0)

 	{

 	   $p=1;		

 		foreach ($menuArr as $menuData) 

 		{

 			if($menuData['id'])

 			{

	 		  $page_id = $menuData['id'];

	 		  $update ="update menu set position='$p',parent_id='0',sp_position='0' where page_id='$page_id' and location='top'";

         	  $db->query($update);

	 		}  

	 		if(isset($menuData['children']))

	 		{

	 		  $k=1;	

	 		  $childrenArr = $menuData['children'];		

	 		  foreach($childrenArr as $submenu) 

 			  {

 			  	$submenuPage = $submenu['id'];

 			  	$parentId =$menuData['id'];

	         	//Update Child postion

	         	$db->query("update menu set sp_position='$k',parent_id='$parentId' where page_id='$submenuPage' and location='top'");

 			  	$k++;

 			  }

	 		}		

	 	  $p++;

 		}	
 		$_SESSION['success'] ='Menu Setting Saved Successfully';
 	  echo json_encode(array('status'=>'success','message'=>'Menu Setting Saved Successfully.'));

 	}

 	else

 	{
       $_SESSION['success'] ='Menu item not found';
 	  echo json_encode(array('status'=>'error','message'=>'Menu item not found'));

 	} 

 }

?>

