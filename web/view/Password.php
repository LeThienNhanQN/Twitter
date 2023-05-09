<?php
    include_once('../../model/dao/util/connection.php');
    include_once('../../mapper/mapper.php');
	include_once('../../model/bl/init.php');
	include_once('../../model/dao/init.php');
    include_once('../../model/service/init.php');

    if($userService->loggedIn() === false){
        header('Location: index.php');
    }else{
        $userId = $_SESSION['user_id'];
		$user = $userDAO->findById($userId);    
		if(isset($_POST['submit'])){
			$currentPassword = filter_input(INPUT_POST, 'currentPwd');
			$newPassword = filter_input(INPUT_POST, 'newPassword');
			$rePassword = filter_input(INPUT_POST, 'rePassword');

			$error = array();
			if(!empty($currentPassword) && !empty($newPassword) && !empty($rePassword)){
				if($userDAO->checkPassword($currentPassword)){
					if(strlen($newPassword) < 6){
						$error['newPassword'] = "mật khẩu phải dài hơn 6 kí tự";
					}else if($newPassword != $rePassword){
						$error['rePassword'] = "mật khẩu không trùng nhau";
					}else{
						$params = [
							'password' => $newPassword
						];
						$userDAO->update('users', $userId, $params);
						header('Location: '.BASE_URL.'settings/account');
					}
				}else{
					$error['currentPwd'] = "mật khẩu không đúng";
				}
			}else{
				$error['field'] = "Nhập đầy đủ các trường";
			}
		}
    }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user->getUsername(); ?></title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL ?>apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL ?>favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>favicon-16x16.png">
	<link rel="manifest" href="<?php echo BASE_URL ?>site.webmanifest">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/Font-Awesome-4.6.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/style-complete.css"/>
    <script src="https://code.jquery.com/jquery-3.1.1.js" 
    integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">
<!-- header wrapper -->
	<?php include_once('../include/header.php') ?>
<!-- header wrapper end -->
<div class="container-wrap">
	<div class="lefter">
		<div class="inner-lefter">
			<div class="acc-info-wrap">
				<div class="acc-info-bg">
					<img src="<?php echo BASE_URL.$user->getProfileCover();?>"/>
				</div>
				<div class="acc-info-img">
					<img src="<?php echo BASE_URL.$user->getProfileImage();?>"/>
				</div>
				<div class="acc-info-name">
					<h3><?php echo $user->getScreenName();?></h3>
					<span><a href="#">@<?php echo $user->getUsername();?></a></span>
				</div>
			</div>
			<!--Acc info wrap end-->
			<div class="option-box">
				<ul>
					<li>
						<a href="<?php echo BASE_URL;?>settings/account" class="bold">
						<div>	
							Account
							<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
						</div>
						</a>
					</li>
					<li>
						<a href="<?php echo BASE_URL; ?>settings/password">
						<div>
							Password
							<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
						</div>
						</a>
					</li>
				</ul>
			</div>

		</div>
	</div><!--LEFTER ENDS-->
	
	<div class="righter">
		<div class="inner-righter">
			<div class="acc">
				<div class="acc-heading">
					<h2>Mật khẩu</h2>
					<h3>Thay đổi mật khẩu hiện tại của bạn</h3>
				</div>
				<form method="POST">
				<div class="acc-content">
					<div class="acc-wrap">
						<div class="acc-left">
							Mật khẩu cũ
						</div>
						<div class="acc-right">
							<input type="password" name="currentPwd"/>
							<span>
								<?php 
									if(isset($error['currentPwd'])){
										echo $error['currentPwd'];
									}
								?>
							</span>
						</div>
					</div>

					<div class="acc-wrap">
						<div class="acc-left">
							Mật khẩu mới
						</div>
						<div class="acc-right">
							<input type="password" name="newPassword" />
							<span>
								<?php 
									if(isset($error['newPassword'])){
										echo $error['newPassword'];
									}
								?>
							</span>
						</div>
					</div>

					<div class="acc-wrap">
						<div class="acc-left">
							Nhập lại 
						</div>
						<div class="acc-right">
							<input type="password" name="rePassword"/>
							<span>
								<?php 
									if(isset($error['rePassword'])){
										echo $error['rePassword'];
									}
								?>
							</span>
						</div>
					</div>
					<div class="acc-wrap">
						<div class="acc-left">
						</div>
						<div class="acc-right">
							<input type="Submit" name="submit" value="Save changes"/>
						</div>
						<div class="settings-error">
							<?php
								 if(isset($error['fields'])){
									 echo $error['fields'];
								}
							?>
  						</div>	
					</div>
				 </form>
				</div>
			</div>
			<div class="content-setting">
				<div class="content-heading">
					
				</div>
				<div class="content-content">
					<div class="content-left">
						
					</div>
					<div class="content-right">
						
					</div>
				</div>
			</div>
		</div>	
	</div>
	<!--RIGHTER ENDS-->
</div>
<!--CONTAINER_WRAP ENDS-->
</div>
<!-- ends wrapper -->
<div class="popupTweet"></div>
		<script src="<?php echo BASE_URL ?>public/js/popuptweet.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/like.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/retweet.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/delete.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/popupform.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/scroll.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/follow.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/message.js"></script>
		<script src="<?php echo BASE_URL ?>public/js/sendmessage.js"></script>

</body>
</html>