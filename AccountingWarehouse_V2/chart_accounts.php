<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");
$id=0;

if(isset($_REQUEST['action']))  {

			if($_REQUEST['action']=='delete') { 
					$id=intval($_REQUEST['id']);
								$deleted=$db->Delete_Record("coa"," id=".$id);
								if($deleted) {
										$_SESSION['msg']="Account has been deleted Successfully";
										$_SESSION['msg_type']="alert alert-success alert-dismissable";
										$Function->Redirect("chart_accounts.php");
								}	else {
										$_SESSION['msg']="Error while deleting the Account";
										$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										$Function->Redirect("chart_accounts.php");
								}				
			}
	}


$accounts=$db->selectMultiRecords("select * from coa order by id");

$users=$db->selectMultiRecords("select group_id from users");

?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
   <br>&nbsp;&nbsp;<h1>Welcome, <?php echo $_SESSION['username'];?></h1>
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Chart of Accounts</h1>
  </section>
  <section class="content">
    <div class="row">

      <div class="col-xs-12 text-right">

        <div class="form-group">
        <?php      if($_SESSION['group_id']=='1') {    ?>
                <a class="btn btn-primary" href="add_account.php"> <i class="fa fa-plus"></i> Add Account</a>   
        <?php   }  ?>
        
         
             <a class="btn btn-primary" href="send.php"> <i class="fa fa-envelope" aria-hidden="true"></i> Send Mail</a> 

           
          </div>

      </div>

    </div>

	 <br />
    <?php if($_SESSION['msg']!="") { ?>
    <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
    <?php } ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
       
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <div class="panel-body">
             <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Term</th>
                <th>Normal Side</th>
                <th>Current Balance</th>
                <th>Date Created</th>
                <th>Status</th>
                <th>PR</th>
                
              <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    if(!empty($accounts))
                    {
                        foreach($accounts as $account)
                        {
                    ?>
					<tr>
                                <td><a href="general_ledger.php"><?php echo $account['acctCode'];?></a></td>
                                <td><a href="general_ledger.php"><?php echo $account['acctName']; ?></a></td>
                                <td><?php echo $account['acctCategory']; ?></td>
                                <td><?php echo $account['term']; ?></td>
                                <td><?php echo $account['normalside']; ?></td>
                                <td id="currBalance" style="text-align:right;">$<?php echo number_format($account['initbalance'],2);?></td>
                                <script>
                                    let text = currBalance.toLocalString();
                                    document.getElementById("currBalance").innerHTML=text;
                                </script>
                                <td><?php echo $account['datecreated']; ?></td>
                                <td><?php echo $account['acctStatus']; ?></td>
                                <td><?php echo $account['PR']; ?></td>
                        
                         
                                <td class="text-center">
                         <?php      if($_SESSION['group_id']=='1') {    ?>
                                     <a class="btn btn-sm btn-info" href="edit_account.php?id=<?php echo $account['id']; ?>" title="Edit"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp; 
                                      
                        <?php
                        if($account['acctStatus']=='Inactive'){
                        ?>
                        <a style="background-color:green;" class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Activate account?');" href="activateaccount.php?acctCode=<?php echo $account['acctCode']; ?>" title="Activate"> <i class="fa fa-unlock"></i></a>
                        <?php
                            }
                        else{
                            ?>
                        <a class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Deactivate account?');" href="deactivateaccount.php?acctCode=<?php echo $account['acctCode']; ?>" title="Deactivate"> <i class="fa fa-lock"></i></a>
                        <?php
                        }
                     ?>
                       
                       
                               
                                    
                                       
                                 <a class="btn btn-sm btn-info" href="view_account.php?id=<?php echo $account['id']; ?>" title="View"> <i class="fa fa-book"></i> </a>
                        <?php } ?>
                        <?php      if($_SESSION['group_id']=='2' || $_SESSION['group_id']=='4') {    ?>
                                        <a class="btn btn-sm btn-info" href="view_account.php?id=<?php echo $account['id']; ?>" title="View"> <i class="fa fa-book"></i> </a>
                        <?php } ?>
                                     
                                </td>
                             </tr>
                             <script>
                                    let text = currBalance.toLocalString();
                                    document.getElementById("currBalance").innerHTML=text;
                                </script>
                  
                  <?php



                        }



                    }



                    ?>
                    
                </tbody>
              </table>
            </div>
          </div>
           <script>
                                    let text = num.toLocalString();
                                    document.getElementById("currBalance").innerHTML=text;
                                </script>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>
<?php include("pages/footer.php"); ?>
