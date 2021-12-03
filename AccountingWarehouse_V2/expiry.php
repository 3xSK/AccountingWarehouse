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


		
			$expiring_users=$db->selectMultiRecords("SELECT DATEDIFF(password_date , NOW()) as expiry,email,first_name,last_name as date_diff from users ");
			
	        foreach($expiring_users as $expiry_user) {
	            
	            if($expiry_user['expiry']==3) {
	              
	                             $msg 	= "<h3>Password Expiry</h3>";
								 $msg 	.= "Dear User Your password is going to expire in 3 days . please login to update your informaiton ";
								 $msg	.="<br><br>Thanks";
								
							
                                $mail = new PHPMailer;
                            	$mail->From = "info@theaccountingwarehouse.xyz";
                            	$mail->FromName = "The Accounting Warehouse";
	                            $mail->addAddress($expiry_user['email']);
    	
                            	$mail->isHTML(true);
	                            $mail->Subject = "Password Expiry";
                            	$mail->Body = $msg;
                            	$mail->send();
	                
	            }
	        }
						
					
?>

