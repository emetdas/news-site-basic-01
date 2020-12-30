<?php
include "header.php";
include "config.php";
if ($_SESSION["user_role"] == '0') {
    header("location:post.php");
}
$get_id = $_GET['id'];
$select = "DELETE FROM user WHERE user_id = {$get_id}";
if (mysqli_query($con,$select)) {
    header("location:users.php");
}
else{
    echo "somthing worng";
}
mysqli_close($con);
?>