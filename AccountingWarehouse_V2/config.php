<?php

@session_start();

$config=array();



 $config['sitename']="https://theaccountingwarehouse.xyz/";

$config['classes']="classes/";

$config['modules']="modules/";

$config['secure_key']="storm@web";

$config["uploads"]="./uploads/";

$config["docs"]="../uploads/documents/";





include_once($config['classes']."db.php");

include_once($config['classes']."functions.php");

include_once($config['classes']."paging.php");

include_once($config['classes']."class.phpmailer.php");

include_once($config['classes']."facebook.php");



$whitelist = array(".jpg",".jpeg",".gif",".png",".xls",".docx",".doc",".xlsx",".ppt",".pptx",".zip",".bmp",".pdf",".csv"); 



/*------------------------------------*/

$db=new DB();

$Function=new Functions();





$current_page=basename($_SERVER['REQUEST_URI']);





function sanitize($data)

{



$data = trim($data); 





if(get_magic_quotes_gpc()) 

{

$data = stripslashes($data); 

}



// a mySQL connection is required before using this function

$data = mysql_real_escape_string($data);



return $data;

}



function xss_clean($data)

{





$data = str_replace("passthru","", $data);

$data = str_replace("/etc/passwd","", $data);

$data = str_replace("/usr/bin/id","", $data);

$data = str_replace("die","", $data);

$data = str_replace("|id|","", $data);

$data = str_replace("|id","", $data);

$data = str_replace("/{id","", $data);

$data = str_replace(";id","", $data);

$data = str_replace("passwd","", $data);







$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);

$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);

$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);

$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');




$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);





$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);

$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);

$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);





$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);

$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);

$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);




$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);



do

{



	$old_data = $data;

	$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);

}

while ($old_data !== $data);




return $data;

}



?>