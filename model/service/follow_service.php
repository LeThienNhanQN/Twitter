<?php
    class FollowService{

        public function getFollowBtn($profileId, $userId){
            $followDAO = new FollowDAO();
            $follow = $followDAO->checkFollow($profileId, $userId);
            if($profileId != $userId){
                if($follow != false){
                    if($follow->getUserReceive() == $profileId){
                        //đang follow
                        return "<button class='f-btn following-btn follow-btn'
                         data-follow='".$userId."' data-profile='".$profileId."' 
                         title='huỷ follow'>
                         Following</button>";
                    }
                }else{
                    //Follow button
                    return "<button class='f-btn follow-btn' data-follow='".$userId."' 
                    data-profile='".$profileId."' title='follow người này'>
                    <i class='fa fa-user-plus'></i>Follow</button>";
                }
            }else{
                //edit button
                return "<button class='f-btn' 
                onclick=location.href='".BASE_URL."editProfile.php'>Edit Profile</button>";
            }
        }
    }
?>