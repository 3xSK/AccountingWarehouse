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

$username="";
$group_id="";
$first_name="";
$last_name="";
$email="";
$address="";
$state="";
$zipcode="";
$dob="";

if(isset($_POST['addUser'])){
	
	$username=addslashes($_POST['username']);
	$group_id=addslashes($_POST['group_id']);
	$first_name=addslashes($_POST['first_name']);
	$last_name=addslashes($_POST['last_name']);
	$email=addslashes($_POST['email']);
	$password=addslashes($_POST['password']);
	$address=addslashes($_POST['address']);
	$state=addslashes($_POST['state']);
	$zipcode=addslashes($_POST['zipcode']);
	$dob=addslashes($_POST['dob']);
	
	$check_query="select * from users where email='".trim($email)."'";
	$resultCount=$db->countRecords($check_query);
	
	if($resultCount>0){
		$displayMsg = "display:block";
        $msgType = "info";
         $_SESSION['msg'] = "Email Address already exists";
		$Function->Redirect('register.php');  
		exit;
	}
	$check_query="select * from users where username='".trim($username)."'";
	$resultCount=$db->countRecords($check_query);

	if($resultCount>0){
		$displayMsg = "display:block";
        $msgType = "info";
         $_SESSION['msg'] = "Username already exists";
		$Function->Redirect('register.php');  
		exit;
	}
	
    $code=md5(time().$email);  
	$password=md5($password);

	$password_date=date('Y-m-d', strtotime("+4 months", strtotime(date("Y-m-d"))));
		
	$fields="username,group_id,first_name,last_name,email,password,old_password,address,state,zipcode,dob,code,status,password_date";
	$vals="'$username','$group_id','$first_name','$last_name','$email','$password','$password','$address','$state','$zipcode','$dob','$code','Pending','$password_date'";


	 $register=$db->Add_Record("users",$fields,$vals);
		
  if($register){
    
    
    $mail = new PHPMailer;
	$mail->From = "info@theaccountingwarehouse.xyz";
	$mail->FromName = "The Accounting Warehouse";
	$mail->addAddress("theacctwarehouse@gmail.com");
	
	$mail->isHTML(true);
	$mail->Subject = "New Account";
	$mail->Body = '<strong>Dear Admin , <br><br></strong><p>'.$first_name.' '.$last_name.'('.$email.') '.'has made account <a href="http://www.theaccountingwarehouse.xyz/activate.php?code='.$code.'">click here</a> to activate it</p><p>Thanks,</p>';
  	$mail->send();
  	
  	
        $displayMsg = "display:block";
        $msgType = "success";
         $_SESSION['msg'] = "Congratulations!  Your account has been registered.<a href='login.php'>Click here</a> to Login<br><br>";
   }else{
		

        $displayMsg = "display:block";
        $msgType = "info";
        $_SESSION['msg'] = "Error While registering. please try again . ";
		$Function->Redirect('register.php');  

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







label {



margin-top:10px;











}










}







</style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <H3 style="color:white; text-align:center">ACCOUNTING WAREHOUSE</H3>
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Register Yourself!</h3>
        </div>
        <div class="panel-body">
          <form action="" method="post" name="loginfrm">
            <font color="#FF0000">
            <?php 



        if(isset($_SESSION['msg'])) 



            {



                echo $_SESSION['msg'];



            }



        



        ?>
            </font>
            <label>Account Type</label>
            <select name="group_id" class="form-control required">
              <?php 

										$roles=$db->selectMultiRecords("select * from user_groups order by group_name");

										

										  foreach($roles as $role_info) {

										  

										  ?>
              <option value="<?php echo $role_info['group_id'] ?>" <?php if($group_id==$role_info['group_id']) { ?> selected="selected" <?php } ?>><?php echo $role_info['group_name'] ?></option>
              <?php } ?>
            </select>
            <label>First Name</label>
            <input  id="first_name" name="first_name" onBlur="CreateUsername();" value="<?php echo $first_name; ?>" type="text" class="form-control" placeholder="First Name..." required/>
            <label>Last Name</label>
            <input  id="last_name" name="last_name" onBlur="CreateUsername();" type="text" value="<?php echo $last_name; ?>" class="form-control" placeholder="Last Name..." required/>
            <label>Username</label>
            <input  id="username" name="username" readonly="" value="<?php echo $username; ?>" type="text" class="form-control" placeholder="Username..." required/>
            <label>Email</label>
            <input  id="email" name="email" type="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email ..." required/>
			<label>Password</label>
            <input  id="password" name="password" type="password" class="form-control" placeholder="Password ..." required/>
            <br>
            <small>The password must contain at least 8 character long among the following:

    Uppercase characters (A-Z)
    Lowercase characters (a-z)
    Digits (0-9)</small>
			<label>Confirm Password</label>
            <input  id="cpassword" name="cpassword" type="password" class="form-control" placeholder="Confirm Password ..." required/>
            <label>Address</label>
            <input  id="address" name="address" type="text" class="form-control" value="<?php echo $address; ?>" placeholder="Address ..." required/>
            <label>State</label>
			 <select name="state" class="form-control required">
              <?php 

										$states=$db->selectMultiRecords("select * from states order by code");

										

										  foreach($states as $state) {

										  

										  ?>
              <option value="<?php echo $state['id'] ?>" <?php if($state==$state['id']) { ?> selected="selected" <?php } ?>><?php echo $state['code'] ?></option>
              <?php } ?>
            </select>
            <label>Zipcode</label>
            <input  id="zipcode" name="zipcode" type="text" value="<?php echo $zipcode; ?>" class="form-control" placeholder="Zipcode ..." required/>
            <label>Date of Birth</label>
            <input name="dob" type="date" class="form-control" value="<?php echo $dob; ?>"  placeholder="Date of Birth..." required/>
            <br/>
            <button type="submit" name="addUser" class="btn btn-success btn-block"  onclick="return Validate_Me();">Sign Up</button>
            <br>
            <a href="login.php">>> Back to Login</a>
            <!--<button class="btn btn-success btn-block">Sign In</button>-->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
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
<script>


var date_time="<?php echo date("my"); ?>";

function CreateUsername() {
		
		var username=$("#first_name").val() + $("#last_name").val() + date_time;
		$("#username").val(username);

}


function Validate_Me()     {
		
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
<?php



$_SESSION['msg']='';







?>
