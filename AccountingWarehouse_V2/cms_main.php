<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");



if(!isset($_SESSION['admin'])) {

			$Function->Redirect("index.php");

}


	

$pages=$db->selectMultiRecords("select * from pages order by name");



?>

<?php include("pages/header.php"); ?>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> <i class="fa fa-users"></i> Content Management Management</h1>

  </section>

  <section class="content">

    <div class="row">

     

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

            <h3 class="box-title">Page List</h3>

          </div>

          <!-- /.box-header -->

          <div class="box-body table-responsive no-padding">

            <div class="panel-body">

              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                <thead>

                  <tr>

                    <th>ID</th>

					<th>Page Name</th>

                    <th>Title</th>

                    <th class="text-center">Action</th>

                  </tr>

                </thead>

                <tbody>

                  <?php

                    if(!empty($pages))

                    {

                        foreach($pages as $page)

                        {

                    ?>

                  <tr>

				  

                    <td><?php echo $page['page_id']; ?> </td>

					<td><?php echo $page['name']; ?> </td>

                    <td><?php echo $page['title']; ?> </td>

                   

                    <td class="text-center"> <a class="btn btn-sm btn-info" href="cms.php?page_id=<?php echo $page['page_id']; ?>" title="Edit"> <i class="fa fa-pencil"></i> </a> </td>

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

