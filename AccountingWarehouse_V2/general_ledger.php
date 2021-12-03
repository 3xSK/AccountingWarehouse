<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");
$accounts=$db->selectMultiRecords("select * from general_ledger order by lid");
?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Ledger</h1>
  </section>
  <section class="content">
    <div class="row">
   
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
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
                <th>Post Reference</th>
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
                                <td><?php echo $account['description']; ?></td>
                                <td>$<?php echo $account['debit']; ?></td>
                                <td><br>$<?php echo $account['credit']; ?></td>
                                <td>$<?php echo $account['balance'];?></td>
                                <td><a href="journal.php"><?php echo $account['PR'];?></a></td>
                                
                             </tr>
                  
                  <?php



                        }



                    }
         ?>
                </tbody>
              </table>
              <a href="chart_accounts.php"><input type="button" class="btn btn-primary" value="Back" /></a>
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
