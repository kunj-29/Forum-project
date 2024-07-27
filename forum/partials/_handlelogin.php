<?php
include '_dbconnect.php';
 $showError = "false";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['loginEmail'];    
    $pass = $_POST['loginPass'];
         
    $sql = "select * from users where user_email = '$email'";
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);

    if($numRows==1){
                $row = mysqli_fetch_assoc($result);
                $hashed_password = $row['user_pass'];
                if($pass == $hashed_password){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['userEmail'] = $email;
                echo "logged in :". $email;
                header("location: /forum/index.php?loginsuccess=true");
                exit();
            }
            else{
                  echo " unable to login";
                } 
            }
            header("location: /forum/index.php?loginsuccess=true");
    }
            
            
?>