<?php
session_start();
include("connect.php");
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

$check = mysqli_query($connect, "SELECT *FROM user WHERE mobile ='$mobile' AND password ='$password' AND role='$role'");

if(mysqli_num_rows($check)>0){
    $userdata = mysqli_fetch_array($check);
    $partys = mysqli_query($connect, "SELECT *FROM user WHERE role=2");
    $partysdata = mysqli_fetch_all($partys, MYSQLI_ASSOC);

    $_SESSION['userdata']= $userdata;
    $_SESSION['partysdata'] = $partysdata;
      
    echo '
    <script>
        window.location = "../Routes/dashboard.php";
    </script>
';
}
else{
    echo '
    <script>
        alert("Invalid Credentials or User not Found!");
        window.location = "../";
    </script>
';

}
?>