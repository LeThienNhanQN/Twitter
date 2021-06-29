<?php
    include_once('../../model/dao/util/connection.php');
    include_once('../../mapper/mapper.php');
	include_once('../../model/bl/init.php');
	include_once('../../model/dao/init.php');
    include_once('../../model/service/init.php');
    if(isset($_SESSION['user_id']) && isset($_GET['username'])){
        $userId = $_SESSION['user_id'];
        $username = $_GET['username'];
        $guestUser = $userDAO->findUserByUsername($username);
        $user = $userDAO->findById($userId);
		$count = $tweetDAO->countTweetByUserId($guestUser->getId());
		$countLike = $tweetDAO->countLikeByUserId($guestUser->getId());
		if(!empty($tweetDAO->findByUserId($guestUser->getId(), 10))){
			$tweets = $tweetDAO->findByUserId($guestUser->getId(), 10);
		}
		
    }else{
        echo "access is denied";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $user->getScreenName() . "/Following" ?></title>
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
><!-- header wrapper end -->
	<!--Profile cover-->
	<?php include_once('../include/profile_wrap.php') ?>
	<!--Profile Cover End-->

<!---Inner wrapper-->
<div class="in-wrapper">
 <div class="in-full-wrap">
   <div class="in-left">
     <div class="in-left-wrap">
	<!--PROFILE INFO WRAPPER END-->
	<div class="profile-info-wrap">
	 <div class="profile-info-inner">
	 <!-- PROFILE-IMAGE -->
		<div class="profile-img">
			<img src="<?php echo BASE_URL.$guestUser->getProfileImage(); ?>"/>
		</div>

		<div class="profile-name-wrap">
			<div class="profile-name">
				<a href="<?php echo $guestUser->getUsername(); ?>"><?php echo $guestUser->getScreenName(); ?></a>
			</div>
			<div class="profile-tname">
				@<span class="username"><?php echo $guestUser->getUsername(); ?></span>
			</div>
		</div>

		<div class="profile-bio-wrap">
		 <div class="profile-bio-inner">
		    <?php echo $guestUser->getBio(); ?>
		 </div>
		</div>

<div class="profile-extra-info">
	<div class="profile-extra-inner">
		<ul>
      <?php if(!empty($guestUser->getCountry())){ ?>
			<li>
				<div class="profile-ex-location-i">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
				</div>
				<div class="profile-ex-location">
					<?php echo $guestUser->getCountry(); ?>
				</div>
			</li>
    <?php } ?>

    <?php if(!empty($guestUser->getWebsite())): ?>
			<li>
				<div class="profile-ex-location-i">
					<i class="fa fa-link" aria-hidden="true"></i>
				</div>
				<div class="profile-ex-location">
					<a href="<?php echo $guestUser->getWebsite(); ?>" target="_blank"><?php echo $guestUser->getWebsite(); ?></a>
				</div>
			</li>
	<?php endif; ?>

			<li>
				<div class="profile-ex-location-i">
					<!-- <i class="fa fa-calendar-o" aria-hidden="true"></i> -->
				</div>
				<div class="profile-ex-location">
 				</div>
			</li>
			<li>
				<div class="profile-ex-location-i">
					<!-- <i class="fa fa-tint" aria-hidden="true"></i> -->
				</div>
				<div class="profile-ex-location">
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="profile-extra-footer">
	<div class="profile-extra-footer-head">
		<div class="profile-extra-info">
			<ul>
				<li>
					<div class="profile-ex-location-i">
						<i class="fa fa-camera" aria-hidden="true"></i>
					</div>
					<div class="profile-ex-location">
						<a href="#">0 Photos and videos </a>
					</div>
				</li>
				<br>
				<?php if($guestUser->getId() == $_SESSION['user_id']): ?>
				<li>
					<div class="profile-ex-location-i">
						<i class="fa fa-camera" aria-hidden="true"></i>
					</div>
					<div class="profile-ex-location">
						<a href="editProfile.php">chỉnh sửa trang cá nhân </a>
					</div>
				</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
	<div class="profile-extra-footer-body">
		<ul>
			 <!-- <li><img src="#"/></li> -->
		</ul>
	</div>
</div>

	 </div>
	<!--PROFILE INFO INNER END-->

	</div>
	<!--PROFILE INFO WRAPPER END-->

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
		</div>
		<script src="<?php echo BASE_URL ?>public/js/follow.js"></script>
		<!-- in left wrap-->
	</div>
	<!-- in left end-->
		<!--FOLLOWING OR FOLLOWER FULL WRAPPER-->
		<div class="wrapper-following">
			<div class="wrap-follow-inner">
				<?php
					if(!empty($followDAO->findbyUserSender($guestUser->getId()))):
						$follower = $followDAO->findbyUserSender($guestUser->getId());
						foreach($follower as $list):
							$user = $userDAO->findById($list->getUserReceive());
				?>
				<div class="follow-unfollow-box">
					<div class="follow-unfollow-inner">
						<div class="follow-background">
							<img src="<?php echo BASE_URL.$user->getProfileCover(); ?>"/>
						</div>
						<div class="follow-person-button-img">
							<div class="follow-person-img"> 
								<img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/>
							</div>
							<div class="follow-person-button">
								<?php echo $followService->getFollowBtn($user->getId(), $userId); ?>
							</div>
						</div>
						<div class="follow-person-bio">
							<div class="follow-person-name">
								<a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>">
									<?php echo $user->getScreenName(); ?>
								</a>
							</div>
							<div class="follow-person-tname">
								<a href="<?php echo BASE_URL.$user->getUsername(); ?>">
									@<?php echo $user->getUsername(); ?>
								</a>
							</div>
							<div class="follow-person-dis">
								<?php echo $userService->getTweetLink($user->getBio()) ?>
							</div>
						</div>
					</div>
				</div>
				<?php
					endforeach;
					endif;
				?>
			</div><!-- wrap follo inner end-->
		</div><!--FOLLOWING OR FOLLOWER FULL WRAPPER END-->

	</div><!--in full wrap end-->
</div>
<!-- in wrappper ends-->

</div><!-- ends wrapper -->
</body>
</html>