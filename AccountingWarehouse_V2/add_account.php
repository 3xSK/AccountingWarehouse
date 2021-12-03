<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");



$acctCode="";
$acctName="";
$acctCategory="";
$term="";
$datecreated="";
$normalside="";
$initbalance="";
$acctStatus="";
$user_id="";
$statement="";
$comment="";


if(isset($_POST['add_account'])){

        $datetime = date('Y-d-m');
		$datecreated = $datetime;
		
        $acctCode = trim(addslashes($_POST['acctCode']));
        $acctName = trim(addslashes($_POST['acctName']));
		$acctCategory = trim(addslashes($_POST['acctCategory']));
		$term = trim(addslashes($_POST['term']));
        $normalside = trim(addslashes($_POST['normalside']));
		$initbalance = trim(addslashes($_POST['initbalance']));
		$acctStatus = trim(addslashes($_POST['acctStatus']));
		$user_id = trim(addslashes($_POST['user_id']));
		$statement = trim(addslashes($_POST['statement']));
		$comment = trim(addslashes($_POST['comment']));

        $check_code=$db->countRecords("select * from coa where acctCode='$acctCode'");

		if($check_code>0) {
					
						$_SESSION['msg']="Account Code already exists.";
						$_SESSION['msg_type']="alert alert-danger alert-dismissable";
						$Function->Redirect("add_account.php");
						exit;
		}

		$check_name=$db->countRecords("select * from coa where acctName='$acctName'");

		if($check_name>0) {
					
						$_SESSION['msg']="Account Name already exists.";
						$_SESSION['msg_type']="alert alert-danger alert-dismissable";
						$Function->Redirect("add_account.php");
						exit;
    	}
    	
    	
			
		$fields="acctCode,acctName,acctCategory,term,normalside,initbalance,datecreated,acctStatus,user_id,statement,comment";
		$vals="'$acctCode','$acctName','$acctCategory','$term','$normalside','$initbalance','$datecreated','$acctStatus','$user_id','$statement','$comment'"; 

		$db->Add_Record("coa",$fields,$vals);

        	

					$_SESSION['msg']="Account has been added Successfully";

					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("chart_accounts.php");


    }
    
$users=$db->selectMultiRecords("select * from users where status='Active' order by first_name,last_name");

?>

<?php include("pages/header.php"); ?>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> <i class="fa fa-users"></i> ADD ACCOUNT </h1>

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

          <form role="form" id="addNewAuthor" action="add_account.php" method="post" enctype="multipart/form-data">

            <div class="box-body">
			
			<div class="row">
             
              <div class="col-md-4">
                <div class="form-group">
                  <label for="fname">Account Code</label>
				    <input type="number" class="form-control required" value="<?php echo $acctCode; ?>" id="acctCode" name="acctCode" required>

                </div>
              </div>
			  <div class="col-md-4">
                <div class="form-group">
                  <label for="fname">Account Name</label>
				  <input type="text" class="form-control required" value="<?php echo $acctName; ?>" id="acctName" name="acctName" required>

                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <label for="fname">Account Category</label>
				   <select name="acctCategory" id="acctCategory" class="form-control" required> 
							      <option value="Asset" selected="selected">Asset</option>
								  <option value="Liability">Liability</option>
								  <option value="Equity">Equity</option>
								  <option value="Revenue">Revenue</option>
								  <option value="Expense">Expense</option>
								</select>
				 
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-6"> 

                <div class="form-group">

                  <label for="fname">Term</label>
				<select name="term" id="term"  class="form-control" required> 
							      <option value="Current" selected="selected">Current</option>
								  <option value="Long-term">Long-term</option>
								</select>
         

                </div>

              </div>
			  
			  <div class="col-md-6"> 

                <div class="form-group">

                  <label for="fname">Normal Side</label>
				<select name="normalside" id="normalside" class="form-control" required> 
							      <option value="Debit" selected="selected">Debit</option>
								  <option value="Credit">Credit</option>
								  
								</select>
              
         

                </div>

              </div>
			  
			 </div>
		
			 
		
			 
			
          	<div class="row">
             
              <div class="col-md-6">
                <div class="form-group">
                  <label for="acctStatus">Account Status</label><br>
				  <select name="acctStatus" id="acctStatus" class="form-control" required> 
							      <option value="Active" selected="selected">Active</option>
								  <option value="Inactive">Inactive</option>
								</select>
					

                </div>
              </div>
               <div class="col-md-6"> 

                <div class="form-group">

                  <label for="initbalance">Initial Balance</label>

                  <input type="number" onkeyup="AddComma(this);" step="0.01" value="0.00" name="initbalance" id="initbalance" value="" class="form-control" />
  <script type="text/javascript">
        function AddComma(text) {
            switch (text.value.length) {
                case 1:
                    document.getElementById("initbalance").value = "0.00" + text.value;
                    break;
                default:
                    var data = text.value.replace(".", "");
                    var first = data.substring(0, (data.length - 2));
                    var second = data.substring(data.length - 2);
                    var temp = Math.abs(first) + "." + second;
    				document.getElementById("initbalance").value = temp;
                    temp.toLocaleString('en', {useGrouping:true})
            }
           
        }
    </script>
      
  
                </div>

              </div>
            </div>

            <div class="row">
                 <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">User</label>
				   <select name="user_id" id="user_id" class="form-control" required> 
							      <option value="" selected="selected">select user</option>
								<?php foreach($users as $user) { ?> 
								  <option value="<?php echo $user['user_id']; ?>"><?php echo $user['first_name'].' '.$user['last_name']." (".$user['email'].")"; ?></option>
								 <?php } ?>
								 
								</select>
				 
                </div>
              </div>
                 <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Statement</label>
				   <select name="statement" id="statement" class="form-control"> 
							      <option value="" selected="selected">select statement</option>
								
								 <option value="IS">IS (income statement)</option>
								  <option value="BS">BS (balance sheet)</option>
								  <option value="RE">RE (Retained Earnings statement)</option>
								  
								</select>
				 
                </div>
              </div>
                
            </div>
            
              <div class="row">
                 <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Comment</label>
				  <textarea cols="30" rows="7" name="comment" class="form-control"></textarea>
				 
                </div>
              </div>
            
                
            </div>

            <!-- /.box-body -->

            <div class="box-footer">

              <input type="submit" class="btn btn-primary" name="add_account" value=" Add Account " />
              <input type="reset" class="btn btn-primary" value=" Clear " />
              <a href="chart_accounts.php"><input type="button" class="btn btn-primary" value=" Cancel " /></a>
              


            </div>

          </form>

        </div>



      </div>

    </div>

  </section>

</div>

<?php include("pages/footer.php"); ?>
