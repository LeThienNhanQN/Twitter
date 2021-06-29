<?php
	include_once('../../model/dao/util/connection.php');
	include_once('../../mapper/mapper.php');
	include_once('../../model/bl/init.php');
	include_once('../../model/dao/init.php');
    include_once('../../model/service/init.php');
    
	if(isset($_SESSION['user_id']) && isset($_GET['hashtag'])){
        $hashtag = filter_input(INPUT_GET, 'hashtag');
		$user = $userDAO->findById($_SESSION['user_id']);

		$tweets = $tweetDAO->findTweetByHashtag($hashtag);
	}else{
		header('Location: index.php');
	}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'hashtag/'.$hashtag ?></title>
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
    <script type="text/javascript" src="<?php echo BASE_URL ?>public/js/search.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL ?>public/js/hashtag.js"></script>


    <!--#hash-header-->
    <div class="hash-header">
        <div class="hash-inner">
            <h1>#<?php echo $hashtag ?></h1>
        </div>
    </div>	
    <!--#hash-header end-->

<!--hash-menu-->
<div class="hash-menu">
	<div class="hash-menu-inner">
		<ul>
 			<li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=live' ?>">Latest</a></li>
			<li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=user' ?>">Accounts</a></li>
			<li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=photo' ?>">Photos</a></li>
  		</ul>
	</div>
</div>
<!--hash-menu-->
<!---Inner wrapper-->

<div class="in-wrapper">
	<div class="in-full-wrap">
		
		<div class="in-left">
			<div class="in-left-wrap">

			   <!-- Who TO Follow -->
               <!--Who To Follow-->
			 <div class="follow-wrap">
			 	<div class="follow-inner">
					<div class="follow-title">
						<h3>Who is follow?</h3>
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

			   <!--TRENDS-->
               <?php include_once('../include/trend.php'); ?>
			   
			</div>
			<!-- in left wrap-->
		</div>
		<!-- in left end-->

<!-- TWEETS IMAGES  -->
<?php 
	if(strpos($_SERVER['REQUEST_URI'], '?f=photo')):
?>
<div class="hash-img-wrapper"> 
 	<div class="hash-img-inner"> 
		<?php 
			foreach($tweets as $tweet):
				if(!empty($tweet->getTweetImage())):
		?>
		 <div class="hash-img-flex">
		 	<img src="<?php echo BASE_URL.$tweet->getTweetImage() ?>"/>
		 	<div class="hash-img-flex-footer">
		 		<ul>
		 			<li><i class="fa fa-share" aria-hidden="true"></i></li>
		 			<li><i class="fa fa-retweet" aria-hidden="true"></i></li>
		 			<li><i class="fa fa-heart" aria-hidden="true"></i></li>
		 		</ul>
		 	</div>
		</div>
		<?php
			endif;
			endforeach;
		?>
	</div>
</div> 
<!-- TWEETS IMAGES -->
		
<!--TWEETS ACCOUTS-->
<?php 
	elseif(strpos($_SERVER['REQUEST_URI'], 'f=user')):
		$tweets = $tweetDAO->findUserByHashtag($hashtag);
		
?>
<div class="wrapper-following">
<div class="wrap-follow-inner">
	<?php 
		foreach($tweets as $tweet):
			$user = $userDAO->findById($tweet->getUserId());
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
					<?php echo $followService->getFollowBtn($user->getId(), $_SESSION['user_id']) ?>
				</div>
			</div>
			<div class="follow-person-bio">
				<div class="follow-person-name">
					<a href="<?php echo BASE_URL.$user->getUsername() ?>">
						<?php echo $user->getScreenName() ?>
					</a>
				</div>
				<div class="follow-person-tname">
					<a href="<?php echo BASE_URL.$user->getUsername() ?>">@<?php echo $user->getUsername() ?></a>
				</div>
				<div class="follow-person-dis">
					<?php echo $user->getBio() ?>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
</div>
<!-- TWEETS ACCOUNTS -->
<?php  
	
	else:
?>
		
	 <div class="in-center">
		<div class="in-center-wrap">
			<?php include_once('../include/newfeed.php') ?>
		</div>
	</div>
		<!--Tweet END WRAPER-->
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

	</div><!--in full wrap end-->
</div><!-- in wrappper ends-->

</div><!-- ends wrapper -->



</div>
	<?php endif; ?>
</body>
</html>
