<?php 
function convert_to_slug($str) 
{
  $str = trim($str);
  $str =str_replace(' ', '-', $str);
  return $str;
}


?>