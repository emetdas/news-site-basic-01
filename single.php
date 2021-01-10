<?php 
include 'header.php'; 
include 'config.php'; 
$get_id =$_GET['id'];
$select  = "SELECT post.post_id,post.title,post.description,post.category,post.post_date,post.author,post.post_img,category.category_name,user.username FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post.post_id = {$get_id}";
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
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                       ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row['title'];?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo $row['username'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date'];?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'];?>" alt="<?php echo $row['title'];?>"/>
                            <p class="description">
                            <?php echo $row['description'];?>
                            </p>
                        </div>
                        <?php
                            }}
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
