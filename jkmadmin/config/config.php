<?php 
//Note: This file should be included first in every php page.
//error_reporting(E_ALL);
define('BASE_PATH', dirname(dirname(__FILE__)));
//define('APP_FOLDER','simpleadmin');
define('APP_FOLDER','jharkhandnath.com');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));



require_once BASE_PATH.'/lib/MysqliDb.php';

/*
|--------------------------------------------------------------------------
| DATABASE CONFIGURATION
|--------------------------------------------------------------------------
*/
if($_SERVER['HTTP_HOST']=='localhost')
{
  define('DB_HOST', "localhost");
 define('DB_USER', "root");
 define('DB_PASSWORD', "");
 define('DB_NAME', "jharkhandmahadev");
 define('SITE_URL','http://localhost/dzone/jharkhandmahadev.in');
 define('ADMIN_URL','http://localhost/dzone/jharkhandmahadev.in/jkmadmin'); 
 define('GALLERY_URL',SITE_URL.'/jkmadmin/uploads/gallery/');
 define('BANNER_URL',SITE_URL.'/jkmadmin/uploads/banner/');
}
else
{
	define('DB_HOST', "localhost");
	define('DB_USER', "harkhand_mahadev");
	define('DB_PASSWORD', "juA{=DU9,^.5");
	define('DB_NAME', "harkhand_mahadev");
  define('SITE_URL','http://jharkhandmahadev.in');	
  define('ADMIN_URL','http://jharkhandmahadev.in/jkmadmin'); 
  define('GALLERY_URL',SITE_URL.'/jkmadmin/uploads/gallery/');
  define('BANNER_URL',SITE_URL.'/jkmadmin/uploads/banner/');

}



/**
* Get instance of DB object
*/
function getDbInstance()
{
  return new MysqliDb(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
}

$db=getDbInstance();

function convert_to_slug($str) 
{
  $str = strtolower($str);
  $str =str_replace(' ', '-', $str);
  return $str;
}

//require_once './jkmadmin/config/config.php';