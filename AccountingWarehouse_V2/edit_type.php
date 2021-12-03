<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

global $db;
$check=true;


$type_id=0;



if(isset($_REQUEST['type_id'])) {

		$type_id=intval($_REQUEST['type_id']);

}


$type="";



$type_info=$db->selectFrom("select * from types where type_id=$type_id");

						

$type=$type_info['type'];

if(isset($_POST['EditType'])){


        $type = trim(addslashes($_POST['type']));
      

		

		if($type=="") {

			$_SESSION['msg']="Please Fill all Fields";

			$_SESSION['msg_type']="alert alert-danger alert-dismissable";

										

		

		} else {


				$check_name=$db->countRecords("select * from types where type='$type='  and type_id!=$type_id");

				if($check_name>0) {

						$check=false;

						$_SESSION['msg']="Website Type already exists.";

						$_SESSION['msg_type']="alert alert-danger alert-dismissable";

				

				}

			
			

				if($check) {
		
					$params="type='$type'";
					$params=$params." where type_id='$type_id'";

 
					$db->Update_Record("types",$params);
    
					$_SESSION['msg']="Website Type has been updated Successfully";
					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("types.php");

				}

		

		}

       

    }
	

?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Website Types Management <small>Add / Edit</small> </h1>
  </section>
  <section class="content">
    <div class="row">
      <!-- left column -->
      <?php if($_SESSION['msg']!="") { ?>
      <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
      <?php } ?>
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-primary">
        
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="EditAuthor" action="" method="post">
		  <input type="hidden" name="type_id" value="<?php echo $type_id; ?>" />
            <div class="box-body">
            <div class="row">
              <div class="col-md-12"> 
                <div class="form-group">
                  <label for="fname">Website Type</label>
                  <input type="text" class="form-control required" value="<?php echo $type; ?>" id="name" name="type" required>
                </div>
              </div>
              
            </div>
            
         
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" class="btn btn-primary" name="EditType" value="Submit" />
              <input type="reset" class="btn btn-default" value="Reset" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include("pages/footer.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script>

	

	$(function() {

  //$('#datetimepicker1').datetimepicker();
  //$('#datetimepicker2').datetimepicker();

});

	</script>
