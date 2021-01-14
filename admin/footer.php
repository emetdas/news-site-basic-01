<?php
include "config.php";
$logo_settings = "SELECT * FROM settings";
$querys = mysqli_query($con,$logo_settings);
$row_settings = mysqli_fetch_assoc($querys);
?>
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span><?php echo $row_settings['footerdesc'];?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
