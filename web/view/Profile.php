<?php
    include_once('../../model/dao/util/connection.php');
	include_once('../../model/dao/init.php');
    include_once('../../mapper/mapper.php');
    include_once('../../model/bl/init.php');
    include_once('../../model/service/init.php');
    if(isset($_SESSION['user_id']) && isset($_GET['username'])){
        $userId = $_SESSION['user_id'];
        $username = $_GET['username'];
        $guestUser = $userDAO->findUserByUsername($username);
        $user = $userDAO->findById($userId);
		$count = $tweetDAO->countTweetByUserId($guestUser->getId());
		$countLike = $tweetDAO->countLikeByUserId($guestUser->getId());
		if(!empty($tweetDAO->findByUserId($guestUser->getId(), 5))){
			$tweets = $tweetDAO->findByUserId($guestUser->getId(), 5);
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
    <title><?php echo $user->getScreenName(); ?></title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL ?>apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL ?>favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>favicon-16x16.png">
	<link rel="manifest" href="<?php echo BASE_URL ?>site.webmanifest">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/Font-Awesome-4.6.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/style-complete.css"/>
   	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="wrapper">
<!-- header wrapper -->
	<?php include_once('../include/header.php') ?>
><!-- header wrapper end -->
	<?php include_once('../include/profile_wrap.php') ?>
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
						<a href="<?php echo BASE_URL ?>settings/profile">chỉnh sửa trang cá nhân </a>
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

	</div>
	<!-- in left wrap-->

  </div>
	<!-- in left end-->

<div class="in-center">
	<div class="in-center-wrap">
		<?php include_once('../include/profiletweet.php'); ?>
 	</div><!-- in left wrap-->
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
<!-- in center end -->

<div class="in-right">
	<div class="in-right-wrap">

		<!--==WHO TO FOLLOW==-->
			  <!-- HERE -->
		<!--==WHO TO FOLLOW==-->

		<!--==TRENDS==-->
	 	 	<!-- HERE -->
	 	<!--==TRENDS==-->

	</div><!-- in right wrap-->
</div>
<!-- in right end -->

		</div>
		<!--in full wrap end-->
	</div>
	<!-- in wrappper ends-->
 </div>
 <!-- ends wrapper -->
</body>
</html>