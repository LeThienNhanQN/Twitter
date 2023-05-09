<?php
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../dao/init.php');
    include_once('../bl/init.php');
    include_once('../service/init.php');

    if(isset($_POST['search']) && !empty($_POST['search'])){
        $userId = $_SESSION['user_id'];
        $search = filter_input(INPUT_POST, 'search');
        $users = $userDAO->search($search);

        if(!empty($users)){
            echo '
        <h4>People</h4>
            <div class="message-recent"> 
        ';
        foreach($users as $user){
            if($user->getId() != $userId){
                echo '
                <div class="people-message" data-user="'.$user->getId().'">
                    <div class="people-inner">
                        <div class="people-img">
                            <img src="'.BASE_URL.$user->getProfileImage().'"/>
                        </div>
                        <div class="name-right">
                            <span>
                            <a href="'.BASE_URL.'profile/'.$user->getUsername().'">
                                '.$user->getUsername().'
                            </a>
                            </span>
                            <span>@'.$user->getScreenName().'</span>
                        </div>
                    </div>
                </div>
                ';
            }
        }

        echo '
            </div>
        ';
        }else{
            echo 'Không có kết quả tìm kiểm';
        }
        
    }
?>