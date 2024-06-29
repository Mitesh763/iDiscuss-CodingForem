<?php
if($_SERVER['REQUEST_METHOD']== 'POST'){
    include '_dbconnect.php';
    $emaillog = $_POST['loginEmail'];
    $passlog = $_POST['loginpass'];

    $sql = "SELECT * FROM `users1` WHERE user_email = '$emaillog'";
    $result = mysqli_query($conn,$sql);
    $numrow = mysqli_num_rows($result);
    if ($numrow==1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($passlog,$row['user_pass'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['srno'] = $row['srno'];
            $_SESSION['useremail'] = $emaillog;
            // echo "login successfully!";
            header("location: /PHP_CWH/forum_web/index.php?successlogin=true");
            exit();
            // echo "login success";
        }else {
            $_SESSION['Cred'] = true;
            // $loginError =  "password not match";
            // echo $loginError;
            header("location: /PHP_CWH/forum_web/index.php?successlogin=false");
            // exit();
        }
    }else {
        $_SESSION['Cred'] = true;
        // $loginError =  "Invalid user!";
        // echo $loginError;
        header("location: /PHP_CWH/forum_web/index.php?successlogin=false");
        // exit();
    }
}

?>