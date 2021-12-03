<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");


$acctCode = $_GET['acctCode'];

$params="acctStatus='Active'";
  $params=$params." where acctCode='$acctCode'";
  $db->Update_Record("coa",$params);

        	

					$_SESSION['msg']="Account Activated";

					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("chart_accounts.php");

				

?>