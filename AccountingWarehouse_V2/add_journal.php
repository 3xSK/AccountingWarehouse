<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

$JMID=isset($_GET['JMID'])?$_GET['JMID']:'0';
$IsEdit=isset($_GET['IsEdit'])?$_GET['IsEdit']:'save';


$datecreated="";
$creator="";
$accounts="";

$accounts2="";


$entry_description="";
$debit="";
$credit="";
$credit2="";
$PR="";
$lPR="";
$journalStatus="";
$datecreated2="";
$ledgerdescription="";
$ledgerdebit="";
$ledgercredit="";
$accountTitles="";
$tbdebit="";
$tbcredit="";
$balance="";


/*

if(isset($_POST['add_journal'])){

  // $datetime = date('Y-d-m');

  // $datecreated = trim(addslashes($_POST['datecreated']));
  // $creator = $_SESSION["username"];
  // $accounts = trim(addslashes($_POST['accounts']));
  // $accounts2 = trim(addslashes($_POST['accounts2']));	    
  // $entry_description= trim(addslashes($_POST['entry_description']));
  // $debit = trim(addslashes($_POST['debit']));
  // $credit = trim(addslashes($_POST['credit']));
  // $journalStatus = trim(addslashes($_POST['journalStatus']));

		$datetime = date('Y-d-m');

    $datecreated = $_POST['datecreated'];
    $creator = $_SESSION["username"];
		$accounts = $_POST['accounts'];
	  $accounts2 = $_POST['accounts2'];	    
		$entry_description= $_POST['entry_description'];
    $debit = $_POST['debit'];
		$credit = $_POST['credit'];
		$journalStatus = $_POST['journalStatus'];

    foreach ($accounts as $key => $accounts) {
      $acc = $accounts;
      $create = $creator[$key];
      $acc2 = $accounts2[$key];
      $deb = $debit[$key];
      $cred = $credit[$key];
      $journalStatus = $_POST['journalStatus'];
      $datecreated = $_POST['datecreated'];
      $entry_description= $_POST['entry_description'];
      $creator = $_SESSION["username"];
      $PR = "J-"+1;
      
      $fields="datecreated,creator, accounts, accounts2, entry_description,debit,credit,journalStatus,PR";
      $vals="'$datecreated','$creator','$acc','$acc2','$entry_description','$deb','$cred','$journalStatus','$PR'"; 
      
      $db->Add_Record("journal",$fields,$vals);
    }

		$datecreated2=trim(addslashes($_POST['datecreated']));
    $ledgerdescription=trim(addslashes($_POST['entry_description']));
    $ledgerdebit=trim(addslashes($_POST['debit']));;
    $ledgercredit=trim(addslashes($_POST['credit']));
    $accountTitles=trim(addslashes($_POST['accounts']));
    $tbdebit=trim(addslashes($_POST['debit']));
    $tbcredit=trim(addslashes($_POST['credit']));
    $balance=($deb-$cred);
		$PR = "J-"+1;
		$lPR = "J-"+1;
		
		
		

		
		
	
	   if($db){
       if($journalStatus == 'Approved'){
        $fields="datecreated, description, debit, credit,balance,PR";
        $vals="'$datecreated2', '$ledgerdescription','$ledgerdebit','$ledgercredit','$balance', '$PR'";
          $db->Add_Record("general_ledger",$fields,$vals);
       }	      
	   }
	   
	   if($db){
          
		   $fields="accountTitles, debit, credit";
		   $vals="'$accountTitles', '$tbdebit','$tbcredit'";
	       $db->Add_Record("trialbalance",$fields,$vals);
	      
	   }
	   if($db){
          
		   $fields="assets, liabilities, equities";
		   $vals="'$assets', '$liabilities','$equities'";
	       $db->Add_Record("balance sheet",$fields,$vals);
	      
	   }
	   if($db){
          
		   $fields="initbalance";
		   $vals="'$balance'";
	       $db->Update_Record("coa",$fields,$vals);
	      
	   }
	   
					$_SESSION['msg']="Account has been added Successfully";

					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("journal.php");
	}*/
  if($JMID!="0")
  {
$JournalMaster=$db->selectMultiRecords("select * from journalmaster where ID=".$JMID); 

$Journal=$db->selectMultiRecords("select * from journal where JMID=".$JMID); 


}

