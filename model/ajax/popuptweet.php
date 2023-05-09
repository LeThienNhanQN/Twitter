<?php 
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../dao/init.php');
	include_once('../bl/init.php');
	include_once('../service/init.php');

    if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
        $tweetId = filter_input(INPUT_POST, 'showPopup');
        $userId = $_SESSION['user_id'];

        $tweet = $tweetDAO->findById($tweetId);
		$user = $userDAO->findById($tweet->getUserId());
		$comments = $commentDAO->findByTweetId($tweetId);

?>
<div class="tweet-show-popup-wrap">
<input type="checkbox" id="tweet-show-popup-wrap">
<div class="wrap4">
	<label for="tweet-show-popup-wrap">
		<div class="tweet-show-popup-box-cut">
			<i class="fa fa-times" aria-hidden="true"></i>
		</div>
	</label>
	<div class="tweet-show-popup-box">
	<div class="tweet-show-popup-inner">
		<div class="tweet-show-popup-head">
			<div class="tweet-show-popup-head-left">
				<div class="tweet-show-popup-img">
					<img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/>
				</div>
				<div class="tweet-show-popup-name">
					<div class="t-s-p-n">
						<a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>">
							<?php echo $user->getScreenName(); ?>
						</a>
					</div>
					<div class="t-s-p-n-b">
						<a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>">
							@<?php echo $user->getUsername(); ?>
						</a>
					</div>
				</div>
			</div>
			<div class="tweet-show-popup-head-right">
				<?php echo $followService->getFollowBtn($user->getId(), $_SESSION['user_id']); ?>
			</div>
		</div>
		<div class="tweet-show-popup-tweet-wrap">
			<div class="tweet-show-popup-tweet">
				<?php echo $tweetService->getTweetLink($tweet->getStatus()); ?>
			</div>
			<?php if(!empty($tweet->getTweetImage())): ?>
			<div class="tweet-show-popup-tweet-ifram">
  			    <img src="<?php echo BASE_URL.$tweet->getTweetImage(); ?>"/> 
			</div>
			<?php endif; ?>
		</div>
		<div class="tweet-show-popup-footer-wrap">
			<div class="tweet-show-popup-retweet-like">
				<div class="tweet-show-popup-retweet-left">
					<div class="tweet-retweet-count-wrap">
						<div class="tweet-retweet-count-head">
							RETWEET
						</div>
						<div class="tweet-retweet-count-body">
							<?php echo $tweet->getRetweetCount(); ?>
						</div>
					</div>
					<div class="tweet-like-count-wrap">
						<div class="tweet-like-count-head">
							LIKES
						</div>
						<div class="tweet-like-count-body">
							<?php echo $tweet->getLikeCount(); ?>
						</div>
					</div>
				</div>
				<div class="tweet-show-popup-retweet-right">
				 
				</div>
			</div>
			<div class="tweet-show-popup-time">
				<span><?php echo $tweetService->timeAgo($tweet->getCreateDate()) ?></span>
			</div>
			<div class="tweet-show-popup-footer-menu">
				<ul>
					<li>
						<button type="buttton"><i class="fa fa-share" aria-hidden="true"></i>
						</button>
					</li>
					<li>
						<button type="button">
							<i class="fa fa-retweet" aria-hidden="true"></i>
							<span class="retweetsCount"></span>
						</button>
					</li>
					<li>
						<button type="button">
							<i class="fa fa-heart" aria-hidden="true"></i>
							<span class="likesCount"></span>
						</button>					
					</li>
					<li>
					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						<ul> 
							<li><label class="deleteTweet" >Delete Tweet</label></li>
						</ul>	
					</li>
				</ul>
			</div>
		</div>
	</div><!--tweet-show-popup-inner end-->
 	<div class="tweet-show-popup-footer-input-wrap">
		<div class="tweet-show-popup-footer-input-inner">
			<div class="tweet-show-popup-footer-input-left">
				<img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/>
			</div>
			<div class="tweet-show-popup-footer-input-right">
				<input id="commentField" type="text" name="comment"  
				placeholder="Reply to @<?php echo $user->getUsername(); ?>"
				data-tweet="<?php echo $tweetId ?>" data-user="<?php echo $_SESSION['user_id'] ?>">
			</div>
		</div>
		<div class="tweet-footer">
		 	<div class="t-fo-left">
		 		<ul>
		 			<li>
		 				<label for="t-show-file"><i class="fa fa-camera" aria-hidden="true"></i></label>
		 				<input type="file" id="t-show-file">
		 			</li>
		 			<li class="error-li">
				    </li> 
		 		</ul>
		 	</div>
		 	<div class="t-fo-right">
				<span id="sp">145</span>
 		 		<input type="submit" id="postComment">
				<script src="<?php echo BASE_URL ?>public/js/comment.js"></script>
		 	</div>
		 </div>
	</div><!--tweet-show-popup-footer-input-wrap end-->

<div class="tweet-show-popup-comment-wrap">
	<div id="comment">
	 	<!--COMMENTS--> 
		 <?php 
			 if(!empty($comments)):
				foreach($comments as $comment):
		 ?>
			<div class="tweet-show-popup-comment-box">
				<div class="tweet-show-popup-comment-inner">
					<div class="tweet-show-popup-comment-head">
						<div class="tweet-show-popup-comment-head-left">
							<div class="tweet-show-popup-comment-img">
								<img src="<?php echo BASE_URL.$comment->getUser()->getProfileImage(); ?>">
							</div>
						</div>
						<div class="tweet-show-popup-comment-head-right">
							<div class="tweet-show-popup-comment-name-box">
								<div class="tweet-show-popup-comment-name-box-name"> 
									<a href="<?php echo BASE_URL.$comment->getUser()->getUsername(); ?>">
									<?php echo $comment->getUser()->getScreenName(); ?></a>
								</div>
								<div class="tweet-show-popup-comment-name-box-tname">
									<a href="<?php echo BASE_URL.$comment->getUser()->getUsername(); ?>">
									@<?php echo $comment->getUser()->getUsername().' - '.
										$tweetService->timeAgo($comment->getCreateDate());
									?>
									</a>
								</div>
							</div>
							<div class="tweet-show-popup-comment-right-tweet">
								<p>
								<a href="<?php echo BASE_URL.$comment->getUser()->getUsername(); ?>">
								@<?php echo $user->getUsername(); ?>
								</a>
								<!-- get link -->
								 <?php echo $commentService->getCommentLink($comment->getStatus()); ?>
								 </p>
							</div>
							<div class="tweet-show-popup-footer-menu">
								<ul>
									<li><button><i class="fa fa-share" aria-hidden="true"></i></button></li>
									<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
									<?php 
										if($comment->getUser()->getId() == $userId):
									?>
									<li>
										<a class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
										<ul> 
											<li>
												<label class="deleteComment" 
													data-tweet="<?php echo $tweet->getId(); ?>" 
													data-id="<?php echo $comment->getId(); ?>">
													Delete comment
												</label>
											</li>
										</ul>
									</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!--TWEET SHOW POPUP COMMENT inner END-->	
			</div>
		 <?php 
		 	endforeach;
			endif;
		 ?>
	</div>

</div>
<!--tweet-show-popup-box ends-->
</div>
</div>
<script>
	
	var input = document.getElementById("commentField");
    
	input.addEventListener("keyup", function(event){
    if(event.keyCode === 13){
        event.preventDefault();
		document.getElementById("postComment").click();
    }
}); 
</script>

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

<?php
    }
?>