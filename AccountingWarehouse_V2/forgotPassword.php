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

$hash="";
$email="";
$action="forgot";
$password="";
$cpassword="";
$validate=false;

if(isset($_REQUEST['hash'])) {

	$hash=addslashes($_REQUEST['hash']);
}
if(isset($_REQUEST['email'])) {

	$email=addslashes($_REQUEST['email']);
}

if(isset($_REQUEST['action'])) {

	$action=addslashes($_REQUEST['action']);
}

if(isset($_REQUEST['password'])) {

	$password=addslashes($_REQUEST['password']);
}
if(isset($_REQUEST['cpassword'])) {

	$cpassword=addslashes($_REQUEST['cpassword']);
}

if($action=="do_forgot") {
		
			$check_user=$db->countRecords("select * from users where email='".$email."'");
			
			if($check_user>0) {
						$hash=md5($email.time());
						
						$update_user=$db->Update_Record("users"," hash='$hash' where email='$email'");
						
						if($update_user) {
								 $msg 	= "<h3>Forgot Password</h3>";
								 $msg 	.= "You have requested to change your password . Please follow the link to do so , ";
								 $msg	.="<br><a href='".$config['sitename']."forgotPassword.php?hash=$hash&email=$email&action=change'>Click Here</a> to Change Password";
								 $msg	.="<br><br>Thanks";
								
							
                                $mail = new PHPMailer;
                            	$mail->From = "info@theaccountingwarehouse.xyz";
                            	$mail->FromName = "The Accounting Warehouse";
	                            $mail->addAddress($email);
    	
                            	$mail->isHTML(true);
	                            $mail->Subject = "Forgot Password";
                            	$mail->Body = $msg;
                            	$mail->send();
                                
                                
 	 							$sentMail = mail($email, $subject, $body, $headers);
      							$_SESSION['msg']="Email has been sent to Your Email address . Check Your inbox";
			                      $Function->Redirect('forgotPassword.php?action=sent');
						
						}
			
			} else {
					 $_SESSION['msg']="User with this Email address not found";
                      $Function->Redirect('forgotPassword.php?action=forgot');
			
			}
			


}

if($action=="change") {
				
					$user_info=$db->selectFrom("select * from users where email='$email'");
					if($user_info['hash']==$hash) {
						$validate=true;
					}
}

if($action=="do_change") {
				
					$user_info=$db->selectFrom("select * from users where email='$email'");
									
					if($user_info['hash']!=$hash) {

					 	$_SESSION['msg']="Invalid Information";
                      	$Function->Redirect('forgotPassword.php?hash=$hash&email=$emailaction=change');
						exit;
					}
					
					if($user_info['email']!=$email) {

					 	$_SESSION['msg']="Invalid Information";
                      	$Function->Redirect('forgotPassword.php?hash=$hash&email=$emailaction=change');
						exit;
					}
					
					if($password!=$cpassword){
					
						 $_SESSION['msg']="Passwords do not match";
                     	 $Function->Redirect('forgotPassword.php?hash=$hash&email=$emailaction=change');
						 exit;
					}
					
					if($password==$user_info['old_password']){
					
						 $_SESSION['msg']="You can not use your old password";
                     	 $Function->Redirect('forgotPassword.php?hash=$hash&email=$emailaction=change');
						 exit;
					}
					
					
					$password=md5($password);
					
					$update_user=$db->Update_Record("users", " password='$password' where email='$email'" );
					
					if($update_user) {
								$_SESSION['msg']="Passwords has been changed successfully";
                     			$Function->Redirect('login.php');
					
					} else {
								$_SESSION['msg']="Error while changing password";
                     			$Function->Redirect('forgotPassword.php?hash=$hash&email=$email&action=change');
					
					}
					
					
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>ACCOUNTING WAREHOUSE</title>
<!-- Bootstrap Core CSS -->
<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- MetisMenu CSS -->
<link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="dist/css/sb-admin-2.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>

.sign_in {
margin-top:10%;


}

</style>
</head>
<body>
<?php if($action=="forgot") { ?>
<div class="container sign_in">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Forgot Password</h3>
        </div>
        <div class="panel-body">
          <form action="" method="post" name="loginfrm">
            <input type="hidden" name="action" value="do_forgot">
            <font color="#FF0000">
            <?php 
        if(isset($_SESSION['msg'])) 
            {
                echo $_SESSION['msg'];
            }
        
        ?>
            <br>
            </font>
            <label>Email Address</label>
            <input  id="email" name="email" type="email" class="form-control" placeholder="Email here..." required/>
            <br/>
            <button type="submit" class="btn btn-success btn-block"  onclick="return Validate_Me();">Send Password</button>
            <!--<button class="btn btn-success btn-block">Sign In</button>-->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php if($action=="sent") { ?>
<div class="container sign_in">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Forgot Password</h3>
        </div>
        <div class="panel-body"> <font color="#FF0000">
          <?php 
        if(isset($_SESSION['msg'])) 
            {
                echo $_SESSION['msg'];
            }
        
        ?>
          <br>
          </font> </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php if($action=="change" && $validate=true) { ?>
<div class="container sign_in">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Please Change Your Passowrd</h3>
        </div>
        <div class="panel-body">
          <form action="" method="post" name="changeForm">
            <input type="hidden" name="hash" value="<?php echo $hash ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>" >
            <input type="hidden" name="action" value="do_change" >
            <font color="#FF0000">
            <?php 
        if(isset($_SESSION['msg'])) 
            {
                echo $_SESSION['msg'];
            }
        
        ?>
            </font>
            <label>New Passowrd</label>
            <input  id="password" name="password" type="password" class="form-control" maxlength="10"  required/>
            <br>
            <label>Confirm Passoword</label>
            <input id="cpassword" name="cpassword" type="password" class="form-control"  maxlength="10" required/>
            <br/>
            <button type="submit" class="btn btn-success btn-block" >Change Passowrd</button>
            <!--<button class="btn btn-success btn-block">Sign In</button>-->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!-- jQuery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>
</body>
</html>
<?php
$_SESSION['msg']='';

?>
