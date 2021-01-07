<?php 
include "config.php";
if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
}
else{
    $errors = array();
    $file_name = $_FILES['new-image']['name']; 
    $file_size = $_FILES['new-image']['size']; 
    $temp_name = $_FILES['new-image']['tmp_name']; 
    $file_type = $_FILES['new-image']['type']; 
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
$sql = "UPDATE post SET title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category={$_POST["category"]},post_img='{$file_name}' WHERE post_id={$_POST["post_id"]}";
$query = mysqli_query($con,$sql);
if ($query) {
    header("location:post.php");
}
else{
    echo "Data not upadate";
}
?>