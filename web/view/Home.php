<?php

	include_once('../../model/dao/util/connection.php');
	include_once('../../mapper/mapper.php');
	include_once('../../model/bl/init.php');
	include_once('../../model/dao/init.php');
	include_once('../../model/service/init.php');
	
	if(isset($_SESSION['user_id'])){
		$userId = $_SESSION['user_id'];
		$user = $userDAO->findById($userId);
		
		$tweets = $tweetDAO->tweet($userId, 3);
	}else{
		header('Location: index.php');
	}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL ?>apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL ?>favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>favicon-16x16.png">
	<link rel="manifest" href="<?php echo BASE_URL ?>site.webmanifest">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/Font-Awesome-4.6.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/style-complete.css"/>
	<link rel="stylesheet" href="<?php echo BASE_URL ?>public/template/admin/css/dropzone.min.css" />
   	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	   
</head>
<body>
<div class="wrapper">
<!-- header wrapper -->

	<?php include_once('../include/header.php') ?>

<!-- header wrapper end -->
<script type="text/javascript" src="<?php echo BASE_URL ?>public/js/search.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ?>public/js/hashtag.js"></script>


<!---Inner wrapper-->
<div class="inner-wrapper">
<div class="in-wrapper">
	<div class="in-full-wrap">
		<div class="in-left">
			<div class="in-left-wrap">
				<?php include_once('../include/infor.php') ?>
	<!--==TRENDS==-->
 	  <?php include_once('../include/trend.php'); ?>
 	<!--==TRENDS==-->

			</div><!-- in left wrap-->
		</div><!-- in left end-->

		<div class="in-center">
			<div class="in-center-wrap">
				<?php include_once('../include/tweet.php') ?>


				<!--Tweet SHOW WRAPPER-->
				 <div class="tweets">
					<?php include_once('../include/newfeed.php'); ?>
 				 </div>
 				<!--TWEETS SHOW WRAPPER-->

				 <div class="loading-div">
					<img id="loader" src="<?php echo BASE_URL ?>public/images/loading.svg"/>
				</div>	

				<!-- root -->
				<div class="popupTweet"></div>
				
				<!--Tweet END WRAPER-->
				<script src="<?php echo BASE_URL ?>public/js/popuptweet.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/like.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/retweet.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/delete.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/popupform.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/scroll.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/follow.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/message.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/sendmessage.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/notification.js"></script>
				<script src="<?php echo BASE_URL ?>public/js/LikeRetweet.js"></script>
				
    			</div><!-- in left wrap-->
		</div><!-- in center end -->

		<div class="in-right">
			<div class="in-right-wrap">

		 	<!--Who To Follow-->
			 <div class="follow-wrap">
			 	<div class="follow-inner">
					<div class="follow-title">
						<h3>Who to follow?</h3>
					</div>
					<?php
						if(!empty($userDAO->findByUserSenderAndRandom($_SESSION['user_id']))):
						$users = $userDAO->findByUserSenderAndRandom($_SESSION['user_id']);
						foreach($users as $user):
					?>
					<div class="follow-body">
						<div class="follow-img">
							<img src="<?php echo BASE_URL.$user->getProfileImage() ?>"/>
						</div>
						<div class="follow-content">
							<div class="fo-co-head">
								<a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>">
									<?php echo $user->getScreenName(); ?>
								</a>
								<span>@<?php echo $user->getUsername(); ?></span>
							</div>
							<!-- FOLLOW BUTTON -->
							<?php echo $followService->getFollowBtn($user->getId(), $_SESSION['user_id']); ?>
						</div>
					</div>
					<?php
						endforeach;
						endif;
					?>
				</div>
			</div>
            <!--Who To Follow-->

 			</div><!-- in left wrap-->

		</div><!-- in right end -->					
	</div><!--in full wrap end-->
 </div><!-- in wrappper ends-->
</div><!-- inner wrapper ends-->
</div><!-- ends wrapper -->
	<!-- page specific plugin scripts -->

	<!-- inline scripts related to this page -->


</body>
</html>