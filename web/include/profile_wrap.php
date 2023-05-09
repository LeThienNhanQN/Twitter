<!--Profile cover-->
<div class="profile-cover-wrap">
<div class="profile-cover-inner">
	<div class="profile-cover-img">
		<!-- PROFILE-COVER -->
		<img src="<?php echo BASE_URL.$guestUser->getProfileCover(); ?>"/>
	</div>
</div>
<div class="profile-nav">
 <div class="profile-navigation">
	<ul>
		<li>
		<div class="n-head">
			TWEETS
		</div>
		<div class="n-bottom">
		  <?php echo $count ?>
		</div>
		</li>
		<li>
			<a href="<?php echo BASE_URL.$guestUser->getUsername(); ?>/Following">
				<div class="n-head">
					<a href="<?php echo BASE_URL.$guestUser->getUsername(); ?>/Following">FOLLOWING</a>
				</div>
				<div class="n-bottom">
					<span class="count-following">
						<?php
							$countFollowing = $followDAO->countFollowingByUserId($guestUser->getId());
							 if($countFollowing < 1){
								 echo '0';
							 }else{
								 echo $countFollowing;
							 }
						?>
					</span>
				</div>
			</a>
		</li>
		<li>
		 <a href="<?php  echo BASE_URL.$guestUser->getUsername(); ?>/Follower">
				<div class="n-head">
					FOLLOWERS
				</div>
				<div class="n-bottom">
					<span class="count-followers">
						<?php 
							$countFollower = $followDAO->countFollowerByUserId($guestUser->getId());
							if($countFollower < 1){
								echo '0';
							}else{
								echo $countFollower;
							}
							
						?>
					</span>
				</div>
			</a>
		</li>
		<li>
			<a href="#">
				<div class="n-head">
					LIKES
				</div>
				<div class="n-bottom">
					<?php echo $countLike ?>
				</div>
			</a>
		</li>
	</ul>
	<div class="edit-button">
		<span>
			<?php echo $followService->getFollowBtn($guestUser->getId(), $userId); ?>
		</span>	
	</div>
    </div>
</div>
</div><!--Profile Cover End-->
