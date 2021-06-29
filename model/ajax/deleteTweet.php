<?php
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../dao/init.php');
    include_once('../bl/init.php');
    include_once('../service/init.php');

    if(isset($_POST['delete']) && !empty($_POST['delete'])){
        $tweetId = filter_input(INPUT_POST, 'delete');
        $userId = filter_input(INPUT_POST, 'userId');

        $tweet = $tweetDAO->findByTweetId($tweetId);

        preg_match_all("/#+([a-zA-Z0-9_]+)/i", $tweet->getStatus(), $hashtags);
        foreach($hashtags[1] as $hashtag){
          if(!empty($hashtag) && ($trendDAO->checkHashtag($hashtag)) == false){
              $count = $trendDAO->findCountUsedByHashtag($hashtag);
              if($count == 1){  
                $trendDAO->deleteHashtag($hashtag);
              }else{
                $trendDAO->updateCountByHashtag($hashtag, $count - 1);
              }
           }
      }

        $commentDAO->deleteByTweetId($tweetId);
        $retweetDAO->deleteByTweetId($tweetId);
        $likeDAO->deleteByTweetId($tweetId);
        $tweetDAO->deleteById($tweetId);

    }

    if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
        $tweetId = filter_input(INPUT_POST, 'showPopup');
        $userId = filter_input(INPUT_POST, 'userId');
        $tweet = $tweetDAO->findById($tweetId);
        $user = $userDAO->findById($tweet->getUserId());
?>
<div class="retweet-popup">
  <div class="wrap5">
    <div class="retweet-popup-body-wrap">
      <div class="retweet-popup-heading">
        <h3>Bạn có muốn xoá tweet?</h3>
        <span><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
      </div>
       <div class="retweet-popup-inner-body">
        <div class="retweet-popup-inner-body-inner">
          <div class="retweet-popup-comment-wrap">
             <div class="retweet-popup-comment-head">
              <img src="<?php echo BASE_URL.$user->getProfileImage();?>"/>
             </div>
             <div class="retweet-popup-comment-right-wrap">
               <div class="retweet-popup-comment-headline">
                <a><?php echo $user->getScreenName();?> </a>
                <span>
                    ‏@<?php echo $user->getUsername() . ' ' . $tweetService->timeAgo($tweet->getCreateDate());?>
                </span>
               </div>
               <br>
               <div class="retweet-popup-comment-body">
                 <?php echo $tweet->getStatus()?>
               </div>
             </div>
          </div>
         </div>
      </div>
      <div class="retweet-popup-footer"> 
        <div class="retweet-popup-footer-right">
          <button class="cancel-it f-btn">Thoát</button>
          <button class="delete-it" 
            data-tweet="<?php echo $tweet->getId();?>" 
            data-user="<?php echo $user->getId(); ?>" type="submit">
            Xoá
            </button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
}
?>
