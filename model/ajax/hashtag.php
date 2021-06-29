<?php
    include_once('../dao/util/connection.php');
    include_once('../../mapper/mapper.php');
    include_once('../bl/init.php');
    include_once('../dao/init.php');

    if(isset($_POST['hashtag'])){
        $hashtag = filter_input(INPUT_POST, 'hashtag');
        $tagUser = filter_input(INPUT_POST, 'hashtag');

        //tim ki tự trong chuoi
        if(substr($hashtag, 0, 1) === '#'){
            $trend = str_replace('#', '', $hashtag);

            if($trendDAO->findByHashtag($trend) != null){
                $trends = $trendDAO->findByHashtag($trend);

                foreach($trends as $hashtag){
                    echo '<li><a href="#"><span class="getValue">#'.$hashtag->getHashtag().'</span></a></li>';
                }
            }
            
        }
        if(substr($tagUser, 0, 1) === '@'){
            $tagUser = str_replace('@', '', $tagUser);
            $users = $trendDAO->findByTagUser($tagUser);
            if(!empty($users)){
                foreach($users as $user){
                    echo '<li><div class="nav-right-down-inner">
                    <div class="nav-right-down-left">
                        <span><img src="'.BASE_URL.$user->getProfileImage().'"></span>
                    </div>
                    <div class="nav-right-down-right">
                        <div class="nav-right-down-right-headline">
                            <a>'.$user->getScreenName().'</a><span class="getValue">@'.$user->getUsername().'</span>
                        </div>
                    </div>
                </div><!--nav-right-down-inner end-here-->
                </li>';
                }
            }
           
        }
    }
?>