<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $userpass = $_POST['signuppassword'];
    $cpass = $_POST['signupcpassword'];

    // check whether user already exits!
    $exitsql = "SELECT * FROM `users1` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn,$exitsql);
    $numrow = mysqli_num_rows($result);
    if ($numrow>0) {
        // $_SESSION['Cred'] = true;
        // $showError = "UserAlreadyExits!";
        header("location: /PHP_CWH/forum_web/index.php?sucsign=false");
        exit();
    }
    else {
        if ($userpass == $cpass) {
            $hash_pass = password_hash($userpass,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users1` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash_pass', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                //  $showAlert = true;
                //  echo "success!";
                 header("location: /PHP_CWH/forum_web/index.php?sucsign=true");
                 exit();
            }else {
                // $_SESSION['Cred'] = true;
                header("location: /PHP_CWH/forum_web/index.php?sucsign=false");
                exit();
            }
        }
        else {
            // $_SESSION['Cred'] = true;
            // echo "p";
            // $showError = "PasswordDoesNotMatch!";
            header("location: /PHP_CWH/forum_web/index.php?sucsign=false");
            exit();
        }
    } 
}
?>