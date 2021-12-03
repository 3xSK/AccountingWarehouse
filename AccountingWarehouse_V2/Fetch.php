 

<?php

include("../config.php");

$output=[];
//$JMID=isset($_GET['JMID']) ? $_GET['JMID'] : '0';
$JMID=isset($_POST['JMID']) ? $_POST['JMID'] : '0';

$sql = "SELECT *
                 FROM journalmaster where ID=".$JMID;
$result = $con->query($sql);


  // output data of each row
  while($row = $result->fetch_assoc()) {

 $output['JournalDate'] = $row["JournalDate"];//$row["name"]
 $output['AccType'] = $row["AccType"];
$output['Invoice'] = $row["Invocie"];
   
 
}
//PickupTime
//PickupDate


echo json_encode($output);

?>
