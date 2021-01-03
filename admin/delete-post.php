<?php
include "header.php";
include "config.php";
$get_id = $_GET['id'];
$delet = "DELETE FROM post WHERE post_id = {$get_id}";
if (mysqli_query($con,$delet)) {
    header("location:post.php");
}
else{
echo "data not delete";
}
?>