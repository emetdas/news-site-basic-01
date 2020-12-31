<?php
include "config.php";
if (isset($_POST['fileToUpload'])) {
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name']; 
    $file_size = $_FILES['fileToUpload']['size']; 
    $temp_name = $_FILES['fileToUpload']['tmp_name']; 
    $file_type = $_FILES['fileToUpload']['type']; 
    $file_ext = end(explode('.',$file_name)); 
    $exctions = array("jpeg","jpg","svg","png");
    if (in_array($file_ext,$exctions) === false) {
        $errors[] = "This exctions file is not alowed, Please Chose jpeg,jpg,svg,png exctions";
    }
    if ($file_size > 2097152) {
        $errors[] = "File size must be lesten 2MB or lower";
    }
    if (empty ($errors) == true) {
        move_uploaded_file($temp_name,"upload/".$file_name);
    }
    else{
        die();
    }
}
session_start();
    $title = mysqli_real_escape_string($con,$_POST['post_title']);
    $descpection = mysqli_real_escape_string($con,$_POST['postdesc']);
    $category = mysqli_real_escape_string($con,$_POST['category']);
    $date = date("d M,Y");
    $author = $_SESSION["user_id"];
    $sql = "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('{$title}','{$descpection}','{$category}','{$date}','{$author}','{$file_name}');";
    $sql .="UPDATE category SET post = post + 1 WHERE category_id = {$category}";
    if (mysqli_multi_query($con,$sql)) {
        header("location:post.php");
    }
    else{
        echo "<div class='alert alert-danger'>Query Faild</div>";
    }?>