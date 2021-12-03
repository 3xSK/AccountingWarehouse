<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");


$user_id = $_GET['user_id'];

$params="status='Active'";
  $params=$params." where user_id='$user_id'";
  $db->Update_Record("users",$params);

        	

					$_SESSION['msg']="User Activated";

					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("users.php");

				

?>