<?php
//error_reporting(E_ERROR);
session_start();
include_once("config.php");
$id=0;
/*
if($_SESSION['group_id']!="") {
	$Function->Redirect("index.php");
}*/

if(isset($_GET['JMID']))  {

			if($_GET['action']=='Approve') {
					$journal_id=intval($_GET['JMID']);
								//$deleted=$db->Delete_Record("journal"," JMID=".$journal_id);
								   $params="WorkFlowTypeID=1,WorkFlowStateID=1";
      $params=$params." where id='$journal_id'";

 
               $updated=   $db->Update_Record("journalmaster",$params);



								if($updated) {
										$_SESSION['msg']="Account has been Approved Successfully";
										$_SESSION['msg_type']="alert alert-success alert-dismissable";
										;
										$Function->Redirect("journal.php");
								}	else {
										$_SESSION['msg']="Error while deleting the Account";
										$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										$Function->Redirect("journal.php");
								}				
			}
			else if($_GET['action']=='Reject') {
					$journal_id=intval($_GET['JMID']);

					$params="WorkFlowTypeID=1,WorkFlowStateID=3";
      $params=$params." where id='$journal_id'";

 
              $updated= $db->Update_Record("journalmaster",$params);

								//$deleted=$db->Delete_Record("journal"," JMID=".$journal_id);
								if($updated) {
										$_SESSION['msg']="Account has been Rejected Successfully";
										$_SESSION['msg_type']="alert alert-warning alert-dismissable";
										;
										$Function->Redirect("journal.php");
								}	else {
										$_SESSION['msg']="Error while deleting the Account";
										$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										$Function->Redirect("journal.php");
								}				
			}
				else if($_GET['action']=='Pending') {
					$journal_id=intval($_GET['JMID']);
							$params="WorkFlowTypeID=1,WorkFlowStateID=3";
      $params=$params." where id='$journal_id'";

 
              $updated= $db->Update_Record("journalmaster",$params);
								if($updated) {
										$_SESSION['msg']="Account has been Pending Successfully";
										$_SESSION['msg_type']="alert alert-primary alert-dismissable";
										;
										$Function->Redirect("journal_model.php");
								}	else {
										$_SESSION['msg']="Error while deleting the Account";
										$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										$Function->Redirect("journal.php");
								}				
			}
	}


//$accounts=$db->selectMultiRecords("select * from journalmaster order by journal_id");
?>