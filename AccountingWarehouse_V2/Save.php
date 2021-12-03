
<?php
session_start();
include("../config.php");
$Message=[];
$Edit =isset($_POST['IsEdit'])?$_POST['IsEdit']:'save';
 $user_id=  isset($_SESSION["UserID"]) ? $_SESSION["UserID"] : '1'; 

if($Edit=="save")
{

   $data    = $_POST["result"];
   $data   = json_decode("$data", true);


   $date =$data["Jdate"];   
  // $AccType =$data["AccType"];
   $invoice =$data["Invoice"]; 
    $description=$data["description"]; 
   $account = json_decode($data['accounts']);
  
   if (mysqli_connect_errno())
   {
      echo die()."Failed to connect to MySQL: " . mysqli_connect_error();
   }
    $dt=date ("Y-m-d", strtotime($date));
   //---- save master 


$fields="JournalDate,Invocie,WorkFlowTypeID,WorkFlowStateID,description";
      $vals="'$dt','$invoice',1,2,'$description'"; 
      $isave=0;
      $db->Add_Record("journalmaster",$fields,$vals);
if($db)
{
$JournalMaster=$db->selectFrom("select  * from journalmaster order by ID desc LIMIT 1");
/*
   $sql="INSERT INTO  journalmaster (JournalDate,AccType,Invocie,WorkFlowTypeID,WorkFlowStateID)
   VALUES
   ('$dt','$AccType','$invoice','1','2')";
   if (!mysqli_query($connection,$sql))
   {
      die('Error: ' . mysqli_error($connection));
   }
   $sql="select  (`ID`)as Id from journalmaster order by ID desc LIMIT 1 ";
   $id=0;
   $result = $connection -> query($sql);
   while ($row_id = $result->fetch_assoc()) 
   {
       $id=$row_id["Id"];
   }ID
   */
   $id=$JournalMaster['ID'];
   foreach($account as $user)
   {
         $user     = get_object_vars($user);
         $Account = $user['Account'];
         $acc_id = $user['acc_id'];
          $accType = $user['accType'];
         
        // $description = $user['description'];
         $tbldebit = $user['tbldebit'];
         $credit = $user['credit'];
 $PR="";
         if($tbldebit>0)
         {
            $PR="DR";
         }
         else if($credit>0)
         {
$PR="CR";
         }
         
         $fields="JMID,creator,accType,acc_id,accounts,PR,debit,credit";
      $vals="'$id','$user_id','$accType','$acc_id','$Account','$PR','$tbldebit','$credit'"; 
      
      $db->Add_Record("journal",$fields,$vals);


   
      if ($db)
      {
       
         $Message['msg']="Data added Successfully !";
          $Message['msg_type']="alert alert-success alert-dismissable";
      }
      else
      {
           $Message['msg']="Error while Adding the Journal";
          $Message['msg_type']="alert alert-danger alert-dismissable";
        
          
      }
 }
}
else

{
     $Message['msg']="Record is not saved yet";
          $Message['msg_type']="alert alert-danger alert-dismissable";
}
}
else if($Edit=="edit" && isset($_POST['JMID']))
{
   
   $ID=$_POST['JMID'];
   $data    = $_POST["result"];
   $data   = json_decode("$data", true);


   $date =$data["Jdate"];   
  // $AccType =$data["AccType"];
   $invoice =$data["Invoice"]; 
   $description=$data["description"]; 
   $account = json_decode($data['accounts']);
   
    $dt=date ("Y-m-d", strtotime($date));
   //---- save master 

   $params="JournalDate='$dt',Invocie='$invoice,description='$description',
   ,WorkFlowTypeID=1,WorkFlowStateID=2";
      $params=$params." where id='$ID'";

 
               $db->Update_Record("journalmaster",$params);
               $deleted=$db->Delete_Record("journal"," JMID=".$ID);
                           
/*
   $sql="update  journalmaster set JournalDate='$dt',AccType='$AccType',Invocie='$invoice',
   ,WorkFlowTypeID=1,WorkFlowStateID=2
   where ID=".$ID;
   if (!mysqli_query($connection,$sql))
   {
      die('Error: ' . mysqli_error($connection));
   }
   $sql="delete from journal where JMID =".$ID;
  
   $result = $connection -> query($sql);*/
  if($deleted)
  {
   foreach($account as $user)
   {
         $user     = get_object_vars($user);
          $Account = $user['Account'];
         $acc_id = $user['acc_id'];
          $accType = $user['accType'];
        // $description = $user['description'];
         $tbldebit = $user['tbldebit'];
         $credit = $user['credit'];
         $PR="";
         if($tbldebit>0)
         {
            $PR="DR";
         }
         else if($credit>0)
         {
$PR="CR";
         }
         $balance=($tbldebit-$credit);
  $fields="JMID,creator,accType,acc_id,accounts,PR,debit,credit";
      $vals="'$ID','$user_id','$accType','$acc_id','$Account','$PR','$tbldebit','$credit'"; 
      
      $db->Add_Record("journal",$fields,$vals);


   
      if ($db)
      {
       /*if($db){
       if($journalStatus == 'Approved'){
        $fields="datecreated, description, debit, credit,balance,PR";
        $vals="'$datecreated2', '$ledgerdescription','$ledgerdebit','$ledgercredit','$balance', '$PR'";
          $db->Add_Record("general_ledger",$fields,$vals);
       }       
      }*/
      
     
     
      if($db){
          
         $fields="initbalance";
         $vals="'$balance'";
          $db->Update_Record("coa",$fields,$vals);
         
      }
         $Message['msg']="Data Updated Successfully !";
          $Message['msg_type']="alert alert-success alert-dismissable";
      }
      else
      {
           $Message['msg']="Error while Updated the Journal";
          $Message['msg_type']="alert alert-danger alert-dismissable";
        
          
      }


 }
}
   
}
else
{
     $Message['msg']="Error ".$Edit;
          $Message['msg_type']="alert alert-danger alert-dismissable";
        
}

echo json_encode($Message);

//mysqli_close($connection);
?>