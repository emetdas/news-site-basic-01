<?php
include "header.php";
include "config.php";
if ($_SESSION["user_role"] == '0') {
    header("location:post.php");
}
$get_id = $_GET['id'];
$select = "SELECT * FROM user WHERE user_id = {$get_id}";
$result = mysqli_query($con, $select);
if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($con,$_POST['user_id']);
    $first_name = mysqli_real_escape_string($con,$_POST['f_name']);
    $last_name = mysqli_real_escape_string($con,$_POST['l_name']);
    $user_name = mysqli_real_escape_string($con,$_POST['username']);
    $role = mysqli_real_escape_string($con,$_POST['role']);
    $update = "UPDATE user SET first_name = '{$first_name}',last_name = '{$last_name}',username = '{$user_name}',role = '{$role}' WHERE user_id = '{$user_id}'";
    $query = mysqli_query($con,$update) or die("user not update");
    header("location:users.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                                    <?php
                                    if ($row['role'] == 1) {
                                        echo "<option value='1' selected>Admin</option>
                                        <option value='0'>normal User</option>";
                                    } else {
                                        echo "<option value='0'selected>normal User</option>
                                        <option value='1'>Admin</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                        <!-- /Form -->
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>