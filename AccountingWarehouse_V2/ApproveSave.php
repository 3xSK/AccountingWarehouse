
<?php
session_start();
include("../include/connection.php");

$Approve =isset($_POST['Approve'])?$_POST['Approve']:'0';
$JMID =isset($_POST['JMID'])?$_POST['JMID']:'0';
 $user_id=  isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : '1'; 



   if (mysqli_connect_errno())
   {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
  
   //---- save master 
   $sql="update journalmaster set WorkFlowTypeID=1,WorkFlowStateID=".$Approve."
   where ID=".$JMID;
   if (!mysqli_query($con,$sql))
   {
      die('Error: ' . mysqli_error($con));
   }
   
//echo $JMID;


mysqli_close($con);
?>