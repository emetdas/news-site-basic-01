<?php 
include "header.php"; 
include "config.php";
if ($_SESSION["user_role"] == '0') {
    header("location:post.php");
}
$get_id = mysqli_real_escape_string($con,$_GET['id']);
$select = "SELECT * FROM category WHERE category_id = {$get_id}";
$query = mysqli_query($con,$select) or die("Data not selected");
if (isset($_POST['sumbit'])) {
    $category_name = mysqli_real_escape_string($con,$_POST['cat_name']);
    $update = "UPDATE category SET category_name ='{$category_name}' WHERE category_id = {$get_id}";
    if (mysqli_query($con,$update)) {
        header("location:category.php");
    }
    else{
        echo "Data not Update";
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                  <?php
                  if (mysqli_num_rows($query) > 0) {
                      while ($row = mysqli_fetch_assoc($query)) {
                         
                 ?>
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $get_id;?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'];?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                <?php      }
                  }
                  ?>
                    </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
