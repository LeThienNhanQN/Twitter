<?php
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
	include_once('../bl/init.php');
	include_once('../dao/init.php');

	$userId = $_SESSION['user_id'];

	if(isset($_POST['retweet']) && !empty($_POST['retweet'])){
		$tweetId = filter_input(INPUT_POST, 'retweet');
		$comment = filter_input(INPUT_POST, 'comment');
		$userFor = filter_input(INPUT_POST, 'user_id');

		$retweet->setRetweetStatus($comment);
		$retweet->setUserRetweet($userId);
		$retweet->setTweetId($tweetId);

		$tweet = $tweetDAO->findByTweetId($tweetId);
		$tweetDAO->updateRetweetCount($tweet);
		$retweetDAO->save($retweet);
	
		if($userFor != $userId){
			$notificationDAO->saveNotification($userFor, $userId, $tweetId, 'retweet');
		}
		
	}

    if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){       
        $tweetId = filter_input(INPUT_POST, 'showPopup');
        $getId = filter_input(INPUT_POST, 'user_id');
        $tweet = $tweetDAO->findByTweetId($tweetId);
        $user = $userDAO->findById($tweet->getUserId());
?> 
<div class="retweet-popup">
<div class="wrap5">
	<div class="retweet-popup-body-wrap">
		<div class="retweet-popup-heading">
			<h3>Retweet this to followers?</h3>
			<span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
		</div>
		<div class="retweet-popup-input">
			<div class="retweet-popup-input-inner">
				<input class="retweetMsg" type="text" placeholder="Add a comment.."/>
			</div>
		</div>
		<div class="retweet-popup-inner-body"> 
			<div class="retweet-popup-inner-body-inner">
				<div class="retweet-popup-comment-wrap">
					 <div class="retweet-popup-comment-head">
					 	<img src="<?php echo BASE_URL.$user->getProfileImage();?>" alt="errpr"/>
					 </div>
					 <div class="retweet-popup-comment-right-wrap">
						 <div class="retweet-popup-comment-headline">
						 	<a><?php echo $user->getScreenname();?> 
                             </a><span>‏@<?php echo $user->getUsername();?> 
                             <?php echo $tweet->getCreateDate();?></span>
						 </div>
						 <div class="retweet-popup-comment-body">
						 	<?php echo $tweet->getStatus();?>  | <?php echo $tweet->getTweetImage();?>
						 </div>
					 </div>
				</div>
			</div>
		</div>
		<div class="retweet-popup-footer"> 
			<div class="retweet-popup-footer-right">
				<button class="retweet-it" 
                data-tweet="<?php echo $tweet->getId();?>" data-user="<?php echo $tweet->getUserId();?>" type="submit"><i class="fa fa-retweet" aria-hidden="true"></i>Retweet</button>
			</div>
		</div>
	</div>
</div>
</div><!-- Retweet PopUp ends-->
<?php
    }
?>