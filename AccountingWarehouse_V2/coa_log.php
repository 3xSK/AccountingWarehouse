<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");
$id=0;
/*
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
	}*/


$accounts=$db->selectMultiRecords("select * from coa_log order by id");

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
   

	 <br />
    
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
                
            
              <th>Flow</th>
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
                                   <td><?php echo $account['Status']; ?></td>
                     
                         
                                
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
