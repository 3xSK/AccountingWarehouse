<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");

$user_id=0;

if(isset($_SESSION['user_id'])) {
		$user_id=intval($_SESSION['user_id']);
		
}

$username="";
$first_name="";
$last_name="";
$password="";
$email="";
$cpassword="";
$old_password="";
$changepass=false;

$user_info=$db->selectFrom("select * from users where user_id=$user_id");

$username=$user_info['username'];
$first_name=$user_info['first_name'];
$last_name=$user_info['last_name'];
$password=$user_info['password'];
$email=$user_info['email'];





if(isset($_POST['editUser'])){

		
        $username = trim(addslashes($_POST['username']));
        $first_name = trim(addslashes($_POST['first_name']));
		$last_name = trim(addslashes($_POST['last_name']));
		$password = trim(addslashes($_POST['password']));
		$old_password = trim(addslashes($_POST['old_password']));
        $email = trim(addslashes($_POST['email']));
		$cpassword = trim(addslashes($_POST['cpassword']));

		if(isset($_POST['change_password'])) {
				$changepass=true;
		}
		
		if($username=="" || $first_name=="" || $email=="") {
			$_SESSION['msg']="Please Fill all Fields";
			$_SESSION['msg_type']="alert alert-danger alert-dismissable";
										
		
		} else {
				$check=true;
			
			if($changepass) {
				
				
			
				if($password!=$cpassword) {
					$check=false;
					$_SESSION['msg']="Both passwords must match.";
					$_SESSION['msg_type']="alert alert-danger alert-dismissable";
					
				}
				
				if(md5($old_password)!=$user_info['password']) {
					$check=false;
					$_SESSION['msg']="Old Password is incorrect.";
					$_SESSION['msg_type']="alert alert-danger alert-dismissable";
					
				}
				
				$password=md5($password);
			}
				
				$check_username=$db->countRecords("select * from users where username='$username' and user_id!=$user_id");
				if($check_username>0) {
						$check=false;
						$_SESSION['msg']="Username already exists.";
						$_SESSION['msg_type']="alert alert-danger alert-dismissable";
				
				}
				
				$check_email=$db->countRecords("select * from users where email='$email' and user_id!=$user_id");
				if($check_email>0) {
						$check=false;
						$_SESSION['msg']="Email already exists.";
						$_SESSION['msg_type']="alert alert-danger alert-dismissable";
				
				}
				
				
				if($check) {
					$uploadOk = 0;
				
				if($_FILES["profile_image"]["name"]!="") {	
					$target_dir = "uploads/";
                	$randomName = rand(1,1000);
                
                	$target_file = $target_dir . basename($randomName.$_FILES["profile_image"]["name"]);
                	$target_name=basename($randomName.$_FILES["profile_image"]["name"]);
                	$uploadOk = 1;
                	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                	    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
                	    if($check !== false) {
                	    	move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
                	        $profile_image_path = $target_file;
                	        $uploadOk = 1;
                	    } else {
                	        echo "File is not an image. Please select an image for Profile Picture";
                	        $uploadOk = 0;
                	        exit;
                	    }
				}
				
				
					$params="username='$username',first_name='$first_name',last_name='$last_name',email='$email'";
					
					if($uploadOk==1) {
					    $params.=",profile_image='".$target_name."'";
					}
					
				
					if($changepass) {
						$params=$params.",password='$password',old_password='$password'";
					}
        			
					$params=$params." where user_id='$user_id'";
			
					$db->Update_Record("users",$params);
        	
					$_SESSION['msg']="Profile has been updated Successfully";
					$_SESSION['msg_type']="alert alert-success alert-dismissable";
					$Function->Redirect("users.php");
				}
		
		}
       
    }






?>
<?php include("pages/header.php"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Profile Management
            <small>Profile</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
				<?php if($_SESSION['msg']!="") { ?>
		<div class="<?php echo $_SESSION['msg_type']; ?>">
             <?php echo $_SESSION['msg']; ?>
        </div>
		<?php } ?>
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    
                    <!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addNewUser" action="" method="post" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $id ?>" />
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Username</label>
                                        <input type="text" class="form-control required" value="<?php echo $username; ?>" id="Username" name="username" required>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
										 <label for="fname">Email Address</label>
                                        <input type="email" class="form-control required" value="<?php echo $email; ?>" id="email" name="email" required>
                                       
                                    </div>
                                </div>
						</div>
						 <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="fname">First Name</label>
                                        <input type="text" class="form-control required" value="<?php echo $first_name; ?>" id="first_name" name="first_name" required>
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                       <label for="fname">Last Name</label>
                                        <input type="text" class="form-control required" value="<?php echo $last_name; ?>" id="last_name" name="last_name" required>
                                    </div>
                                </div>
								
								
						</div>
						<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="fname">Profile Photo</label>
                                        <input type="file" class="form-control required"  name="profile_image" accept=".jpg,.jpeg">
                                    </div>
                                </div>
								
					
						</div>
						<div class="row">
								 <div class="col-md-6">
								 <input type="checkbox" name="change_password" value="1" onclick="ChangePassword();"  id="ChangePass"/><label for="ChangePass">&nbsp;Change Password</label>
								 </div>
						</div>
						 <div  class="row" id="row_password" style="display:none">
						 	
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Old Password</label>
                                        <input type="password" class="form-control"  id="old_passowrd" name="old_password" value="" autocomplete="off">
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">New Password</label>
                                        <input type="password" class="form-control"  id="password" name="password" value="" autocomplete="off">
                                    </div>
                                </div>
								
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fname">Confirm Password</label>
                                        <input type="password" class="form-control"  id="cpassword" name="cpassword" value="">
                                    </div>
                                </div>
								
							</div>
							
						
						
						
						<br />
						
                            
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" name="editUser" value="Save" />
                                <input type="reset" class="btn btn-default" value="Reset" />
                            </div>
                    </form>
                    </div>
                </div>
                
            </div>
    </section>

    </div>
	<?php include("pages/footer.php"); ?>
	<script>
	


function ChangePassword() {
	$("#row_password").toggle();
}
	</script>