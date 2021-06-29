<?php
     include_once('../dao/util/connection.php');
     include_once('../../mapper/mapper.php');
     include_once('../dao/init.php');
     include_once('../bl/init.php');
	 include_once('../service/init.php');
	 
	 //hiển thị tin nhắn
	 if(isset($_POST['showChatMessage']) && !empty($_POST['showChatMessage'])){
		$userId = $_SESSION['user_id'];
		$messageFrom = filter_input(INPUT_POST, 'showChatMessage');

		$messageService->checkMessage($messageFrom, $userId);
	 }

	 // set status = 0
	 if(isset($_POST['hideMessage']) && !empty($_POST['hideMessage'])){
		 $messageId = filter_input(INPUT_POST, 'hideMessage');
		 $messageFrom = filter_input(INPUT_POST, 'messageFrom');
		 $userId = $_SESSION['user_id'];
		 if($messageFrom == $userId){
			$messageDAO->hideMessage($messageId);
		 }else{
			 echo "bạn không thể xoá!";
		 }
	 }

	 //send message
	 if(isset($_POST['sendMessage']) && !empty($_POST['sendMessage'])){
		 echo "hello";
		 $msg = filter_input(INPUT_POST, 'sendMessage');
		 $messageTo = filter_input(INPUT_POST, 'messageTo');
		 $userId = $_SESSION['user_id'];
		 $message = new Message();
		 $message->setMessage($msg);
		 $message->setMessageFrom($userId);
		 $message->setMessageTo($messageTo);
		 $message->setMessageStatus(0);
		 $messageDAO->save($message);
		 
	 }


	 //hiển thị danh sách tin nhắn gần đây
     if(isset($_POST['showMessage']) && !empty($_POST['showMessage'])){
         $userId = $_SESSION['user_id'];
		 
		 $messages = $messageDAO->findRecentMessage($userId);
		 $messageDAO->updateMessageStatusByUserId($userId);
?>
    
<!--  trang tìm kiếm user và recent message -->
<div class="popup-message-wrap">
<input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
<div class="wrap2">
<div class="message-send">
	<div class="message-header">
		<div class="message-h-left">
			<label for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
		</div>
		<div class="message-h-cen">
			<h4>Tin nhắn mới</h4>
		</div>
		<div class="message-h-right">
			<label for="popup-message-tweet" ><i class="fa fa-times" aria-hidden="true"></i></label>
		</div>
	</div>
	<div class="message-input">
		<h4>Gửi tin nhắn tới:</h4>
	  	<input type="text" placeholder="Search people" class="search-user"/>
		<ul class="search-result down">
				
		</ul>
	</div>
	<div class="message-body">
		<h4>Tin nhắn gần đây</h4>
		<div class="message-recent">
			<!--Direct Messages-->
			<?php 
				if(!empty($messages)): 
					foreach($messages as $message):
						$user = $userDAO->findById($message->getMessageFrom());
			?>
				<div class="people-message" data-user="<?php echo $message->getMessageFrom(); ?>">
					<div class="people-inner">
						<div class="people-img">
							<img src="<?php echo BASE_URL.$user->getProfileImage() ?>"/>
						</div>
						<div class="name-right2">
							<span>
								<a href="<?php echo BASE_URL.'profile/'.$user->getUsername() ?>">
									<?php echo $user->getScreenName() ?>
								</a>
							</span>
							<span>
							@<?php echo $user->getUsername() ?>
							</span>
						</div>
						<div class="msg-box">
							<?php echo $message->getMessage(); ?>
						</div>

						<span>
							<?php echo $tweetService->timeAgo($message->getCreateDate()) ?>
						</span>
					</div>
				</div>
				<?php 
				endforeach;
				endif;
			?>
			<!--Direct Messages-->
		</div>
	</div>
	<!--message FOOTER-->
	<div class="message-footer">
		<div class="ms-fo-right">
			<label>Next</label>
		</div>
	</div><!-- message FOOTER END-->
</div><!-- MESSGAE send ENDS-->
 
 
	<!-- trang tin nhắn chính -->
	<input id="mass" type="checkbox" checked="unchecked" />
	<div class="back">
		<div class="back-header">
			<div class="back-left">
				Tin nhắn
			</div>
			<div class="back-right">
				<label for="mass"  class="new-message-btn">Tin nhắn mới</label>
				<label for="popup-message-tweet"><i class="fa fa-times" aria-hidden="true"></i></label>
			</div>
		</div>
		<div class="back-inner">
			<div class="back-body">
			<!--Direct Messages-->
			<?php 
				if(!empty($messages)): 
					foreach($messages as $message):
						$user = $userDAO->findById($message->getMessageFrom());
			?>
			
				<div class="people-message" data-user="<?php echo $message->getMessageFrom(); ?>">
					<div class="people-inner">
						<div class="people-img">
							<img src="<?php echo BASE_URL.$user->getProfileImage() ?>"/>
						</div>
						<div class="name-right2">
							<span>
								<a href="<?php echo $user->getUsername() ?>"><?php echo $user->getScreenName() ?>
								</a>
							</span>
							<span>
							@<?php echo $user->getUsername() ?>
							</span>
						</div>
						<div class="msg-box">
							<?php echo $message->getMessage(); ?>
						</div>

						<span>
							<?php echo $tweetService->timeAgo($message->getCreateDate()) ?>
						</span>
					</div>
				</div>
				<!--Direct Messages-->
			<?php 
				endforeach;
				endif;
			?>
			</div>
		</div>
		<div class="back-footer">

		</div>
	</div>
</div>
</div>
<!-- POPUP MESSAGES END HERE -->





<?php


}else 
if(isset($_POST['showChatPopup']) && !empty($_POST['showChatPopup'])){
	$messageFrom = $_POST['showChatPopup'];
	$userId = $_SESSION['user_id'];
	$user = $userDAO->findById($messageFrom);
?>
	<!-- MESSAGE CHAT START -->
<div class="popup-message-body-wrap">
<input id="popup-message-tweet" type="checkbox" checked="unchecked"/>
<input id="message-body" type="checkbox" checked="unchecked"/>
<div class="wrap3">
<div class="message-send2">
	<div class="message-header2">
		<div class="message-h-left">

			<label class="back-messages" for="mass"><i class="fa fa-angle-left" aria-hidden="true"></i></label>
		</div>
		<div class="message-h-cen">
			<div class="message-head-img">
			<img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/><h4>Tin nhắn</h4>
			</div>
		</div>
		<div class="message-h-right">
		  <label class="close-msgPopup" for="message-body" ><i class="fa fa-times" aria-hidden="true"></i>
		  </label> 
		</div>
		<div class="message-del">
			<div class="message-del-inner">
				<h4>Bạn có muốn xoá tin nhắn này? </h4>
				<div class="message-del-box">
					<span>
						<button class="cancel" value="Cancel">Thoát</button>
					</span>
					<span>	
						<button class="delete" value="Delete">Xoá</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="main-msg-wrap">
      <div id="chat" class="main-msg-inner">
     
 	  </div>
	</div>
	<div class="main-msg-footer">
		<div class="main-msg-footer-inner">
			<ul>
				<li>
					<input id="msg" name="msg" 
						placeholder="Write some thing!" type = "text"></input>
				</li>
				<li>
					<input id="msg-upload" type="file" value="upload"/>
					<label for="msg-upload">
						<i class="fa fa-camera" aria-hidden="true"></i>
					</label>
				</li>
				<li>
					<input id="send" 
					data-user = "<?php echo $user->getId(); ?>" 
					type="submit" value="Send"/>
				</li>
			</ul>
		</div>
	</div>
 </div> <!--MASSGAE send ENDS-->
</div> <!--wrap 3 end-->
</div><!--POP UP message WRAP END-->

<script>
	/* var input = document.getElementById("msg");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("send").click();
        }
	});*/
	
	var input = document.getElementById("msg");
    
	input.addEventListener("keyup", function(event){
    if(event.keyCode === 13){
        event.preventDefault();
		document.getElementById("send").click();
    }
}); 
</script>

<!-- message Chat popup end -->
<?php
}
?>

