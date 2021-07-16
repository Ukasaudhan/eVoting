<?php
session_start();
include('connect.php');

$votes = $_POST['pvotes'];
$total_votes = $votes+1;
$pid = $_POST['pid'];
$uid = $_SESSION['userdata']['id'];

$update_votes= mysqli_query($connect, "UPDATE user SET votes='$total_votes' WHERE id='$pid'");
$update_user_status = mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid'");
if($update_votes and $update_user_status){
    $partys = mysqli_query($connect, "SELECT *FROM user WHERE role=2");
    $partysdata = mysqli_fetch_all($partys, MYSQLI_ASSOC);


    $_SESSION['userdata']['status']= 1;
    $_SESSION['partysdata'] = $partysdata;
    echo '
    <script>
        alert("!! Voting Successfull !!");
        window.location = "../Routes/dashboard.php";
    </script>
';


}
else{
    echo '
    <script>
        alert("Some Error Occured!");
        window.location = "../Routes/dashboard.php";
    </script>
';

}
?>
