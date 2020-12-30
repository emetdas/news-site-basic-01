<?php
include "header.php";
include "config.php";
if ($_SESSION["user_role"] == '0') {
    header("location:post.php");
}
$get_id = mysqli_real_escape_string($con,$_GET['id']);
$delet = "DELETE FROM category WHERE category_id = {$get_id}";
if (mysqli_query($con,$delet)) {
    header("location:category.php");
}
else{
    echo "somthing worng";
}
mysqli_close($con);
?>