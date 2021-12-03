<?php



if(!isset($_SESSION['username'])){

	echo "<script>window.location.href='login.php'</script>";

	

	exit;

	}


$check_session=$db->countRecords("select * from user_sessions where user_id='".$_SESSION["user_id"]."' and session_id='".$_SESSION["session_id"]."'");





if($check_session<=0)

	{

		session_start();

		session_destroy();

	echo "<script>window.location.href='login.php'</script>";

	

	}

	

	$last_month=date("Y-m-1",strtotime("-1 Months")); 

	

	

	$delete_session=$db->Delete_Record("user_sessions"," session_date<='".$last_month."'");

?>