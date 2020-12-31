<?php
include "config.php";
if (isset($_POST['fileToUpload'])) {
    $title = mysqli_real_escape_string($con,$_POST['post_title']);
    $descpection = mysqli_real_escape_string($con,$_POST['postdesc']);
    $category = mysqli_real_escape_string($con,$_POST['category']);
    $date = date("d M,Y");
    $fileToUpload = mysqli_real_escape_string($con,($_POST['fileToUpload']));
    $sql = "SELECT * FROM";
    $query = mysqli_query($con,$sql);
   if (mysqli_num_rows($query) > 0 ) {
       echo "<p style='color:red;text-align:center;margin:0;padding:2rem 0;'>UserName already exists</p>";
   }
   else{
       $insert ="INSERT INTO user (first_name,last_name,username,password,role) VALUES('{$first_name}','{$last_name}','{$user_name}','{$user_password}','{$role}')";
       if (mysqli_query($con,$insert)) {
          header("location:users.php");
       }
   }
}
?>