$rows=$db->selectMultiRecords("select * from coa order by id");				
?>

<?php include("pages/header.php"); ?>


<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> <i class="fa fa-users"></i> ADD JOURNAL </h1>

    

  </section>

  <section class="content">

    <div class="row">

      <!-- left column -->

      

      <div  id="txtstatus"> </div>

     

      <div class="col-md-12">

        <!-- general form elements -->

        <div class="box box-primary">

        
  <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Journal Entries</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <h4 class="form-section"><i class="ft-user"></i>Journal Entries</h4>
          <div class="form-group row float-right">
           <label class="col-md-2 label-control lbl" for="projectinput1">Select Date</label>
            <div class="col-md-4">

           <input type="date" class="form-control"  id="dt_journal"  required>

           </div>

            </div>
              <div class="form-group row">
           <label class="col-md-2 label-control lbl" for="projectinput1">Type:</label>
            <div class="col-md-4">

           <select class="form-control" id="accType" >

                    <option value="Asset" selected="selected">Asset</option>
                  <option value="Liability">Liability</option>
                  <option value="Equity">Equity</option>
                                  <option value="Revenue">Revenue</option>
                                  <option value="Expense">Expense</option>
                </select>

           </div>
           <label class="col-md-2 label-control lbl" for="projectinput1">Invoice#:</label>
            <div class="col-md-4">

           <input type="text" class="form-control" placeholder="Invocie number " id="invoice"  
value="<?php echo $JournalMaster['Invoice'];?>"
           required>

           </div>

            </div>
            <div class="form-group row">
           <label class="col-md-2 label-control lbl" for="projectinput1">Account:</label>
            <div class="col-md-4">
<!--
           <input type="text" class="form-control" placeholder="Account name" id="account"  required>-->
<select  id="account" class="form-control required" required>
                      <?php
                      foreach($rows as $row){
                                ?>
                    <option value="<?php echo $row['id'];?>"><?php echo $row['acctName'];?></option>
                    <?php 
                      }
                      ?>
                  </select>
           </div>
           <label class="col-md-2 label-control lbl" for="projectinput1">Description:</label>
            <div class="col-md-4">

           <textarea  class="form-control" placeholder="Description" id="description" 
           value="<?php echo $JournalMaster['description'];?>" required></textarea> 

           </div>

            </div>
               <div class="form-group row">
           <label class="col-md-2 label-control lbl" for="projectinput1">Debit: </label>
            <div class="col-md-4">

           <input type="number" class="form-control" placeholder="Debit" id="debit"   required>

           </div>
           <label class="col-md-2 label-control lbl" for="projectinput1">Credit: </label>
            <div class="col-md-4">

           <input type="number" class="form-control" placeholder="Credit: " id="credit"  required>

           </div>

            </div>
            <br/>

            <div class="form-group row">
             <button type="button" id="btnAdd" class="btn btn-danger col-md-4">Add</button>

            </div>

            <div class="form-group row">
             <table class="table table-border">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Type</th>
                   <th>Account</th><!--
                   <th>Description</th>-->
                   <th>Debit</th>
                   <th>Credit</th>
                    <th>Action</th>
                 </tr>
               </thead>
               <tbody id="tblaccount">
                 <?php $i=0;
                 foreach($Journal as $row)
                 {
                  $i++;

                 ?>
                 <tr>
                  
                   <td><?php echo $i;?></td>
                    <td><?php echo $row['accType'];?></td>
                   <td style="display: none"><?php echo $row['acc_id'];?></td>
                   <td><?php echo $row['accounts'];?></td><!--
                   <th>Description</th>-->
                   <td><?php echo $row['debit'];?></td>
                   <td><?php echo $row['credit'];?></td>
                    <td><span class='btndel' >❌</span></td>
                 </tr>

               <?php }?>


               </tbody>
               <tfoot>
                 <tr>
                   <td colspan="4"></td>
                   <th>Balance</th>
                   <th><p id="balance"></p></th>
                 </tr>
               </tfoot>
             </table>
            </div>
      </div>
      <div class="modal-footer">
        <a href="journal.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
         <button type="button" class="btn btn-primary" id="btnSave" data-bs-dismiss="modal">Save</button>
        <input type="hidden" id="JMID" value="<?php echo $JMID;?>">
               <input type="hidden" id="json_txt">
                <input type="hidden" id="IsEdit" value="<?php echo $IsEdit;?>">
      </div>
    </div>
          <!-- /.box-header -->

          <!-- form start -->

          
        </div>



      </div>

    </div>

  </section>

