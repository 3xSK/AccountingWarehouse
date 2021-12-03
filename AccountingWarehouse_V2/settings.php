<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");

if(isset($_POST['UpdateSettings'])){


		foreach($_POST['settings'] as $key => $value) {
		
					$db->Update_Record("settings","meta_value='".$value."' where meta_key='".$key."'");
							
		}
        
		
		if($_FILES['favicon']['name'] !=""){
			
				 
				 // giving new name to picture with time() function
				  $file_name = 'favicon.ico';
				  $file_size =$_FILES['favicon']['size'];
				  $file_tmp =$_FILES['favicon']['tmp_name'];
				  $file_type=$_FILES['favicon']['type'];
				  //getting file extension
				  $file_ext=strtolower(end(explode('.',$_FILES['favicon']['name'])));
				  
				  //allowed extensions
				  $extensions= array("ico");
				  
				  //checking file extension
				  if(in_array($file_ext,$extensions)=== false){
					 $file_err="extension not allowed, please choose an ICO file for favicon.";
					 $_SESSION['msg']="extension not allowed, please choose an ICO file for favicon.";
					$_SESSION['msg_type']="alert alert-danger alert-dismissable";
					$Function->Redirect("settings.php");
				  }
				  
				  //if no errors then upload file
				  if(empty($file_err)==true){
					 move_uploaded_file($file_tmp,"uploads/".$file_name);
					 //chmod("uploads/".$file_name, 777); 
					 $db->Update_Record("settings","meta_value='$file_name' where meta_key='favicon'");
				  }
				  
  			 }


				
		if($_FILES['logo']['name'] !=""){
				 // giving new name to picture with time() function
				  $logo_file_name = 'logo.png';
				  $file_size =$_FILES['favicon']['size'];
				  $file_tmp =$_FILES['favicon']['tmp_name'];
				  $file_type=$_FILES['favicon']['type'];
				  //getting file extension
				  $file_ext=strtolower(end(explode('.',$_FILES['logo']['name'])));
				  
				  //allowed extensions
				  $extensions= array("png");
				  
				  //checking file extension
				  if(in_array($file_ext,$extensions)=== false){
					 $file_err="extension not allowed, please choose a PNG file for Logo.";
					 $_SESSION['msg']="extension not allowed, please choose a PNG file for Logo.";
					$_SESSION['msg_type']="alert alert-danger alert-dismissable";
					$Function->Redirect("settings.php");
				  }
				  
				  //if no errors then upload file
				  if(empty($file_err)==true){
					 move_uploaded_file($file_tmp,"uploads/".$logo_file_name);
					 //chmod("uploads/".$file_name, 777); 
					 $db->Update_Record("settings","meta_value='$logo_file_name' where meta_key='logo'");
				  }
				  
  			 }
		



					$_SESSION['msg']="Settings has been updated Successfully";

					$_SESSION['msg_type']="alert alert-success alert-dismissable";

					$Function->Redirect("settings.php");

			

    }


$db_settings=$db->selectMultiRecords("select * from settings order by setting_id");

$settings=array();

foreach($db_settings as $row) {

		$settings[$row['meta_key']]=$row['meta_value'];

}



?>
<?php include("pages/header.php"); ?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> SETTINGS </h1>
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
            <h3 class="box-title">SETTINGS</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="addSettings" action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Google Analytics</label>
                  <textarea class="form-control" name="settings[google_analytics]" rows="4"><?php echo $settings['google_analytics']; ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Google Tag manager</label>
                  <textarea class="form-control" name="settings[tag_manager]" rows="4"><?php echo $settings['tag_manager']; ?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Facebook Pixel</label>
                  <input type="text" class="form-control" value="<?php echo $settings['fb_pixel']; ?>" name="settings[fb_pixel]" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Favicon</label>
                  <input type="file" class="form-control"  name="favicon">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname">Logo</label>
                  <input type="file" class="form-control"  name="logo">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" class="btn btn-primary" name="UpdateSettings" value="Save Settings" />
              
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

 // $('#datetimepicker1').datetimepicker();

});

	</script>
