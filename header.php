<?php
include "config.php";
if (isset($_GET['cid'])) {
    $get_cat = $_GET['cid'];  
}
$sql = "SELECT * FROM category  WHERE post > 0";
$query = mysqli_query($con,$sql);
$page = basename($_SERVER['PHP_SELF']);
switch ($page) {
    case 'single.php':
        if (isset($_GET['id'])) {
            $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
            $title_query = mysqli_query($con,$sql_title) or die("Title Faild");
            $title_fatch = mysqli_fetch_assoc($title_query);
            $title = $title_fatch['title'];
        }
        else{
            $title = "Post Not Found";
        }
        break;
    case 'category.php':
        if (isset($_GET['cid'])) {
            $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
            $title_query = mysqli_query($con,$sql_title) or die("Title Faild");
            $title_fatch = mysqli_fetch_assoc($title_query);
            $title = $title_fatch['category_name'];
        }
        else{
            $title = "Post Not Found";
        }
        break;
    case 'author.php':
        if (isset($_GET['aid'])) {
            $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
            $title_query = mysqli_query($con,$sql_title) or die("Title Faild");
            $title_fatch = mysqli_fetch_assoc($title_query);
            $title = $title_fatch['first_name']." ".$title_fatch['last_name'];
        }
        else{
            $title = "Post Not Found";
        }
        break;
        case 'search.php':
            if (isset($_GET['search'])) {
                $title = $_GET['search'];
            }
            else{
                $title = "Search not Found";
            }
            break;
    default:
    $title = "Daily New Website";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                    if (mysqli_num_rows($query) > 0) {
                        $selected = "";
                        ?>
                <ul class='menu'>
                
                       <li><a href='index.php'>Home</a></li>
                       <?php
                        while ($row = mysqli_fetch_assoc($query)){ 
                            if (isset($_GET['cid'])) {
                                if ($row['category_id'] == $get_cat) {
                                    $selected = "active";
                                 }
                                 else{
                                    $selected = "";
                                }
                            }
                    ?>
                    
                    <li><a class='<?php echo $selected; ?>' href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a></li>
              <?php
              }
              ?>
                </ul>
                <?php
                    
                     }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
