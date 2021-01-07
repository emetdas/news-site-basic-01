<?php
include "config.php";
$get_id = $_GET['id'];
$cat_id = $_GET['catid'];
$delet = "DELETE FROM post WHERE post_id = {$get_id};";
$delet .= "UPDATE category SET post = post - 1 WHERE category_id = {$cat_id}";
if(mysqli_multi_query($con,$delet)){
    header("location:post.php");
}
else{
echo "psot not delete";
}
?>