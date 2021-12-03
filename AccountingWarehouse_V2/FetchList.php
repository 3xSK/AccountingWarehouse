 

<?php
session_start();
include("../config.php");

$output="";
//$JMID=isset($_GET['JMID']) ? $_GET['JMID'] : '0';
$JMID=isset($_POST['JMID']) ? $_POST['JMID'] : '0';

$sql = "SELECT *
                 FROM journal where JMID=".$JMID;
$result = $con->query($sql);


  // output data of each row
  while($row = $result->fetch_assoc()) {
if($_SESSION["RoleID"]=="1")
{
  $output.="<tr>"
."<td  class='dynamic'></td>"
."<td >".$row["accounts"]."</td>"
."<td>".$row["description"]."</td>"
."<td class='debit'>".$row["debit"]."</td>"
."<td  class='credit'>".$row["credit"]."</td>"
."<td><span class='btndel' >❌</span></td>".

"</tr>";
}
else
{
  $output.="<tr>"
."<td  class='dynamic'></td>"
."<td >".$row["accounts"]."</td>"
."<td>".$row["description"]."</td>"
."<td class='debit'>".$row["debit"]."</td>"
."<td  class='credit'>".$row["credit"]."</td>"
."<td><span>-</span></td>".

"</tr>";
}
   
 
}
//PickupTime
//PickupDate


echo $output;

?>
