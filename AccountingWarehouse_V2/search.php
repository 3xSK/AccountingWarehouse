<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");
$id=0;

if($_SESSION['admin']) {
	$Function->Redirect("index.php");
}

if(isset($_REQUEST['action']))  {

			if($_REQUEST['action']=='delete') {
					$journal_id=intval($_REQUEST['journal_id']);
								$deleted=$db->Delete_Record("journal"," journal_id=".$journal_id);
								if($deleted) {
										$_SESSION['msg']="Account has been deleted Successfully";
										$_SESSION['msg_type']="alert alert-success alert-dismissable";
										$Function->Redirect("journal.php");
								}	else {
										$_SESSION['msg']="Error while deleting the Account";
										$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										$Function->Redirect("journal.php");
								}				
			}
	}

  if (isset($_POST['search'])) {
      $date1 = date("Y-m-d", strtotime($_POST['date1']));
      $date2 = date("Y-m-d", strtotime($_POST['date2']));
    
      $accounts=$db->selectMultiRecords("SELECT * FROM `journal` WHERE date(`datecreated`) BETWEEN '$date1' AND '$date2'");
  }
?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i>Journal</h1>
  </section>
  <section class="content">
    <div class="row">

      <div class="col-xs-12 text-right">

        <div class="form-group"> <a class="btn btn-primary" href="add_journal.php"> <i class="fa fa-plus"></i> Add Journal Entry</a> 

        <?php
    if($_SESSION['group_id']=='4') 
          {
          ?>
             <a class="btn btn-primary" href="send.php"> <i class="fa fa-envelope" aria-hidden="true"></i> Send Mail</a> 
          <?php
          }
          ?>
      </div>
      </div>

      <form class="form-inline" method="POST" action="journal.php">
        <label></label>
        <input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
        <label>To</label>
        <input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
        <button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search"></span></button> <a href="journal.php" type="button" class="btn btn-success"><span class = "glyphicon glyphicon-refresh"><span></a>
		</form>

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
                    <th>Date Created</th>
                <th>Creator</th>
                <th>Accounts Involved</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>PR</th>
                <th>Status</th>
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
                                <td><?php echo $account['datecreated']; ?></td>
                                <td><?php echo $account['creator']; ?></td>
                                <td style="text-align:right;"><?php echo $account['accounts']; ?><br><?php echo $account['accounts2'];?></td>
                                <td><?php echo $account['entry_description']; ?></td>
                                <td id ="debitvalue" style="text-align:right;">$<?php echo $account['debit'];?></td>
                                <td style="text-align:right;"><br>$<?php echo $account['credit'];?></td>
                                <td><?php echo $account['PR']; ?></td>
                                <td><?php echo $account['journalStatus'];?></td>
                                <script>
                                    let text = num.toLocalString();
                                    document.getElementById("debitvalue").innerHTML=text;
                                </script>
                                
                                 <td class="text-center"> <a class="btn btn-sm btn-info" href="edit_journal.php?journal_id=<?php echo $account['journal_id']; ?>" title="Edit"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp;

                                <?php
                              if($_SESSION['group_id']=='2') 
                              {
                              ?>
                                        <a class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Do you really want to Delete?');" href="journal.php?action=delete&journal_id=<?php echo $account['journal_id']; ?>" title="Delete"> <i class="fa fa-trash"></i> </a>
                                  <?php
                                  }
                              ?>

                              
                              </td>
                             </tr>
                  
                  <?php



                        }



                    }



                    ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>
<?php include("pages/footer.php"); ?>
