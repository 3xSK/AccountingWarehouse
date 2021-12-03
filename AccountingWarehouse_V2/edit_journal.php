<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");



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

if(isset($_REQUEST['journal_id'])) {

  $journal_id=intval($_REQUEST['journal_id']);

}

$db->Delete_Record("journal"," journal_id=".$journal_id);


if(isset($_POST['add_journal'])){


		$datetime = date('Y-d-m');
        $datecreated = trim(addslashes($_POST['datecreated']));
        $creator = $_SESSION["username"];
		$accounts = trim(addslashes($_POST['accounts']));
	    $accounts2 = trim(addslashes($_POST['accounts2']));
	    
		$entry_description= trim(addslashes($_POST['entry_description']));
        $debit = trim(addslashes($_POST['debit']));
		$credit = trim(addslashes($_POST['credit']));
		
		$journalStatus = trim(addslashes($_POST['journalStatus']));
		$datecreated2=trim(addslashes($_POST['datecreated']));
        $ledgerdescription=trim(addslashes($_POST['entry_description']));
        $ledgerdebit=trim(addslashes($_POST['debit']));;
        $ledgercredit=trim(addslashes($_POST['credit']));
        $accountTitles=trim(addslashes($_POST['accounts']));
        $tbdebit=trim(addslashes($_POST['debit']));
        $tbcredit=trim(addslashes($_POST['credit']));
        $balance=($debit-$credit);
		$PR = "J-"+1;
		$lPR = "J-"+1;
		
		
		
		$fields="datecreated,creator, accounts, accounts2, entry_description,debit,credit,credit2,journalStatus,PR";
		$vals="'$datecreated','$creator','$accounts','$accounts2','$entry_description','$debit','$credit','$credit2','$journalStatus','$PR'"; 
		
    

		$db->Add_Record("journal",$fields,$vals);
		
		
	
	   if($db){
          
		   $fields="datecreated, description, debit, credit,balance,PR";
		   $vals="'$datecreated2', '$ledgerdescription','$ledgerdebit','$ledgercredit','$balance', '$PR'";
	       $db->Add_Record("general_ledger",$fields,$vals);
	      
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

      <?php if($_SESSION['msg']!="") { ?>

      <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>

      <?php } ?>

      <div class="col-md-12">

        <!-- general form elements -->

        <div class="box box-primary">

        

          <!-- /.box-header -->

          <!-- form start -->

          <form role="form" id="addNewAuthor" action="add_journal.php" method="post" enctype="multipart/form-data">

            <div class="box-body">
			
			<div class="row">
             
              <div class="col-md-4">
                <div class="form-group">
                  <label for="datecreated">Date</label>
				    <input type="date" class="form-control required"  id="datecreated" name="datecreated" required>

                </div>
              </div>
               <div style="margin-top:8%; margin-left:-33.3%; width:20%;" class="col-md-6" > 
                <div style="width:93%" class="form-group" id=appendDebit>
                    
                  <label for="accounts">Accounts</label>&nbsp;&nbsp;<a onclick="appendDebit()" style="color:green;"title="Add Debit"> <i class="fa fa-plus"></i></a>&nbsp;&nbsp;<a style="color:red;"title="Remove field"> <i class="fa fa-minus"></i></a>
                  
				  <select name ="accounts" id="accounts" class="form-control required">
				      <?php
				       foreach($rows as $row){
                        ?>
						<option><?php echo $row['acctName'];?></option>
					
						<?php 
				       }
				       ?>
				  </select>
				  
				  <script>
						function appendDebit(){
						 let currentId=1;
						   var elem = document.querySelector('#appendDebit');
                           var clone = elem.cloneNode(true);
                           currentId+=1;
                           clone.id = 'appendDebit2${currentId}';
                           elem.after(clone);
						    
						}
						
					
                 </script>
				  	
			
				  
				  
				    
				  
                 <div style="width:93%" class="form-group">
                  <label for="debit">Debit</label>
                  <input type="number" onkeyup="AddComma(this);" step="0.01" value="0.00" name="debit" id="debit" value="" class="form-control" />
                  </div>
                 
                  
                 <script type="text/javascript">
                    function AddComma(text) {
                        switch (text.value.length) {
                            case 1:
                                document.getElementById("debit").value = "0.00" + text.value;
                            break;
                            default:
                                 var data = text.value.replace(".", "");
                                 var first = data.substring(0, (data.length - 2));
                                 var second = data.substring(data.length - 2);
                                 var temp = Math.abs(first) + "." + second;
    				             document.getElementById("debit").value = temp;
                                 temp.toLocaleString('en', {useGrouping:true})
                        }
           
                    }
                </script>
                </div>
                </div>
             </div>
             
             
             
              
              
          
       
             
             
             
             
              <div style="margin-top:-21.6%; margin-left:30%;"> 
                <div style="width:24%" class="form-group">
                  <label for="accounts2">Accounts</label>&nbsp;&nbsp;<a style="color:green;"title="Add Credit"> <i class="fa fa-plus"></i></a>&nbsp;&nbsp;<a style="color:red;"title="Remove field"> <i class="fa fa-minus"></i></a>
				  <select name ="accounts2" id="accounts2" class="form-control required">
				       <?php
				       foreach($rows as $row){
                        ?>
						<option><?php echo $row['acctName'];?></option>
						<?php 
				       }
				       ?>
				  </select>
				

				  </div>
                 
                <div style="width:24%" class="form-group">
                    <label for="credit">Credit</label>
                    <input type="number" onkeyup="AddComma2(this);" step="0.01" name="credit" id="credit" value="0.00" class="form-control" />
                    
                    <script type="text/javascript">
                    function AddComma2(text) {
                        switch (text.value.length) {
                            case 1:
                                document.getElementById("credit").value = "0.00" + text.value;
                            break;
                            default:
                                 var data = text.value.replace(".", "");
                                 var first = data.substring(0, (data.length - 2));
                                 var second = data.substring(data.length - 2);
                                 var temp = Math.abs(first) + "." + second;
    				             document.getElementById("credit").value = temp;
                                 temp.toLocaleString('en', {useGrouping:true})
                        }
           
                    }
                </script>
                </div>
                </div>
             </div>
             <div class="col-md-4">
                <div class="form-group">
                  <label for="entry_description">Status</label>
				  <div>
        <select name ="journalStatus" id="journalStatus" class="form-control required">
						<option value="Approved"> Approved</option>
            <option value="Pending">Pending</option>
            <option value="Rejected">Rejected</option>
				  </select>
          </div>
            </div>
          
        </div>
              
              
          
            <div class="col-md-4">
                <div class="form-group">
                  <label for="entry_description">Description</label>
				  <div>
			    <textarea name="entry_description" id="entry_description"></textarea>
			  	</div>
            </div>
            
        </div>
           <!-- /.box-body -->

            <div class="box-footer">
              <input type="submit" class="btn btn-primary" name="add_journal" value=" Add Journal Entry " />
              <input type="reset" class="btn btn-primary" value="Clear" />
              <a href="journal.php"><input type="button" class="btn btn-primary" value="Back" /></a>
            </div>

          </form>

        </div>



      </div>

    </div>

  </section>

</div>


<?php include("pages/footer.php"); ?>

