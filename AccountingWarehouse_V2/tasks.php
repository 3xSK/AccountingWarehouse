<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");
$task_id=0;

if(isset($_REQUEST['action']))  {

			if($_REQUEST['action']=='delete') {
					$task_id=intval($_REQUEST['task_id']);
								$deleted=$db->Delete_Record("tasks"," task_id=".$task_id);
								if($deleted) {
										$_SESSION['msg']="Task has been deleted Successfully";
										$_SESSION['msg_type']="alert alert-success alert-dismissable";
										$Function->Redirect("tasks.php");
								}	else {
										$_SESSION['msg']="Error while deleting the Task";
										$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										$Function->Redirect("tasks.php");
								}				
			}
	}


$tasks=$db->selectMultiRecords("select * from tasks order by task_id desc");
?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Tasks Management <small>Add, Edit, Delete</small> </h1>
  </section>
  <section class="content">
    <div class="row">
      	<div class="col-xs-12 text-right">
        <div class="form-group"> <a class="btn btn-primary" href="add_task.php"> <i class="fa fa-plus"></i> Add Task</a> </div>
      </div>
    </div>
    <br />
    <?php if($_SESSION['msg']!="") { ?>
    <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
    <?php } ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Task List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th width="25%">Title</th>
					<th width="20%">Completed</th>
					<th width="20%">Indexed</th>
					<th width="10%">Added Date</th>
                    <th class="text-center" style="text-align:center;" width="5%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

					

                    if(!empty($tasks))



                    {



                        foreach($tasks as $task)



                        {

						
					$completed_list=$db->countRecords("select * from backlinks where status=1 and task_id=".$task['task_id']);
					$total_list=$db->countRecords("select * from backlinks where task_id=".$task['task_id']);
					
					$indexed_list=$db->countRecords("select * from backlinks where index_link='' and task_id=".$task['task_id']);
					
					$percent_complete=ceil($total_list/$completed_list * 100);
					$percent_indexed=ceil($indexed_list/$completed_list * 100);

                    ?>
                  <tr>
                    <td><?php echo $task['title']; ?> </td>
					<td><div class="progress-group">
                    <span class="progress-text"></span>
                    <span class="progress-number"><b><?php echo $completed_list; ?></b>/<?php echo $total_list; ?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $percent_complete; ?>%"></div>
                    </div>
                  </div>
					</td>
					
					<td><div class="progress-group">
                    <span class="progress-text"></span>
                    <span class="progress-number"><b><?php echo $indexed_list; ?></b>/<?php echo $total_list; ?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $percent_indexed; ?>%"></div>
                    </div>
                  </div>
					</td>
					
					<td><?php echo date("d M Y",strtotime($task['added_date'])); ?> </td>
                    
                   
                    <td class="text-center"><a class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Do you really want to Delete?');" href="tasks.php?action=delete&task_id=<?php echo $task['task_id']; ?>" title="Delete"> <i class="fa fa-trash"></i> </a> </td>
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
