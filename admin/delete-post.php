<?php
include "config.php";
$get_id = $_GET['id'];
$cat_id = $_GET['catid'];
$delet1 = "SELECT * FROM post WHERE post_id = {$get_id}";
$sql = mysqli_query($con,$delet1) or die("Result not Found");
$row = mysqli_fetch_assoc($con,$sql);
unlink("upload/".$row['post_img']);
$delet = "DELETE FROM post WHERE post_id = {$get_id};";
$delet .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";
if(mysqli_multi_query($con,$delet)){
    header("location:post.php");
}
else{
echo "psot not delete";
}
?>