<?php
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
	include_once('../bl/init.php');
	include_once('../dao/init.php');

    if(isset($_POST['action']) && !empty($_POST['action'])){
        $status = filter_input(INPUT_POST, 'status');
        $tweetImage = "";
        $userId = $_SESSION['user_id'];
      
        if(!empty($status) || !empty($_FILES['file']['name'][0])){
            if(!empty($_FILES['file']['name'][0])){
                $tweetImage = $tweetDAO->uploadImage($_FILES['file']);
            }

            if(strlen($status) > 140){
                $error = "Không quá 140 kí tự!";
            }else{
                date_default_timezone_set("Asia/Ho_Chi_Minh");

                 //save hashtag
                 preg_match_all("/#+([a-zA-Z0-9_]+)/i", $status, $hashtags);
                 //var_dump($hashtags);

                $params = [
                    'tweet_status' => $status,
                    'tweet_userid' => $userId,
                    'tweet_image' => $tweetImage,
                    'tweet_create_date' => date('Y-m-d H:i:s'),
					'likes_count' => 0,
                    'retweet_count' => 0,
                    'status' => 1
                ];
                $tweetDAO->save('tweets', $params);
                $result['success'] = "Tweet của bạn đã được tải lên!";

                foreach($hashtags[1] as $hashtag){
                    if(!empty($hashtag) && ($trendDAO->checkHashtag($hashtag)) == true){
                        $trendDAO->saveHashtag($status);
                     }else{
                         $count = $trendDAO->findCountUsedByHashtag($hashtag);
                         $trendDAO->updateCountByHashtag($hashtag, $count + 1);
                     }
                }
                //convert json
                echo json_encode($result);
            }
        }else{
            $error = "không để trống hoặc thêm hình ảnh!";
        }
        if(isset($error)){
            $result['error'] = $error;
            echo json_encode($result);
        }
    }
?>