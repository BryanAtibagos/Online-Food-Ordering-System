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
        header("Location: loginadmin.php?error=Username is required");
        exit();
    }else if(empty($pass)){
        header("Location: loginadmin.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM admin_heavens WHERE admin_email = '$uname' AND admin_password = '$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) ===1 ){
            $row = mysqli_fetch_assoc($result);
            if ($row['admin_email'] === $uname && $row['admin_password'] === $pass){
                $_SESSION['admin_email'] = $row['admin_email'];
                $_SESSION['admin_firstname'] = $row['admin_firstname'];
                $_SESSION['admin_lastname'] = $row['admin_lastname'];
                $_SESSION['admin_id'] = $row['admin_id'];
               header("Location: admindashboard.php");
               exit();
            }else{
                header("Location: loginadmin.php?error=Incorrect Username or password");
                exit();
            }
        }else{
            header("Location: loginadmin.php?error=Incorrect username or password");
            exit();

        }
    }
}else{
    header("Location: loginadmin.php");
    exit();
}
?>