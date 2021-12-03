<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");
$todo=0;

$link_id=0;



if(isset($_REQUEST['action']))  {

			if($_REQUEST['action']=='delete') {
					$link_id=intval($_REQUEST['link_id']);
								$deleted=$db->Delete_Record("backlinks"," link_id=".$link_id);
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



$lists=$db->selectMultiRecords("select * from tasks t inner join backlinks b on t.task_id=b.task_id 
							where b.status=0 order by RAND()");
?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content">
	<div id="complete_msg" class="alert alert-success alert-dismissible" style="display:none"></div>
   <?php if($_SESSION['msg']!="") { ?>
    <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
    <?php } ?>
	<br>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Todo List</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Website</th>
                  <th>Task Name</th>
                  <th>Actions</th>
                </tr>

			 <?php
			        if(!empty($lists))  {
		
		                 foreach($lists as $list)    {
						 
						 $type_info=$db->selectFrom("select * from types where type_id=".$list['type_id']);
			?>
                <tr id="list_row_<?php echo $list['link_id']; ?>">
                  <td><?php echo $list['link_id']; ?></td>
				 <td><span class="label label-success"><?php echo $type_info['type']; ?></span></td>
                  <td><a href="<?php echo $list['web_link']; ?>" target="_blank"><?php echo $list['web_link']; ?></a></td>
                  <td><?php echo $list['title']; ?></td>
                  <td><button type="button" class="btn btn-success" onClick="MarkComplete('<?php echo $list['link_id']; ?>');" data-toggle="modal" data-target="#modal-success">Mark as Complete</button>
				  	&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Do you really want to Delete?');" href="todo.php?action=delete&link_id=<?php echo $list['link_id']; ?>" title="Delete"> <i class="fa fa-trash"></i> </a> 
				  
				  </td>
                </tr>
			<?php } } ?>
               
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    <br />
   
    
  </section>
</div>
<div class="modal fade" id="modal-success" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span></button>
                <h4 class="modal-title">Complete Link</h4>
              </div>
              <div class="modal-body">
			  	Result Link
				<form action="" method="post" name="successform">
					<input type="hidden" name="link_id" id="link_id" value="0" />
		            <input type="text" class="form-control" name="web_link" id="web_link" />
				</form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onClick="doComplete();">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<?php include("pages/footer.php"); ?>

<script>

function MarkComplete(link_id) {

	$("#link_id").val(link_id);
	
}

function doComplete() {

		$.ajax({
			  type: "POST",
			  url: "php/doComplete.php",
			  data: {link_id : $("#link_id").val(),web_link:$("#web_link").val()},
			  cache: false,
			  success: function(data){
				 if(data=="1") {
					$('#list_row_' + $("#link_id").val()).remove();
					$('#complete_msg').show();
					$('#complete_msg').html('Task Completed . ');
					$('#modal-success').modal('toggle');
				 }
			  }
			});

}
</script>
