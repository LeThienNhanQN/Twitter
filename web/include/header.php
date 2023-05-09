<?php

	$notify = $notificationDAO->getNotificationCountByUserId($userId);
?>

<div class="header-wrapper">

<div class="nav-container">
	<!-- Nav -->
	<div class="nav">

		<div class="nav-left">
			<ul>
				<li><a href="<?php echo BASE_URL.'my/home' ?>"><i class="fa fa-home" aria-hidden="true"></i>Trang chủ</a></li>
 				<li>
				 	<a href="<?php echo BASE_URL ?>i/notifications">
					 	<i class="fa fa-bell" aria-hidden="true"></i>
						Thông báo
						<span id="notification">
						<?php 
							if($notify['totalNotification'] > 0){
								echo '
									<span class="span-i">
										'.$notify['totalNotification'].'
									</span>
								';
							}
						?>
						</span>
					</a>
				</li>
				<li id="messagePopup">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					Tin nhắn
					<span id="messages">
						<?php 
							if($notify['totalMessage'] > 0){
								echo '
									<span class="span-i">
										'.$notify['totalMessage'].'
									</span>
								';
							}
						?>
						</span>
				</li>
 			</ul>
		</div><!-- nav left ends-->

		<div class="nav-right">
			<ul>
				<li>
					<input type="text" placeholder="tìm kiếm..." class= "search"/>
					<i class="fa fa-search" aria-hidden="true"></i>
					<div class="search-result">
					</div>
				</li>

				<li class="hover"><label class="drop-label" for="drop-wrap1">
                <img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>"><?php echo $user->getUsername(); ?></a></li>
							<li><a href="<?php echo BASE_URL ?>settings/account">Settings</a></li>
							<li><a href="../public/include/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label class="addTweetBtn">Tweet</label></li>
			</ul>
		</div><!-- nav right ends-->

	</div><!-- nav ends -->

</div><!-- nav container ends -->

</div>