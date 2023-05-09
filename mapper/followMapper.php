<?php
    class FollowMapper{
        public function mapRow($row){
            $follow = new Follow();
            $follow->setId($row['follow_id']);
            $follow->setUserSender($row['user_sender']);
            $follow->setUserReceive($row['user_receive']);
            $follow->setCreateDate($row['follow_create_date']);

            return $follow;
        }
    }
?>