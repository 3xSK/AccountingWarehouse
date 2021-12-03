<?php

error_reporting(E_ERROR);

session_start();

include_once("config.php");



$user_id=0;



if(isset($_REQUEST['user_id'])) {

		$user_id=intval($_REQUEST['user_id']);

}


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
$block_date="";



$user_info=$db->selectFrom("select * from users where user_id=$user_id");

						

$username=$user_info['username'];
$first_name=$user_info['first_name'];
$last_name=$user_info['last_name'];
$password=$user_info['password'];
$email=$user_info['email'];
$group_id=$user_info['group_id'];
$status=$user_info['status'];
$expiry_date=$user_info['expiry_date'];
$state=$user_info['state'];
$zipcode=$user_info['zipcode'];
$address=$user_info['address'];
$dob=$user_info['dob'];











if(isset($_POST['editUser'])){



        $username = trim(addslashes($_POST['username']));
        $first_name = trim(addslashes($_POST['first_name']));
		$last_name = trim(addslashes($_POST['last_name']));
		$password = trim(addslashes($_POST['password']));
        $email = trim(addslashes($_POST['email']));
		$expiry_date = trim(addslashes($_POST['expiry_date']));
		$state = trim(addslashes($_POST['state']));
		$zipcode = trim(addslashes($_POST['zipcode']));
		$address = trim(addslashes($_POST['address']));
		$dob = trim(addslashes($_POST['dob']));
		$status = trim(addslashes($_POST['status']));
		

		if($username=="" || $email=="") {

			$_SESSION['msg']="Please Fill all Fields";

			$_SESSION['msg_type']="alert alert-danger alert-dismissable";

										

		

		} else {

				$check=true;

			

			if($password!="") {

				if($password!=$cpassword) {

					$check=false;

					$_SESSION['msg']="Both passwords must match.";

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

					

					

					$params="username='$username',group_id='$group_id',status='$status',first_name='$first_name',last_name='$last_name',email='$email',
								expiry_date='$expiry_date',state='$state',zipcode='$zipcode',address='$address',dob='$dob'";

					

					if($password!="") {

						$params=$params.",password='$password'";

					}
					
					if($block_date!="") {

						$params=$params.",status='block',block_date='$block_date'";

					}
                    
                    
        			

					$params=$params." where user_id='$user_id'";

			

					$db->Update_Record("users",$params);

        	

					$_SESSION['msg']="User has been updated Successfully";

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

            <i class="fa fa-users"></i> UPDATE EMPLOYEE INFORMATION

           

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

            <div class="col-md-12">

                <!-- general form elements -->

                <div class="box box-primary">

                 

                    <!-- /.box-header -->

                    <!-- form start -->

                    

                    <form role="form" id="addNewUser" action="" method="post">

					<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />

                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">Username</label>

                                        <input disabled="" type="text" class="form-control required" value="<?php echo $username; ?>" id="username" name="username" required>

                                    </div>

                                </div>
								<div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">Email Address</label>

                                        <input disabled="" type="email" class="form-control required" value="<?php echo $email; ?>" id="email" name="email" required>

                                    </div>

                                </div>
								
								
								

						</div>

						 <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">First Name</label>

                                        <input disabled="" type="text" class="form-control required" value="<?php echo $first_name; ?>" id="first_name" name="first_name" required>

                                    </div>

                                </div>
								
								<div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">Last Name</label>

                                        <input disabled="" type="text" class="form-control required" value="<?php echo $last_name; ?>" id="last_name" name="last_name" required>

                                    </div>

                                </div>

								

						</div>

						<div class="row">
								<div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">Role</label>

										

                                        <select disabled="" name="group_id" class="form-control required">

									<?php 

										$roles=$db->selectMultiRecords("select * from user_groups order by group_id");

										

										  foreach($roles as $role_info) {

										  

										  ?>

										<option value="<?php echo $role_info['group_id'] ?>" <?php if($group_id==$role_info['group_id']) { ?> selected="selected" <?php } ?>><?php echo $role_info['group_name'] ?></option>

									<?php } ?>

										

										</select>

                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">Status</label>

                                        <select disabled="" name="status" class="form-control required">

											<option value="Active" <?php if($status=='Active') { ?> selected="selected" <?php } ?>>Active</option>
												<option value="Pending" <?php if($status=='Pending') { ?> selected="selected" <?php } ?>>Pending</option>

											<option value="block" <?php if($status=='block') { ?> selected="selected" <?php } ?>>Blocked</option>

										</select>

                                    </div>

                                </div>

								

						</div>
						
							<div class="row">
			
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Address</label>
                   <input disabled="" type="text" name="address" value="<?php echo $address; ?>" class="form-control" />
                </div>
              </div>
			  <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Date of Birth</label>
                 <input disabled="" type="date" name="dob" value="<?php echo $dob; ?>" class="form-control" />
                </div>
              </div>
            </div>
			
			<div class="row">
			
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">State</label>
                  <select disabled="" name="state" class="form-control required">
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
                 <input disabled="" type="text" name="zipcode" value="<?php echo $zipcode; ?>" class="form-control required" />
                </div>
              </div>
            </div>
            
            	<div class="row">
			
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Block User</label>
                  <select disabled="" name="block_date" class="form-control required">
                      <option value=""></option>
                      <option value="<?php echo date('Y-m-d', strtotime("+1 Day", strtotime(date("Y-m-d")))); ?>">1 Day</option>
                      <option value="<?php echo date('Y-m-d', strtotime("+7 Day", strtotime(date("Y-m-d")))); ?>">1 Week</option>
                      <option value="<?php echo date('Y-m-d', strtotime("+14 Day", strtotime(date("Y-m-d")))); ?>">2 Weeks</option>
                      <option value="<?php echo date('Y-m-d', strtotime("+1 Months", strtotime(date("Y-m-d")))); ?>">1 Month</option>
                      <option value="<?php echo date('Y-m-d', strtotime("+2 Months", strtotime(date("Y-m-d")))); ?>">2 Months</option>
                      <option value="<?php echo date('Y-m-d', strtotime("+3 Months", strtotime(date("Y-m-d")))); ?>">3 Months</option>
                      <option value="<?php echo date('Y-m-d', strtotime("+12 Months", strtotime(date("Y-m-d")))); ?>">1 Year</option>
                      
               </select>
              </div>
			  </div>
			
            </div>

						 <div class="row">

						 	

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">Password</label>

                                        <input disabled=""type="password" class="form-control"  value="" autocomplete="off" id="password" name="password">

                                    </div>

                                </div>

								<div class="col-md-6">

                                    <div class="form-group">

                                        <label for="fname">Confirm Password</label>

                                        <input disabled="" type="password" class="form-control"  id="cpassword" name="cpassword">

                                    </div>

                                </div>

									

						</div>

						 <div class="row">

						 	 <div class="col-md-6">

                                <small>if you don't want to change password then do not enter password</small>

							</div>

						</div>

						

						<br />

						

                            

                            <!-- /.box-body -->



                            <div class="box-footer">

                               <a href="users.php"><input type="button" class="btn btn-primary" value="Go Back" /></a>
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

  $('#datetimepicker1').datetimepicker();

});

	</script>