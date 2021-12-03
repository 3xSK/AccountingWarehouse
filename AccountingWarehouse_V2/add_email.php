<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

global $db;
$check=true;

$email="";
$key_id="";
$user_id="";



if(isset($_POST['addAuthor'])){


        $email = trim(addslashes($_POST['email']));
        $user_id = trim(addslashes($_POST['user_id']));
			

					$fields="email,user_id";
        			$vals="'$email','$user_id'"; 

					$db->Add_Record("authors",$fields,$vals);

					$_SESSION['msg']="Author has been added Successfully";
					$_SESSION['msg_type']="alert alert-success alert-dismissable";
					$Function->Redirect("authors.php");
}
	

?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Authors Management <small>Add / Edit User</small> </h1>
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
          <div class="box-header">
            <h3 class="box-title">Add New Author</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="addNewAuthor" action="" method="post">
            <div class="box-body">
            <div class="row">
              <div class="col-md-6"> 
                <div class="form-group">
                  <label for="fname">Name</label>
                  <input type="text" class="form-control required" value="<?php echo $name; ?>" id="name" name="name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Profession</label>
                  <input type="text" class="form-control" value="<?php echo $profession; ?>" id="profession" name="profession">
                </div>
              </div>
            </div>
            <div class="row">
              
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Nationality</label>
                  <select name="nationality_id" class="form-control">
                    <?php 

										$nationalities=$db->selectMultiRecords("select * from nationalities order by nationality");


										

										  foreach($nationalities as $nationality) {

										  

										  ?>
                    <option value="<?php echo $nationality['nationality_id'] ?>" <?php if($nationality_id==$nationality['nationality_id']) { ?> selected="selected" <?php } ?>><?php echo $nationality['nationality'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row"> </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="role">Date of Birth</label>
                  <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="dob" value="<?php echo $dob; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span> </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="role">Date of Birth</label>
                  <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" name="dod" value="<?php echo $dod; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span> </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Basic Information</label>
                  <textarea class="form-control" id="basic" name="basic" rows="4"><?php echo $basic; ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="8"><?php echo $description; ?></textarea>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" class="btn btn-primary" name="addAuthor" value="Submit" />
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
