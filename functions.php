<?php

function getMenu($location)
{
    $db = getDbInstance();
    $db->where ("MP.location", $location);
    $db->orderBy("MP.position","ASC");
   // $row = $db->get('menu');
    $db->join("pages PD", "PD.id=MP.page_id", "INNER");
    $menus = $db->get("menu MP", null, "PD.title, PD.slug");
    return $menus;
}

function getMainMenu()
{
   $db = getDbInstance();   
   $sql ="select m.*,p.title,p.slug from menu as m,pages as p where p.id=m.page_id and location='top' and parent_id='0' order by position asc";
   $res = $db->query($sql);         
   if($res && count($res)>0)
   {   
     $i=1;	
     foreach ($res as $menuitem) 
     {
     	$menuArr[$i]=array('slug'=>$menuitem['slug'],'title'=>$menuitem['title'],'type'=>$menuitem['type'],'custom_link'=>$menuitem['custom_link']);       
        $parentId = $menuitem['page_id'];                
        //Get Submenu
        $sql1 ="select m.*,p.title,p.slug from menu as m,pages as p where p.id=m.page_id and location='top' and parent_id='$parentId' order by sp_position asc";
        $subres = $db->query($sql1);
        if($subres && count($subres)>0)
        {
          $childmenu=array();

          foreach ($subres as $submenu) 
          {
          	$menuArr[$i]['children'][]= array('slug'=>$submenu['slug'],'title'=>$submenu['title'],'type'=>$submenu['type'],'custom_link'=>$submenu['custom_link']);
          }  
        }
        $i++;
     }     
     return $menuArr;
   }
   else
   {
   	 return false;
   }
}

function getVideosOne(){
	$db = getDbInstance();
	$videos = $db->getOne("videos");
	return $videos;
}


function getVideos(){
	$db = getDbInstance();
	$videos = $db->get("videos");
	return $videos;
}

function getGallery($row=''){
	$db = getDbInstance();
  if($row=='all' || $row=='')
  {
    $db->orderBy('homepage','desc');
	  $gallerys = $db->get("gallery");
  } 
  else
  {
    $db->orderBy('homepage','desc');
    $gallerys = $db->get("gallery",$row);
  }
	return $gallerys;
}

function getUpcomingEvents(){
	$db = getDbInstance();
	$db->orderBy("id","desc");
	$upcoming_events = $db->get("upcoming_events");
	return $upcoming_events;
}

function getNewsUpdates(){
	$db = getDbInstance();
	$db->orderBy("id","desc");
	$news_updates = $db->get("news_updates");
	return $news_updates;
}

function getPanchangam(){
	$db = getDbInstance();
	$db->orderBy("id","desc");
	$panchangam = $db->get("panchangam");
	return $panchangam;
}

function getCalendarEvents($mStartDate='',$mEndDate='')
{
  $db = getDbInstance();
  /*if(!empty($mStartDate) && !empty($mEndDate))
  {
    $db->where("event_date",$location);
  }

  $db->orderBy("event_date","asc");
  $calendar_events = $db->get("calendar_events");*/
  
  $query = "SELECT * FROM calendar_events where event_date BETWEEN '$mStartDate' AND '$mEndDate'";
  $calendar_events = $db->query($query);
  return $calendar_events;
}


function getProductOne(){
	$db = getDbInstance();
	$product = $db->getOne("products");
	return $product;
}

function getProduct(){
	$db = getDbInstance();
	$product = $db->get("products");
	return $product;
}

function getBanners(){
	$db = getDbInstance();
	$banners = $db->get("banners");
	return $banners;
}

function update_option($key,$value='')
{
  $db=getDbInstance();
   //check key exists
  $select = $db->query("select optid from jk_options where option_key='$key'");
  if($select && count($select)>0)
  {
    $ss = $db->query("update jk_options set option_value='$value' where option_key='$key'");  
    return true;
  }
  else
  {
     $ssins= $db->query("insert into jk_options set option_key='$key',option_value='$value'");  
     if($ssins){return true;}else{return false;}
  }  
}

function get_option($option_key)
{
  $db=getDbInstance();
  if(!empty($option_key))
  {
    $data = $db->query("select * from jk_options where option_key='$option_key'");
   
      if($data && count($data)>0)
      {
        return $data[0]['option_value'];
      }      
  }
}

function redirect($url,$time=10)
{ 

  echo "<script type='text/javascript'>setTimeout(function(){window.location='$url'},$time)</script>";
}

?>