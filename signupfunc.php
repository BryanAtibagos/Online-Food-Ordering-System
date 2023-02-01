<?php
session_start();
include "db_conn.php";
if (isset($_POST['customer_email']) && isset($_POST['password'])
    && isset($_POST['customer_firstname']) && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$customer_email = validate($_POST['customer_email']);
	$pass = validate($_POST['password']);
    $customer_lastname = validate($_POST['customer_lastname']);
    $customer_address = validate($_POST['customer_address']);
    $customer_number = validate($_POST['customer_number']);

	$re_pass = validate($_POST['re_password']);
	$customer_firstname = validate($_POST['customer_firstname']);

	$user_data = 'customer_email='. $customer_email. '&customer_firstname='. $customer_firstname;


	if (empty($customer_email)) {
		header("Location: signup.php?error=User Name is required&$user_data");
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=Password is required&$user_data");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=Re Password is required&$user_data");
	    exit();
	}
    else if(empty($customer_lastname)){
        header("Location: signup.php?error=Lastname is required&$user_data");
	    exit();
	}
    else if(empty($customer_number)){
        header("Location: signup.php?error=number is required&$user_data");
	    exit();
	}
    else if(empty($customer_address)){
        header("Location: signup.php?error=address is required&$user_data");
	    exit();
	}

	else if(empty($customer_firstname)){
        header("Location: signup.php?error=Name is required&$user_data");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: signup.php?error=The confirmation password  does not match&$user_data");
	    exit();
	}

	else{

		// hashing the password
        

	    $sql = "SELECT * FROM customer WHERE customer_email='$customer_email' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO customer(customer_lastname, customer_firstname, customer_address, customer_number, customer_email,  customer_password) 
                        VALUES('$customer_lastname','$customer_firstname','$customer_address','$customer_number','$customer_email', '$pass')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
           	 header("Location: signup.php?success=Your account has been created successfully");
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred&$user_data");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}