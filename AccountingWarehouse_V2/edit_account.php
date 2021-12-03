<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

global $db;
$check=true;


$id=0;



if(isset($_REQUEST['id'])) {

		$id=intval($_REQUEST['id']);

}


$acctCode="";
$acctName="";
$acctCategory="";
$term="";
$normalside="";
$initbalance="";
$acctStatus="";
$datetime = date('Y-d-m');


if(isset($_POST['update_account'])){


     
        $acctCode = trim(addslashes($_POST['acctCode']));
        $acctName = trim(addslashes($_POST['acctName']));
		$acctCategory = trim(addslashes($_POST['acctCategory']));
		$term = trim(addslashes($_POST['term']));
        $normalside = trim(addslashes($_POST['normalside']));
		$initbalance = trim(addslashes($_POST['initbalance']));
		$acctStatus = trim(addslashes($_POST['acctStatus']));
       
	 	$params="acctCode='$acctCode',acctName='$acctName',acctCategory='$acctCategory',term='$term',normalside='$normalside',initbalance='$initbalance',acctStatus='$acctStatus'";
		$params=$params." where id='$id'";

 
					$db->Update_Record("coa",$params);
    
					$_SESSION['msg']="Account Page has been updated Successfully";
					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("chart_accounts.php");

			

    }
	


	
		$account_info=$db->selectFrom("select * from coa where id=$id");

     
        $acctCode = $account_info['acctCode'];
        $acctName = $account_info['acctName'];
		$acctCategory = $account_info['acctCategory'];
		$term = $account_info['term'];
        $normalside = $account_info['normalside'];
		$initbalance = $account_info['initbalance'];
		$acctStatus = $account_info['acctStatus'];

?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Update Account</h1>
  </section>
  <section class="content">
    <div class="row">
      <!-- left column -->
      <?php if($_SESSION['msg']!="") { ?>
      <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
      <?php } ?>
      <div class="col-md-12">
        <!-- general form elements -->
        
        
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="addNewAuthor" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="box-body">
			
			<div class="row">
             
              <div class="col-md-4">
                <div class="form-group">
                  <label for="fname">Account Code</label>
				    <input type="text" class="form-control required" value="<?php echo $acctCode; ?>" id="acctCode" name="acctCode" required>

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
							      <option value="Asset" <?php if($acctCategory=='Asset') { ?> selected="selected" <?php } ?>>Asset</option>
								  <option value="Liability" <?php if($acctCategory=='Liability') { ?> selected="selected" <?php } ?>>Liability</option>
								  <option value="Equity"  <?php if($acctCategory=='Equity') { ?> selected="selected" <?php } ?>>Equity</option>
								</select>
				 
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-6"> 

                <div class="form-group">

                  <label for="fname">Term</label>
				<select name="term" id="term"  class="form-control" required> 
							      <option value="Current" >Current</option>
								  <option value="Long-term" <?php if($term=='Long-term') { ?> selected="selected" <?php } ?>>Long-term</option>
								</select>
         

                </div>

              </div>
			  
			  <div class="col-md-6"> 

                <div class="form-group">

                  <label for="normalside">Normal Side</label>
				<select name="normalside" id="normalside" class="form-control" required> 
							      <option value="Debit"  <?php if($normalside=='Debit') { ?> selected="selected" <?php } ?>>Debit</option>
								<option value="Credit" <?php if($normalside=='Credit') { ?> selected="selected" <?php } ?>>Credit</option>
								</select>
              
         

                </div>

              </div>
			  
			 </div>
		
			 
		
			 
			
          	<div class="row">
             
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Account Status</label><br>
				  <select name="acctStatus" id="acctStatus" class="form-control" required> 
							      <option value="Active" <?php if($acctStatus=='Active') { ?> selected="selected" <?php } ?>>Active</option>
								  <option value="Inactive"  <?php if($acctStatus=='Inactive') { ?> selected="selected" <?php } ?>>Inactive</option>
								</select>
					

                </div>
              </div>
               <div class="col-md-6"> 

                <div class="form-group">

                  <label for="fname">Initial Balance</label>

                  <input  disabled="" type="text" name="initbalance" id="initbalance" value="<?php echo $initbalance; ?>" class="form-control" />

                </div>

              </div>
            </div>

            

            <!-- /.box-body -->

            <div class="box-footer">

              <input type="submit" class="btn btn-primary" name="update_account" value=" Update Account " />



            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include("pages/footer.php"); ?>