</div>


<?php include("pages/footer.php"); ?>
<script>
  function balance()
{
                   var tbldebit=Debit();
var tblCredit=Credit();

$("#balance").html((tbldebit-tblCredit));
                
   var balance=$("#balance").html();
   if(balance<1)
   {

      $("#balance").css("color","red");

   }
   else
   {

      $("#balance").css("color","green");


   }
}
$(document).ready(function () {

   $("#tblaccount").on('click', '.btndel', function () {
                    // $(this).closest('tr').remove();
                    // var index=$(this).closest('tr').index;
                    // countrows = countrows - index;

                    var row = $(this).closest('tr');
                    // Grab text inside of .dynamic element nested inside of <tr> parent
                    var dynamicValue = $(row).find('.dynamic').text();
                    // Change that text into a integer
                    dynamicValue = parseInt(dynamicValue);
                    // Delete that <tr> row
                    row.remove();
                    // Finally loop through all the rows and give them a new index number as the order may have changed since deleting a row.
                    $('.dynamic').each(function (idx, elem) {
                        $(elem).text(idx + 1);
                        countrows = idx + 1
                    });
                    balance();
                  });
   
  $("#btnAdd").click(function(){

    var acc_id =$("#account option:selected").val()?$("#account option:selected").val():'';

    var AccountText =$("#account option:selected").text()?$("#account option:selected").text():0;

    var accType =$("#accType option:selected").val()?$("#accType option:selected").val():'';


    var description=$("#description").val()?$("#description").val():0;
    var debit =$("#debit").val()?$("#debit").val():0;
    var credit =$("#credit").val()?$("#credit").val():0;

var tbl="<tr>"
+"<td  class='dynamic'></td>"
+"<td>"+accType+"</td>"
+"<td style='display:none'>"+acc_id+"</td>"
+"<td >"+AccountText+"</td>"
//+"<td>"+description+"</td>"-
+"<td class='debit'>"+debit+"</td>"
+"<td  class='credit'>"+credit+"</td>"
+"<td><span class='btndel' >❌</span></td>"+

"</tr>";

$("#tblaccount").append(tbl);

balance();
  });
   $(document).on('click', '.edit', function(){
    var user_id = $(this).attr("id");

    $.ajax({
      url:"Journal/Fetch.php",
      method:"POST",
      data:{JMID:user_id},
    //  dataType:"json",
      success:function(data)
      {
        console.log(data);
         
         var d=JSON.parse(data);


          $("#dt_journal").val(d.JournalDate);
           //$("#accType").val(d.AccType);
            $("#invoice").val(d.Invoice);
                  
                  $("#JMID").val(user_id);

                   $("#IsEdit").val('edit');

                  gettable(user_id);
                  $("#btnSave").removeClass("btn btn-primary");
                  $("#btnSave").addClass("btn btn-warning");
                 // $("#btnSave").text('Edit');
                 var RoleID=$("#txtRoleID").html();
                // alert(RoleID)
                 if(RoleID==1)
                 {
                  $('#btnSave').prop('disabled', false);
                 }
                 else
                 {
                 
                  $('#btnSave').prop('disabled', true);
                 }
                  
                   //$("#json_txt").val(data);

                  // alert(d.JournalDate);
      }
    })
  });
  
$("#btnFilter").click(function(){


load('1');

});

    function load(filter)
    {
      var FromDate=$("#FromDate").val();
var ToDate=$("#ToDate").val();
      //List.php
      var opt=filter;

     // alert(filter)
      $.ajax({
   url:'Journal/List.php',
   datatype:"application/json",
   type:'POST',
   data:{FromDate:FromDate,ToDate:ToDate,filter:opt}, 
   success:function(data){
      $('#lst').html(data); 
   },
   error:function(){
      // code for error
   }
 });
        $('#btnSave').prop('disabled', false);
      $("#btnSave").removeClass("btn btn-warning");
               
                   $("#btnSave").addClass("btn btn-primary");
                  $("#btnSave").text('Save');
                 $("#IsEdit").val('save');
  $("#JMID").val('0');
balance();
    }

    $(document).on('click', '.delete', function(){
    var user_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
       // $('#action').val("Del");

        
      $.ajax({
        url:"Journal/Del.php",
        method:"POST",
          data:{
           
            JMID:user_id
          

        },
        success:function(data)
        {
          
        //  console.log(data);
          //$("#txtStatus").html(data);
          load('0');
          
          
        }
      });
    }
    else
    {
      return false; 
    }
  });

 function gettable(user_id){
    //var user_id = $(this).attr("id");
    
 $('#JMID').val(user_id);
       // $('#action').val("Del");

        
      $.ajax({
        url:"Journal/FetchList.php",
        method:"POST",
          data:{
           
           JMID:user_id
          

        },
        //datatype:"application/json",
        // dataType:"JSON",
//contentType: 'application/json;',
        success:function(data)
        {
            //var d=JSON.parse(data);

 $("#tblaccount").html(data);

     balance();
          
          
        }
      });
    
  }

    $("#btnSave").click(function(){
      var tblaccount = [];
                    
                    var IsEdit=$("#IsEdit").val()?$("#IsEdit").val():'save';

                    $("#tblaccount tr").each(function () {
                        var row = $(this);
                        tblaccount.push({
                          accType: row.find("TD").eq(1).html(),
                            acc_id: row.find("TD").eq(2).html(),

                             Account: row.find("TD").eq(3).html(),
                            //description: row.find("TD").eq(2).html(),
 
                            tbldebit: row.find("TD").eq(4).html(),

                            credit: row.find("TD").eq(5).html(),
                        });
                    });
var accountdetail=JSON.stringify(tblaccount);
console.log(accountdetail);
                    var model=[];
                   // alert($("#dt_journal").val());
                    model={
'accounts':accountdetail,
'Jdate':$("#dt_journal").val(),
//'AccType':$("#accType").val(),
'Invoice':$("#invoice").val(),
'description':$("#description").val(),
                    };
console.log(JSON.stringify(model))

 //var AcType=$("#accType").val();
  var Invoice=$("#invoice").val();
  var JID=$("#JMID").val()?$("#JMID").val():'0';

  $.ajax({
                                url: 'Journal/Save.php',
                                type: "POST",


                                data:{ result : JSON.stringify(model),IsEdit:IsEdit,
                              JMID:JID},
                                
                               // dataType: "json",
                                success: function (data) {
                                  $("#JMID").val('0');
load('0');
//var json = $.parseJSON(data);
    console.log(data);
  json = JSON.parse(data);

              console.log(data);
//var response=JSON.stringify(data);
                                    console.log('<div class="'+json.msg_type+'">'+json.msg+'</div>');
                                    //alert(response);
$("#txtstatus").html('<div class="'+json.msg_type+'">'+json.msg+'</div>');


window.location.href = "journal.php";

                                                                 }
                            });

    });



//---- Approve Button
$(document).on('click', '.approved', function(){
    var user_id = $(this).attr("id");
  $("#JMID").val(user_id);
  });
//--



$("#btnApproved").click(function(){
      
                    
                 
 var JID=$("#JMID").val()?$("#JMID").val():'0';

 var Approve=$("#ddlApproved").val();
 

  $.ajax({
                                url: 'Journal/ApproveSave.php',
                                type: "POST",


                                data:{ Approve:Approve ,JMID:JID},
                                
                               // dataType: "json",
                                success: function (response) {
load('0');
                                    console.log(response);
                                   // alert(response);

                                                                 }
                            });

    });



});
 $('#debit').focus(function() {$("#credit").val('0');});
    $('#credit').focus(function() {$("#debit").val('0');});    
function Debit()
{
  var total = 0;
  $('.debit').each(function(){
    total += parseInt( $(this).text() );
  })
 return total;

}
  function Credit()
{
  var total = 0;
  $('.credit').each(function(){
    total += parseInt( $(this).text() );
  })
 return total;

}
</script>
