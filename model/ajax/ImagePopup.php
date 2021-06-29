<?php 
     include_once('../dao/util/connection.php');
     include_once('../../mapper/mapper.php');
     include_once('../dao/init.php');
     include_once('../bl/init.php');
     include_once('../service/init.php');

     if(isset($_POST['showImageByTweetId']) && !empty($_POST['showImageByTweetId'])){
         $tweetId = filter_input(INPUT_POST, 'showImageByTweetId');
         $userId = $_SESSION['user_id'];

         $tweet = $tweetDAO->findById($tweetId);
		 $user = $userDAO->findById($userId);
     }
?>

<div class="img-popup">
<div class="wrap6">
<span class="colose">
	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
</span>
<div class="img-popup-wrap">
	<div class="img-popup-body">
		<img src="<?php echo BASE_URL.$tweet->getTweetImage(); ?>"/>
	</div>
	<div class="img-popup-footer">
		<div class="img-popup-tweet-wrap">
			<div class="img-popup-tweet-wrap-inner">
				<div class="img-popup-tweet-left">
					<img src="<?php echo BASE_URL.$user->getProfileImage() ?>"/>
				</div>
				<div class="img-popup-tweet-right">
					<div class="img-popup-tweet-right-headline">
                        <a href=" <?php echo $user->getUsername(); ?>">
                        <?php echo $user->getScreenName(); ?>
                        </a>
                        <span>
                            @<?php echo $user->getUsername().' - '.$tweetService->timeAgo($tweet->getCreateDate()); ?>
                        </span>
					</div>
					<div class="img-popup-tweet-right-body">
						<?php echo $tweet->getStatus(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="img-popup-tweet-menu">
			<div class="img-popup-tweet-menu-inner">
			  	<ul> 
					<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>	
					<li><button class="retweet"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span></button></li>
					<li><button class="like-btn"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter"></span></button></li>
					
					<li><label for="img-popup-menu"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></label>
					<input id="img-popup-menu" type="checkbox"/>
					<div class="img-popup-footer-menu">
						<ul>
						  <li><label class="deleteTweet" >Delete Tweet</label></li>
						</ul>
					</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>
</div><!-- Image PopUp ends-->