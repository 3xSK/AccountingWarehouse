<?php



error_reporting(E_ERROR);



session_start();



include_once("config.php");



$type_id=0;
$niche_id=0;

if(isset($_REQUEST['type_id'])) {
		$type_id=intval($_REQUEST['type_id']);
}

if(isset($_REQUEST['niche_id'])) {
		$niche_id=intval($_REQUEST['niche_id']);
}







if(isset($_REQUEST['action']))  {



	



			if($_REQUEST['action']=='delete') {



					$website_id=intval($_REQUEST['website_id']);



								$deleted=$db->Delete_Record("websites"," website_id=".$website_id);

								if($deleted) {



										$_SESSION['msg']="Website has been deleted Successfully";



										$_SESSION['msg_type']="alert alert-success alert-dismissable";



										$Function->Redirect("websites.php?type_id=$type_id");



								



								}	else {



										$_SESSION['msg']="Error while deleting the Website";



										$_SESSION['msg_type']="alert alert-danger alert-dismissable";



										$Function->Redirect("websites.php?type_id=$type_id");



								



								}				



					



			}



			



		

	}







	


$query="select * from websites where 1";
	

if($type_id!=0) {
	$query .=" and  type_id='$type_id'";

}

if($niche_id!=0) {
	$query .=" and  niche_id='$niche_id'";

}



$query .=" order by added_date desc";
$websites=$db->selectMultiRecords($query);

$types=$db->selectMultiRecords("select * from types order by type");
$niches=$db->selectMultiRecords("select * from niches order by niche");


?>

<?php include("pages/header.php"); ?>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> <i class="fa fa-users"></i> Websites Management </h1>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12 text-right">

        <div class="form-group"> <a class="btn btn-primary" href="add_websites.php"> <i class="fa fa-plus"></i> Add Website</a> </div>

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

            

			<div class="row">

				 <div class="col-xs-2">Niche: </div>

				 <div class="col-xs-7">

			<select class="form-control" name="niche_id" id="niche_id" onchange="selectPage()">

				<option value="0">All Niches</option>

				<?php foreach($niches as $niche) { ?>

					<option value="<?php echo $niche['niche_id']; ?>" <?php if($niche_id==$niche['niche_id']) { ?> selected="selected" <?php  } ?>><?php echo $niche['niche']; ?></option>

			<?php  } ?>

			</select>

			

			</div>

			</div>
			<br>
			<div class="row">

				 <div class="col-xs-2">Types: </div>

				 <div class="col-xs-7">

			<select class="form-control" name="type_id" id="type_id" onchange="selectPage()">

				<option value="0">All Types</option>

				<?php foreach($types as $type) { ?>

					<option value="<?php echo $type['type_id']; ?>" <?php if($type_id==$type['type_id']) { ?> selected="selected" <?php  } ?>><?php echo $type['type']; ?></option>

			<?php  } ?>

			</select>

			

			</div>

			</div>

          </div>

          <!-- /.box-header -->

          <div class="box-body table-responsive no-padding">

            <div class="panel-body">

              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">

                <thead>

                  <tr>

                    <th>ID</th>

                    <th>Website</th>

                    

                    <th class="text-center">Action</th>

                  </tr>

                </thead>

                <tbody>

                  <?php



                    if(!empty($websites))



                    {



                        foreach($websites as $website)



                        {



                    ?>

                  <tr>

                    <td><?php echo $website['website_id']; ?> </td>

                    <td><?php echo $website['website']; ?> </td>

                    

                                    

                    <td class="text-center"><a class="btn btn-sm btn-warning" href="<?php echo $website['website']; ?>" target="_blank" title="View"> <i class="fa fa-eye"></i> </a> &nbsp;&nbsp;<a class="btn btn-sm btn-danger deleteUser" onClick="return confirm('Do you really want to Delete?');" href="websites.php?action=delete&type_id=<?php echo $type_id; ?>&website_id=<?php echo $website['website_id']; ?>" title="Delete"> <i class="fa fa-trash"></i> </a> </td>

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

<script>

var niche_id=0;
var type_id=0;

function selectPage() { 

	niche_id=$('#niche_id').val();
	type_id=$('#type_id').val();


	window.location.href='websites.php?type_id=' + type_id + '&niche_id=' + niche_id;



}



</script>

<?php include("pages/footer.php"); ?>

