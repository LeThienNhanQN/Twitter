<?php
    class MessageService{

        public function checkMessage($messageFrom, $userId){
            $messageDAO = new MessageDAO();
            if(!empty($messageDAO->findMessage($messageFrom, $userId))){
                $messages = $messageDAO->findMessage($messageFrom, $userId);

                foreach($messages as $message){
                    if($message->getMessageFrom() == $userId){
                        $userDAO = new UserDAO();
                        $user = $userDAO->findById($userId);
                        echo '
                        <div class="main-msg-body-right">
                            <div class="main-msg">
                                <div class="msg-img">
                                    <a href="'.BASE_URL.$user->getUsername().'">
                                        <img src="'.BASE_URL.$user->getProfileImage().'"/>
                                    </a>
                                </div>
                                <div class="msg">
                                    '.$message->getMessage().'
                                <div class="msg-time">
                                    '.$this->timeAgo($message->getCreateDate()).'
                                    </div>
                                </div>
                                <div class="msg-btn">
                                    <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                    <a class="deleteMsg" 
                                        data-message="'.$message->getId().'"
                                        data-user = "'.$message->getMessageFrom().'">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                      </div>
                        ';
                    }else if($message->getMessageFrom() == $messageFrom){
                        $userDAO = new UserDAO();
                        $user = $userDAO->findById($messageFrom);
                        echo '
                            <div class="main-msg-body-left">
                                <div class="main-msg-l">
                                    <div class="msg-img-l">
                                        <a href="'.BASE_URL.$user->getUsername().'">
                                            <img src="'.BASE_URL.$user->getProfileImage().'"/>
                                        </a>
                                    </div>
                                    <div class="msg-l">'.$message->getMessage().'
                                        <div class="msg-time-l">
                                            '.$this->timeAgo($message->getCreateDate()).'
                                        </div>
                                    </div>
                                    <div class="msg-btn-l">
                                        <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                        <a class="deleteMsg" 
                                            data-message="'.$message->getId().'"
                                            data-user = "'.$message->getMessageFrom().'">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div> ';
                    }
                }
            }else{
                echo "gửi tin nhắn đầu tiên!";
            }
        }

        public function timeAgo($datetime){
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $time    = strtotime($datetime);
             $current = time();
             $seconds = $current - $time;
             $minutes = round($seconds / 60);
            $hours   = round($seconds / 3600);
            $months  = round($seconds / 2600640);
    
            if($seconds <= 60){
                if($seconds == 0){
                    return 'now';
                }else{
                    return $seconds.'s';
                }
            }else if($minutes <= 60){
    
                return $minutes.'m';
    
            }else if($hours <= 24){
    
                return $hours.'h';
    
            }else if($months <= 12){
    
                return date('M j', $time);
    
            }else{
                return date('j M Y', $time);
            }
        }
    }
?>