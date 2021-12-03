<?php
error_reporting(E_ERROR);
session_start();
include_once("config.php");

$_SESSION['msg']='<p>Error while activating the account . please try again later. Thanks</p>';
if(isset($_REQUEST['code']))  {

                $code=addslashes(trim($_REQUEST['code']));
                 $activate=$db->Update_Record("users"," status='Active' where code='".$code."'");

				
				if($activate) {

                        $_SESSION['msg']='<p>The Account is not active. <a href="login.php">Click here</a> to login</p>';
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







    <div class="container">



        <div class="row">

            

            <div class="col-md-6 col-md-offset-3">
                <div style="text-align:center"><img src="images/AW_Logo.png" width="50%" height="50%"  /></div>
			              
						    <?php echo $_SESSION['msg']; ?>

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


<?php



$_SESSION['msg']='';







?>



