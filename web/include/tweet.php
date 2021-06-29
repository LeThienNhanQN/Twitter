<?php
    if(isset($_POST['tweet'])){
        $status = filter_input(INPUT_POST, 'status');
        $tweetImage = '';
        if(!empty($status) || !empty($_FILES['file']['name'][0])){
            //check image
            if(!empty($_FILES['file']['name'][0])){
                $tweetImage = $tweetDAO->uploadImage($_FILES['file']); 
            }
            if(strlen($status) > 200){
                $error = "Không quá 200 kí tự";
            }else{
                //set timezone 
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                
                //save hashtag
                preg_match_all("/#+([a-zA-Z0-9_]+)/i", $status, $hashtags);
                //var_dump($hashtags);

                $params = [
                    'tweet_status' => $status,
                    'tweet_userid' => $_SESSION['user_id'],
                    'tweet_image' => $tweetImage,
                    'tweet_create_date' => date('Y-m-d H:i:s'),
                    'likes_count' => 0,
                    'retweet_count' => 0,
                    'status' => 1
                ];

                //save tweet
                $tweetDAO->save('tweets', $params);
                foreach($hashtags[1] as $hashtag){
                    if(!empty($hashtag) && ($trendDAO->checkHashtag($hashtag)) == true){
                        $trendDAO->saveHashtag($status);
                     }else{
                        $count = $trendDAO->findCountUsedByHashtag($hashtag);
                        $trendDAO->updateCountByHashtag($hashtag, $count + 1);
                     }
                }
            }
        }else{
            $error = "chọn ảnh";
        }
    }
?>

<!--TWEET WRAPPER-->
<div class="tweet-wrap">
    <div class="tweet-inner">
            <div class="tweet-h-left">
            <div class="tweet-h-img">
            <!-- PROFILE-IMAGE -->
                <img src="<?php echo BASE_URL.$user->getProfileImage(); ?>"/>
            </div>
            </div>
            <div class="tweet-body">
            <!-- tweet -->
            <form method="post" enctype="multipart/form-data">
            <textarea class="status"  maxlength="201" 
            name="status" placeholder="Type Something here!" rows="4" cols="50"></textarea>
            <div class="hash-box">
                <ul>
                    
                </ul>
            </div>
            </div>
            <div class="tweet-footer">
            <div class="t-fo-left">
                <ul>
                   
                    <li>
                        <label for="file">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                            <input type="file" name="file" id="file" multiple>
                            
                        </label>
                        <span class="tweet-error">
                            <?php
                                if(isset($error)){
                                    echo $error;
                                }else if(isset($imgError)){
                                    echo $imgError;
                                } 
                            ?>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="t-fo-right">
                <span id="count">200</span>
                <input type="submit" name="tweet" value="tweet"/>
        </form>
            </div>
            </div>
    </div>
</div><!--TWEET WRAP END-->

   

                                

