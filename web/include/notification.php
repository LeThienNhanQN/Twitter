<?php 
    $notifications = $notificationDAO->getNotification($userId);
?>
<!--NOTIFICATION WRAPPER FULL WRAPPER-->
<div class="notification-full-wrapper">

	<div class="notification-full-head">
		<div>
			<a href="#">All</a>
		</div>
		<div>
			<a href="#">Mention</a>
		</div>
		<div>
			<a href="#">settings</a>
		</div>
	</div>

<!-- Follow Notification -->
<!--NOTIFICATION WRAPPER-->
<?php 
    foreach($notifications as $notification):
?>

<?php
    if($notification->type == "follow"):
?>
<div class="notification-wrapper">
	<div class="notification-inner">
		<div class="notification-header">
			
			<div class="notification-img">
				<span class="follow-logo">
					<i class="fa fa-child" aria-hidden="true"></i>
				</span>
			</div>
			<div class="notification-name">
				<div>
					 <img src="<?php echo BASE_URL.$notification->profile_image ?>"/>
				</div>
			 
			</div>
			<div class="notification-tweet"> 
			<a href="<?php echo BASE_URL.'profile/'.$notification->username ?>" class="notifi-name">
                <?php echo $notification->screen_name ?></a>
                <span> đã Follow bạn - <span><?php echo $tweetService->timeAgo($notification->follow_create_date) ?></span>
			
			</div>
		
		</div>
		
	</div>
	<!--NOTIFICATION-INNER END-->
</div>
<!--NOTIFICATION WRAPPER END-->
<!-- Follow Notification -->
<?php 
    endif;
?>

<!-- Like Notification -->
<!--NOTIFICATION WRAPPER-->
<?php
    if($notification->type == "like"):
?>
<div class="notification-wrapper">
	<div class="notification-inner">
		<div class="notification-header">
			<div class="notification-img">
				<span class="heart-logo">
					<i class="fa fa-heart" aria-hidden="true"></i>
				</span>
			</div>
			<div class="notification-name">
				<div>
					 <img src="<?php echo BASE_URL.$notification->profile_image ?>"/>
				</div>
			</div>
		</div>
		<div class="notification-tweet"> 
			<a href="<?php echo BASE_URL.'profile/'.$notification->username ?>" class="notifi-name">
                <?php echo $notification->screen_name ?>
            </a>
            <span> 
                đã thích tweet của bạn - 
                <span>
                     <?php echo $tweetService->timeAgo($notification->create_date) ?>
                </span>
            </span>
		</div>
        <?php 
            $user = $userDAO->findById($notification->tweet_userid);
        ?>
		<div class="notification-footer">
			<div class="noti-footer-inner">
				<div class="noti-footer-inner-left">
					<div class="t-h-c-name">
						<span><a href="<?php echo BASE_URL.'profile/'.$user->getUsername() ?>">
                            <?php echo $user->getScreenName() ?>
                            </a>
                        </span>
						<span>@<?php echo $user->getUsername() ?></span>
						<span><?php echo $tweetService->timeAgo($notification->tweet_create_date) ?></span>
					</div>
					<div class="noti-footer-inner-right-text">		
						<?php echo $notification->tweet_status ?>
					</div>
				</div>
				<div class="noti-footer-inner-right">
                    <?php if($notification->tweet_image != ""): ?>
					<img src="<?php echo BASE_URL.$notification->tweet_image ?>"/>	
                    <?php endif; ?>
				</div> 

			</div><!--END NOTIFICATION-inner-->
		</div>
	</div>
</div>
<!--NOTIFICATION WRAPPER END--> 
<!-- Like Notification -->
<?php 
    endif;
?>

<!-- Retweet Notification -->
<!--NOTIFICATION WRAPPER-->
<?php
    if($notification->type == "retweet"):
?>
<div class="notification-wrapper">
	<div class="notification-inner">
		<div class="notification-header">
			
			<div class="notification-img">
				<span class="retweet-logo">
					<i class="fa fa-retweet" aria-hidden="true"></i>
				</span>
			</div>
		<div class="notification-tweet"> 
			<a href=" <?php echo BASE_URL.'profile/'.$notification->username ?>" class="notifi-name">
                <?php echo $notification->screen_name ?>
            </a>
            <span> đã retweet - <span><?php echo $tweetService->timeAgo($notification->create_date) ?></span>
		</div>
        <?php 
            $user = $userDAO->findById($notification->tweet_userid);
        ?>
		<div class="notification-footer">
			<div class="noti-footer-inner">

				<div class="noti-footer-inner-left">
					<div class="t-h-c-name">
						<span><a href="<?php echo BASE_URL.'profile/'.$user->getUsername() ?>">
                            <?php echo $user->getScreenName() ?>
                            </a>
                        </span>
						<span>@<?php echo $user->getUsername() ?></span>
						<span><?php echo  $tweetService->timeAgo($notification->tweet_create_date) ?></span>
					</div>
					<div class="noti-footer-inner-right-text">		
						<?php echo $notification->tweet_status ?>
					</div>
				</div>

			 
				<div class="noti-footer-inner-right">
                <?php if($notification->tweet_image != ""): ?>
					<img src="<?php echo BASE_URL.$notification->tweet_image ?>"/>	

                <?php endif; ?>
				</div> 

			</div><!--END NOTIFICATION-inner-->
		</div>
		</div>
	</div>
</div>
<!--NOTIFICATION WRAPPER END-->
<!-- Retweet Notification -->
<?php 
    endif;
    if($notification->type == "mention"):
?>
	
<?php
    endif;
    endforeach;
?>
</div>
<!--NOTIFICATION WRAPPER FULL WRAPPER END-->
