<?php include "header.php"; 
include "config.php";
if ($_SESSION["user_role"] == '0') {
    header("location:post.php");
}
if (isset($_GET['category'])) {
    $page = $_GET['category'];
}
else{
    $page = 1;
}
$limit = 3;
$offset = ($page - 1) * $limit;
$select ="SELECT * FROM category LIMIT {$offset},{$limit}";
$query = mysqli_query($con,$select);
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query) > 0) {
                            while ($fetch = mysqli_fetch_assoc($query)) {
                               ?> 
                        <tr>
                            <td class='id'><?php echo $fetch['category_id'];?></td>
                            <td><?php echo $fetch['category_name'];?></td>
                            <td><?php echo $fetch['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $fetch['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $fetch['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                // Pagination-code
                $select1 = "SELECT * FROM category";
                $query1 = mysqli_query($con,$select1);
                if (mysqli_num_rows($query1) > 0) {
                    $total_recourds = mysqli_num_rows($query1);
                    $total_pages = ceil($total_recourds / $limit);
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo '<li><a href="category.php?category='.($page -1).'">Prev</a></li>';
                    }
                    for ($i=1; $i < $total_pages; $i++) { 
                        if ($i == $page) {
                            $active = "active";
                        }
                        else{
                            $active = "";
                        }
                      echo "<li class='{$active}'><a href='category.php?category={$i}'>{$i}</a></li>";
                    }
                    if ($total_pages > $page) {
                        echo '<li><a href="category.php?category='.($page + 1).'">Next</a></li>';
                    }
                    
                    echo "</ul>";
                }?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
