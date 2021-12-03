<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");



$username="";

$first_name="";
$last_name="";
$password="";
$email="";
$group_id="";
$cpassword="";
$expiry_date="";
$state="";
$zipcode="";
$address="";
$dob="";

if(isset($_REQUEST['group_id'])) {

	$group_id=$_REQUEST['group_id'];
}

if(isset($_POST['addUser'])){



        $username = trim(addslashes($_POST['username']));
        $first_name = trim(addslashes($_POST['first_name']));
		$last_name = trim(addslashes($_POST['last_name']));
		$password = trim(addslashes($_POST['password']));
        $email = trim(addslashes($_POST['email']));
		$cpassword = trim(addslashes($_POST['cpassword']));
		$expiry_date = trim(addslashes($_POST['expiry_date']));
		$state = trim(addslashes($_POST['state']));
		$zipcode = trim(addslashes($_POST['zipcode']));
		$address = trim(addslashes($_POST['address']));
		$dob = trim(addslashes($_POST['dob']));

		

		

		if($username=="" || $email=="" || $password=="") {

			$_SESSION['msg']="Please Fill all Fields";

			$_SESSION['msg_type']="alert alert-danger alert-dismissable";

										

		

		} else {

				

				$check=true;

				

				if($password!=$cpassword) {

					$check=false;

					$_SESSION['msg']="Both passwords must match.";

					$_SESSION['msg_type']="alert alert-danger alert-dismissable";

					

				}

				

				$check_username=$db->countRecords("select * from users where username='$username'");

				if($check_username>0) {

						$check=false;

						$_SESSION['msg']="Username already exists.";

						$_SESSION['msg_type']="alert alert-danger alert-dismissable";

				

				}

				

				$check_email=$db->countRecords("select * from users where email='$email'");

				if($check_email>0) {

						$check=false;

						$_SESSION['msg']="Email already exists.";

						$_SESSION['msg_type']="alert alert-danger alert-dismissable";

				

				}

				

				

				if($check) {

					$password=md5($password);

					$fields="username,group_id,password,status,first_name,last_name,email,expiry_date,state,zipcode,address,dob";

        			$vals="'$username','$group_id','$password','Active','$first_name','$last_name','$email','$expiry_date','$state','$zipcode','$address','$dob'"; 

				

				

					$db->Add_Record("users",$fields,$vals);

        	

					$_SESSION['msg']="User has been added Successfully";

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
    <h1> <i class="fa fa-users"></i> Employee Management <small>Add / Edit Employee</small> </h1>
  </section>
  <section class="content">
    <div class="row">
      <!-- left column -->
      <?php if($_SESSION['msg']!="") { ?>
      <div class="<?php echo $_SESSION['msg_type']; ?>"> <?php echo $_SESSION['msg']; ?> </div>
      <?php } ?>
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Add New Employee</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" id="addNewUser" action="" method="post" onSubmit="return checkForm();">
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
			
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Role</label>
                  <select name="group_id" class="form-control required">
                    <?php 

										$roles=$db->selectMultiRecords("select * from user_groups order by group_name");

										

										  foreach($roles as $role_info) {

										  

										  ?>
                    <option value="<?php echo $role_info['group_id'] ?>" <?php if($group_id==$role_info['group_id']) { ?> selected="selected" <?php } ?>><?php echo $role_info['group_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
			  <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Expiry Date</label>
                 <input type="date" name="expiry_date" value="<?php echo date('Y-m-d', strtotime('+2 week', strtotime(date("Y-m-d")))); ?>" class="form-control required" />
                </div>
              </div>
            </div>
			
			<div class="row">
			
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Address</label>
                   <input type="text" name="address" value="<?php echo $address; ?>" class="form-control" />
                </div>
              </div>
			  <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Date of Birth</label>
                 <input type="date" name="dob" value="<?php echo $dob; ?>" class="form-control" />
                </div>
              </div>
            </div>
			
			<div class="row">
			
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">State</label>
                  <select name="state" class="form-control required">
                      <option value="">Select State</option>
                    <?php 

										
										$states=$db->selectMultiRecords("select * from states order by code");

										

										  foreach($states as $state) {

										  

										  ?>
              <option value="<?php echo $state['id'] ?>" <?php if($state==$state['id']) { ?> selected="selected" <?php } ?>><?php echo $state['code'] ?></option>
              <?php } ?>
               </select>
              </div>
			  </div>
			  <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Zip Code</label>
                 <input type="text" name="zipcode" value="<?php echo $zipcode; ?>" class="form-control required" />
                </div>
              </div>
            </div>
					
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Password</label>
                  <input type="password" class="form-control required"  id="password" name="password" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Confirm Password</label>
                  <input type="password" class="form-control required"  id="cpassword" name="cpassword" required>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <input type="submit" class="btn btn-primary" name="addUser" value="Submit" />
              <input type="reset" class="btn btn-default" value="Reset" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include("pages/footer.php"); ?>
<script type="text/javascript">

  function checkForm(form)
  {
   
 	var pass=$("#password").val();
	
	
    if(pass != "" ) {
      if(pass.length < 8) {
        alert("Error: Password must contain at least eight characters!");
        return false;
      }
      
      re = /[0-9]/;
      if(!re.test(pass)) {
        alert("Error: password must contain at least one number (0-9)!");
        return false;
      }
      re = /[a-z]/;
      if(!re.test(pass)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        return false;
      }
      re = /[A-Z]/;
      if(!re.test(pass)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      return false;
    }

  
    return true;
  }

</script>
