<?php 
    include_once('../../dao/util/connection.php');
    include_once('../../../mapper/mapper.php');
    include_once('../../dao/init.php');
	include_once('../../bl/init.php');
    include_once('../../service/init.php');

    if(isset($_POST['enable']) && !empty($_POST['enable'])){
        $userId = filter_input(INPUT_POST, 'enable');
        $userDAO->updateStatus($userId, 1);
    }

    if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])):
        $userId = filter_input(INPUT_POST, 'showPopup');
?>
<div class="user-popup">
  <div class="wrap5">
    <div class="user-popup-body-wrap">
      <div class="user-popup-heading">
        <h3>Bạn có muốn khôi phục tài khoản này?</h3>
        <span><button class="close-user-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
      </div>
      <div class="user-popup-footer"> 
        <div class="user-popup-footer-right">
          <button class="cancel-it f-btn">Thoát</button>
          <button class="enable-it" data-user="<?php echo $userId ?>" type="submit">
            Khôi phục
            </button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php   
    endif;
?>