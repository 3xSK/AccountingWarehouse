<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

$module="";

if(isset($_REQUEST['module'])) {
    $module=$_REQUEST['module'];
}

	
$sql=" select * from logs where 1 ";

if($module!="") {
    $sql.=" and module='".$module."'";
}

$sql.=" order by id desc";

$logs=$db->selectMultiRecords($sql);



?>

<?php include("pages/header.php"); ?>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> <i class="fa fa-users"></i>Event Logs</h1>

  </section>

  <section class="content">

  

	  <?php if($_SESSION['msg']!="") { ?>

		<div class="<?php echo $_SESSION['msg_type']; ?>">

             <?php echo $_SESSION['msg']; ?>

        </div>

		<?php } ?>

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

         <div class="box-body table-responsive no-padding">

            <div class="panel-body">

              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                <thead>

                  <tr>

                    <th>ID</th>

					<th>User</th>

                    <th>Log</th>

                   <th>Date</th>

                  </tr>

                </thead>

                <tbody>

                  <?php

                    if(!empty($logs))

                    {

                        foreach($logs as $log)

                        {
                            
                            $user=$db->selectFrom("select * from users where user_id=".$log['user_id']);
                    ?>

                  <tr>

				  

                    <td><?php echo $log['id']; ?> </td>

					<td><?php echo $user['first_name'].' '.$user['last_name']." (".$user['email'].")"; ?></td>

                    <td><?php echo $log['notification'].' by '.$user['first_name'].' '.$user['last_name']; ?> </td>

                    <td><?php echo date("d M Y H:i",strtotime($log['log_date'])); ?> </td>
                    
			
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

