<?php
session_start();
include "db_conn.php";
if(isset($_POST['uname']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)){
        header("Location: customerlogin.php?error=Username is required");
        exit();
    }else if(empty($pass)){
        header("Location: customerlogin.php?error=Password is required");
        exit();
    }else{
        
        $sql = "SELECT * FROM customer WHERE customer_email = '$uname' AND customer_password = '$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) ===1 ){
            $row = mysqli_fetch_assoc($result);
            if ($row['customer_email'] === $uname && $row['customer_password'] === $pass){
                $_SESSION['customer_email'] = $row['customer_email'];
                $_SESSION['customer_firstname'] = $row['customer_firstname'];
                $_SESSION['customer_lastname'] = $row['customer_lastname'];
                $_SESSION['customer_id'] = $row['customer_id'];
                $_SESSION['customer_address'] = $row['customer_address'];
               header("Location: index.php");
               exit();
            }else{
                header("Location: customerlogin.php?error=Incorrect Username or password");
                exit();
            }
        }else{
            header("Location: customerlogin.php?error=Incorrect username or password");
            exit();

        }
    }
}else{
    header("Location: customerlogin.php");
    exit();
}
?>