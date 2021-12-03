<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");



if(!isset($_SESSION['admin'])) {

			$Function->Redirect("index.php");

}





if(isset($_REQUEST['action']))  {

	

			if($_REQUEST['action']=='delete') {

					$type_id=intval($_REQUEST['type_id']);

								$deleted=$db->Delete_Record("types"," type_id=".$type_id);

								if($deleted) {

										$_SESSION['msg']="Website Type has been deleted Successfully";

										$_SESSION['msg_type']="alert alert-success alert-dismissable";

										$Function->Redirect("types.php");

								

								}	else {

										$_SESSION['msg']="Error while deleting the Website type";

										$_SESSION['msg_type']="alert alert-danger alert-dismissable";

										$Function->Redirect("types.php");

								

								}				

					

			}

			


	}



	

	

$types=$db->selectMultiRecords("select * from types order by type");



?>

<?php include("pages/header.php"); ?>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> <i class="fa fa-users"></i> Types Management <small>Add, Edit, Delete</small> </h1>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12 text-right">

        <div class="form-group"> <a class="btn btn-primary" href="add_type.php"> <i class="fa fa-plus"></i> Add Website Type</a> </div>

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

          <div class="box-header">

            <h3 class="box-title">Website Type List</h3>

          </div>

          <!-- /.box-header -->

          <div class="box-body table-responsive no-padding">

            <div class="panel-body">

              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                <thead>

                  <tr>

                    <th width="80%">Website Type</th>

					 <th class="text-center" style="text-align:center;" width="2%">Action</th>

                  </tr>

                </thead>

                <tbody>

                  <?php

                    if(!empty($types))

                    {

                        foreach($types as $type)

                        {

                    ?>

                  <tr>

				  

                    <td><?php echo $type['type']; ?> </td>

					
                    <td>

					
                    <td class="text-center"> <a class="btn btn-sm btn-info" href="edit_type.php?type_id=<?php echo $type['type_id']; ?>" title="Edit"> <i class="fa fa-pencil"></i> </a> &nbsp;&nbsp;<a class="btn btn-sm btn-danger deleteUser" onclick="return confirm('Do you really want to Delete?');" href="types.php?action=delete&type_id=<?php echo $type['type_id']; ?>" title="Delete"> <i class="fa fa-trash"></i> </a> </td>

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

