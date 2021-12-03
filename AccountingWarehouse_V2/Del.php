 

<?php
include("../config.php");

$output =Array();
//$JMID=isset($_GET['JMID']) ? $_GET['JMID'] : '0';
$JMID=isset($_POST['JMID']) ? $_POST['JMID'] : '0';

$sql = "delete FROM journal where JMID=".$JMID;
$result = $con->query($sql);
$sql = "delete FROM journalmaster where ID=".$JMID;
$result = $con->query($sql);

 
   
 

//PickupTime
//PickupDate


echo json_encode("Deleted");

?>
