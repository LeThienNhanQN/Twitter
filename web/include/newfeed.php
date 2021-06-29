<?php
    if(isset($tweets)):
    foreach($tweets as $tweet):
        $user = $userDAO->findById($tweet->getUserId());
        if(!empty($likeDAO->findByUserIdAndTweetId($_SESSION['user_id'], $tweet->getId()))){
            $like = $likeDAO->findByUserIdAndTweetId($_SESSION['user_id'], $tweet->getId());
        }
        $countRetweet = $retweetDAO->countRowByUserIdAndTweetId($tweet->getUserId(), $tweet->getId());    
        $retweets = $retweetDAO->findByUserIdAndTweetId($tweet->getUserId(), $tweet->getId());
?>

    <div class="all-tweet">
    <div class="t-show-wrap" style="margin-top: 15px;">	
    <div class="t-show-inner">
       <?php 
           
           // foreach($retweets as $retweet):
               // $user = $userDAO->findById($retweet->getUserRetweet());
        ?>
        
        <div class="t-show-popup" data-tweet="<?php echo $tweet->getId(); ?>">
            <div class="t-show-head">
                <div class="t-show-img">
                    <img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/>
                </div>
                <div class="t-s-head-content">
                    <div class="t-h-c-name">
                        <span><a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>">
                            <?php echo $user->getScreenName(); ?></a>
                        </span>
                        <span>@<?php echo $user->getUsername(); ?></span>
                        <span><?php echo $tweetService->timeAgo($tweet->getCreateDate()); ?></span>
                    </div>
                    <div class="t-h-c-dis" style="color: red">
                        <?php echo $tweetService->getTweetLink($tweet->getStatus()); ?>
                    </div>
                </div>
            </div>
            <!--tweet show head end-->
            <div class="t-show-body">
            <div class="t-s-b-inner">
            <?php
                if($tweet->getTweetImage() != ""):
            ?>
            <div class="t-s-b-inner-in">
                <img src="<?php echo BASE_URL.$tweet->getTweetImage(); ?>" 
                class="imagePopup" data-tweet="<?php echo $tweet->getId(); ?>"/>
            </div>
                <?php endif; ?>
            </div>
            </div>
            <!--tweet show body end-->
        </div>
        <div class="t-show-footer">
            <div class="t-s-f-right">
                <ul> 
                    <li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
                    <!-- share -->
                    <li>
                        <button class="retweet" title="Chia sẻ" 
                        data-tweet="<?php echo $tweet->getId(); ?>" 
                        data-user="<?php echo $tweet->getUserId(); ?>">
                            <i class="fa fa-retweet" aria-hidden="true"></i>
                            <span class="retweetCount"><?php echo $countRetweet ?></span>
                        </button>
                    </li>
                    <!-- /end share -->

                    <li>

                    <!-- check like on user -->
                    <?php
                        if($like->getTweetId() == $tweet->getId()){
                    ?>
                        <button class="unlike-btn"  
                            data-tweet="<?php echo $tweet->getId(); ?>" 
                            data-user="<?php echo $_SESSION['user_id']; ?>">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <span class="likeCount">
                                <?php echo $tweet->getLikeCount() > 0 ? $tweet->getLikeCount() : ''; ?>
                            </span>
                        </button>
                    <?php
                        }else {
                    ?>
                        <button class="like-btn"  
                            data-tweet="<?php echo $tweet->getId(); ?>" data-user="<?php echo $_SESSION['user_id']; ?>">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="likeCount">
                                <?php echo $tweet->getLikeCount() > 0 ? $tweet->getLikeCount() : '';?>
                            </span>
                        </button>
                    <?php 
                        }
                    ?>
                    
                    
                    </li>
                        <li>
                        <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <ul> 
                        <?php
                            if($tweet->getUserId() == $_SESSION['user_id']):
                        ?>
                        <li>
                            <label class="deleteTweet" 
                                data-tweet="<?php echo $tweet->getId(); ?>" 
                                data-user="<?php echo $_SESSION['user_id'] ?>">
                                xoá Tweet
                            </label>                    
                        </li>
                        <?php
                            endif;
                        ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
       
      
    </div>
    </div>
    </div>










    <?php
        if(!is_null($retweets)):
            foreach($retweets as $retweet):
            //$user = $userDAO->findById($retweet->getUserRetweet());
            if(!empty($likeDAO->findByUserIdAndRetweetId($_SESSION['user_id'], $retweet->getId()))){
                $likeRetweet = $likeDAO->findByUserIdAndRetweetId($_SESSION['user_id'], $retweet->getId());
            } 
            
        ?>
        <div class="all-tweet">
        <div class="t-show-wrap" style="margin-top: 15px;">	
        <div class="t-show-inner">
        <div class="t-show-banner">
            <div class="t-show-banner-inner">
                <span><i class="fa fa-retweet" aria-hidden="true"></i></span>
                <span><?php echo $retweet->getUser()->getScreenName(); ?> đã chia sẻ bài viết</span>
            </div>
        </div>
        <div class="t-show-popup">
            <div class="t-show-img">
                <img src="<?php echo BASE_URL.$retweet->getUser()->getProfileImage(); ?>"/>
            </div>
            <div class="t-s-head-content">
                <div class="t-h-c-name">
                    <span>
                    <a href="<?php echo BASE_URL.'profile/'.$retweet->getUser()->getUsername() ?>">
                    <?php echo $retweet->getUser()->getScreenName(); ?></a></span>
                    <span>@<?php echo $retweet->getUser()->getUsername(); ?></span>
                    <span><?php echo $tweetService->timeAgo($retweet->getCreateDate()); ?></span>
                </div>
                <div class="t-h-c-dis">
                    <?php echo  $tweetService->getTweetLink($retweet->getRetweetStatus()); ?>
                </div>
            </div>
		</div>
        <div class="t-s-b-inner">
            <div class="t-s-b-inner-in">
                <div class="retweet-t-s-b-inner">

                    <!-- tweet -->
                 <?php if(!empty($tweet->getTweetImage())): ?>
                    <div class="retweet-t-s-b-inner-left">
                        <img src="<?php echo BASE_URL.$tweet->getTweetImage(); ?>" class="imagePopup" 
                        data-tweet="'.$tweet->tweetID.'"/>
                    </div>
                    <?php endif; ?>
                    <div>
                        <div class="t-h-c-name">
                            <span><a href="<?php echo BASE_URL.'profile/'.$user->getUsername(); ?>">
                            <?php echo $user->getScreenName() ?></a></span>
                            <span>@<?php echo $user->getUsername(); ?></span>
                            <span><?php echo $tweetService->timeAgo($tweet->getCreateDate()); ?></span>
                        </div>
                        <div class="retweet-t-s-b-inner-right-text">
                            <?php echo $tweetService->getTweetLink($tweet->getStatus()) ?>
                        </div>
                    </div>
                    <!-- end tweet -->


                </div>
            </div>
        </div>
		</div>
        <div class="t-show-footer">
            <div class="t-s-f-right">
                <ul> 
                    <li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
                    <!-- share retweet -->
                    <li>
                        <button disabled class="retweet" title="Chia sẻ" 
                        data-tweet="<?php echo $tweet->getId(); ?>" 
                        data-user="<?php echo $tweet->getUserId(); ?>">
                            <i class="fa fa-retweet" aria-hidden="true"></i>
                            <span class="retweetCount"><?php ?></span>
                        </button>
                    </li>
                    <!-- /end share retweet -->

                    <li>

                    <!-- check like retweet on user -->
                    <?php
                        if(!empty($likeRetweet)):
                        if($likeRetweet->getRetweet()->getId() == $retweet->getId()):
                    ?>
                        <button class="unlike-btn-retweet"  
                            data-retweet="<?php echo $retweet->getId(); ?>" data-user="<?php echo $_SESSION['user_id']; ?>">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <span class="likeCount-retweet">
                                <?php 
                                    echo $likeDAO->countLikeByRetweet($retweet->getId())
                                         > 0?$likeDAO->countLikeByRetweet($retweet->getId()):""  
                                ?>
                            </span>
                        </button>
                    <?php
                        else:
                    ?>
                        <button class="like-btn-retweet"  
                            data-retweet="<?php echo $retweet->getId(); ?>" data-user="<?php echo $_SESSION['user_id']; ?>">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="likeCount-retweet">
                                <?php 
                                    echo $likeDAO->countLikeByRetweet($retweet->getId())
                                         > 0?$likeDAO->countLikeByRetweet($retweet->getId()):""  
                                ?>
                            </span>
                        </button>
                    <?php 
                        endif;
                    endif;
                    ?>
                    
                    
                    </li>
                        <li>
                        <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <ul> 
                        <li><label class="deleteRetweet">xoá retweet</label></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        </div>
        </div>
    <?php 
        endforeach;
        endif;
    ?>
   
    <?php endforeach; endif; ?>