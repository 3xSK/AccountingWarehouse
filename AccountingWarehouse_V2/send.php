<?php
session_start();
error_reporting(E_ERROR);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require('config.php');


$user_id=0;
$subject="";
$message="";


if(isset($_POST['send'])){
	
	$user_id=addslashes($_POST['user_id']);
	$subject=$_POST['subject'];
	$message=$_POST['message'];
			
			 					$mail = new PHPMailer;
                            	$mail->From = "info@theaccountingwarehouse.xyz";
                            	$mail->FromName = "The Accounting Warehouse";
	                            $mail->addAddress($user_id);
    	
                            	$mail->isHTML(true);
	                            $mail->Subject = $subject;
                            	$mail->Body = $message;
                            
                            if($mail->send()) {    
									$_SESSION['msg']="Email has been sent successfully";
									$_SESSION['msg_type']="alert alert-success alert-dismissable";
									
							} else {
							
									$_SESSION['msg']="There is an error while sending the email";
									$_SESSION['msg_type']="alert alert-danger alert-dismissable";
									
							
							}

			
 }


?>

<?php include("pages/header.php"); ?>
<script type="text/javascript" src="assets/sckeditor/ckeditor/ckeditor.js"></script>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            <i class="fa fa-users"></i> SEND EMAIL

           

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

				

                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="fname">User</label>

                                        <select name="user_id" class="form-control required">
										<option value="">Select User</option>
									<?php 

										$users=$db->selectMultiRecords("select * from users  where (group_id=2 or group_id=4) order by first_name,last_name");

										

										  foreach($users as $user) {

										  

										  ?>

										<option value="<?php echo $user['email'] ?>"><?php echo $user['first_name']." ".$user['last_name'].' ('.$user['email'].')'; ?></option>

									<?php } ?>

										

										</select>

                                    </div>

                                </div>
								
								
								
								

						</div>

						 <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label for="fname">Subject</label>

                                        <input type="text" class="form-control required" value="<?php echo $subject;?>" id="subject" name="subject" required>

                                    </div>

                                </div>
								
								

								

						</div>

						<div class="row">
								<div class="col-md-12">

                                    <div class="form-group">

                                        <label for="fname">Email Body</label>

										 <textarea class="form-control" id="message" name="message" rows="4"><?php echo $message; ?></textarea>

                                      

                                    </div>

                                </div>
                                

								

						</div>
						
				

						

						<br />

						

                            

                            <!-- /.box-body -->



                            <div class="box-footer">

                                <input type="submit" class="btn btn-primary" name="send" value="SEND" />
                                 <input type="button" onclick="history.go(-1);" class="btn btn-default" value="Back" />

                                <input type="reset" class="btn btn-default" value="Reset" />

                            </div>

                    </form>

                    </div>

                </div>

                

            </div>

    </section>



    </div>
<script>

CKEDITOR.replace('message',{contentsCss : 'http://brcl.edu.pk/css/dark-blue.css',width:'1116',height:'500',customConfig:'ck_config_v5.js'});

</script>
	<?php include("pages/footer.php"); ?>

	