<?php
    include_once('../model/dao/util/connection.php');
    include_once('../model/bl/init.php');
    include_once('../model/dao/init.php');
    echo "Trang web không tồn tại";
    
?>
<br>
<?php 
if(isset($_SESSION['user_id'])):
?>
<a href="<?php echo BASE_URL.'my/home' ?>">quay về</a>

<?php
    elseif(!isset($_SESSION['user_id'])):
?>
<a href="<?php echo BASE_URL.'index.php' ?>">quay về</a>
<?php 
    endif;
?>

