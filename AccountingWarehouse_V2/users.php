<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");


if(!$_SESSION['admin']) {
	$Function->Redirect("index.php");
}



if(isset($_REQUEST['action']))  {

	

			if($_REQUEST['action']=='delete') {

					$user_id=intval($_REQUEST['user_id']);

								$deleted=$db->Delete_Record("users"," user_id=".$user_id);

								if($deleted) {

										$_SESSION['msg']="User has been deleted Successfully";

										$_SESSION['msg_type']="alert alert-success alert-dismissable";

										$Function->Redirect("users.php");

								

								}	else {

										$_SESSION['msg']="Error while deleting the User";

										$_SESSION['msg_type']="alert alert-danger alert-dismissable";

										$Function->Redirect("users.php");

								

								}				

					

			}

			

			if($_REQUEST['action']=='Inactive') {

					$user_id=intval($_REQUEST['user_id']);

								$deleted=$db->Update_Record("users"," status='Inactive' where  user_id=".$user_id);

								if($deleted) {

										$_SESSION['msg']="User has been Deactivated Successfully";

										$_SESSION['msg_type']="alert alert-success alert-dismissable";

										$Function->Redirect("users.php");

								

								}	else {

										$_SESSION['msg']="Error while Deactivating the User";

										$_SESSION['msg_type']="alert alert-danger alert-dismissable";

										$Function->Redirect("users.php");

								

								}				

					

			}

	}



	

	

$userRecords=$db->selectMultiRecords("select * from users  order by first_name,last_name");



?>

<?php include("pages/header.php"); ?>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> <i class="fa fa-users"></i> Account Management <small>Add, Edit, View, Deactivate</small> </h1>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12 text-right">

        <div class="form-group"> <a class="btn btn-primary" href="add_user.php?group_id=2"> <i class="fa fa-plus"></i> Add User</a> </div><a  href="info.html" title="Help"> <i style="width=30px;" class="fa fa-question-circle"></i> </a>

      </div>

    </div>

	 <br />

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

					<th>Username</th>

                    <th>Name</th>

                    <th>Email</th>
                    
                    	<th>Account Type</th>
					<th>Register Date</th>

                    <!---<th>Authority</th>--->

					 <th>Status</th>

                    <th class="text-center">Action</th>

                  </tr>

                </thead>

                <tbody>

                  <?php

                    if(!empty($userRecords))

                    {

                        foreach($userRecords as $record)

                        {

                    ?>

                  <tr>

				  

                    <td><?php echo $record['user_id']; ?> </td>

					<td><?php echo $record['username']; ?> </td>

                    <td><?php echo $record['first_name'].' '.$record['last_name']; ?> </td>

                    <td><?php echo $record['email']; ?> </td>
                      <td><?php 

											$role_info=$db->selectFrom("select * from user_groups where group_id=".$record['group_id']);

											echo $role_info['group_name'];

										 ?>

                    </td>


					 <td><?php echo date("d M Y H:i",strtotime($record['added_date'])); ?> </td>

					

                
					<td>

					<?php if($record['status']=='Active') { ?>

                        <div class="label label-success">Active</div>

					<?php } ?>
						<?php if($record['status']=='Pending') { ?>

                        <div class="label label-danger">Pending</div>

					<?php } ?>


					<?php if($record['status']=='Inactive') { ?>

                        <div class="label label-danger">Inactive</div>

					<?php } ?>

                      </td>

                    <td class="text-center"> 
                    <a class="btn btn-sm btn-info" href="edit_user.php?user_id=<?php echo $record['user_id']; ?>" title="Edit"> <i class="fa fa-pencil"></i> </a> 
                    <a class="btn btn-sm btn-info" href="view_user.php?user_id=<?php echo $record['user_id']; ?>" title="View"> <i class="fa fa-book"></i> </a> 
                     <?php
                        if($record['status']=='Inactive'){
                        ?>
                        <a style="background-color:green;" class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Activate account?');" href="activateuser.php?user_id=<?php echo $record['user_id']; ?>" title="Activate"> <i class="fa fa-unlock"></i></a>
                        <?php
                            }
                        else{
                            ?>
                        <a class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Deactivate account?');" href="deactivateuser.php?user_id=<?php echo $record['user_id']; ?>" title="Deactivate"> <i class="fa fa-lock"></i></a>
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

