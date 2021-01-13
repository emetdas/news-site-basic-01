<?php 
include 'header.php'; 
include "config.php";
if (isset($_GET['cid'])) {
    $get_cid = $_GET['cid'];
}
$limit = 3;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
else{
    $page = 1;
    
}
$offset = ($page - 1) * $limit;
$select  = "SELECT post.post_id,post.title,post.description,post.category,post.post_date,post.author,post.post_img,category.category_name,user.username FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id
WHERE post.category = {$get_cid}
 ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
// $select = "SELECT * FROM post";
$query = mysqli_query($con,$select);
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                $user = "SELECT * FROM category WHERE category_id = {$get_cid}";
                $query1 = mysqli_query($con,$user) or die("query unsussfully");
                $row1 = mysqli_fetch_assoc($query1);
                ?>
                  <h2 class="page-heading"><?php echo $row1['category_name']; ?></h2>
                  <?php
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                       ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="<?php echo $row['title'];?>"/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'];?>'><?php echo $row['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author'];?>'><?php echo $row['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,130)."...."?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }
                            else{
                                echo "Post not Found";
                            }
                            ?>
                          <?php
                $user_table = "SELECT post FROM category WHERE category_id = {$get_cid}";
                $query1 = mysqli_query($con,$user_table) or die("query unsussfully");
                $rows = mysqli_fetch_assoc($query1);
                if (mysqli_num_rows($query1) > 0) {
                    $total_recourds = $rows['post'];
                    $total_pages = ceil($total_recourds / $limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo '<li><a href="category.php?cid='.$get_cid.'&page='.($page - 1).'">Prev</li>';
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                            $active = "active";
                        }
                        else{
                            $active = ""; 
                        }
                        echo "<li class='{$active}'><a href='category.php?cid=".$get_cid."&page=".$i."'>".$i."</a></li>";
                    }
                    if ($total_pages > $page) {
                        echo '<li><a href="category.php?cid='.$get_cid.'&page='.($page + 1).'">Next</a></li>';
                    }
                    echo "</ul>";
                }
                ?>
                </div>
                  <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>