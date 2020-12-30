<?php
include "config.php";
session_start();
if (isset($_SESSION["username"])) {
    header("location:post.php");
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/news.jpg">
                    <h3 class="heading">Admin</h3>
                    <!-- Form Start -->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="" required>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary" value="login" />
                    </form>
                    <!-- /Form  End -->
                    <?php
                    include "config.php";
                    if (isset($_POST['login'])) {
                       $username = mysqli_real_escape_string($con,$_POST['username']); 
                       $password = md5($_POST['password']);
                       $select = "SELECT user_id,username,role FROM user WHERE username = '{$username}' AND password = '{$password}'";
                       $query = mysqli_query($con,$select) or die("query faild");
                       if (mysqli_num_rows($query)>0) {
                           while ($row = mysqli_fetch_assoc($query)) {
                            session_start();
                            $_SESSION["username"] = $row['username'];
                            $_SESSION["user_id"] = $row['user_id'];
                            $_SESSION["user_role"] = $row['role'];
                            header("location:post.php");
                           }
                       }
                       else{
                           echo '<div class="alert alert-danger">UserName and Password not Matched</div>';
                       }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>