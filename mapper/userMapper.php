<?php
    class UserMapper{

        public function mapRow($row){
            $user = new User();
            $user->setId($row['user_id']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setScreenName($row['screen_name']);
            $user->setProfileImage($row['profile_image']);
            $user->setProfileCover($row['profile_cover']);
            $user->setFollowing($row['following']);
            $user->setFollower($row['followers']);
            $user->setBio($row['bio']);
            $user->setCountry($row['country']);
            $user->setWebsite($row['website']);
            $user->setStatus($row['user_status']);

            return $user;
        }
    }

?>