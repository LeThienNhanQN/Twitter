<?php
    class User extends AbstractModel{
        private $email;
        private $password;
        private $username;
        private $screenName;
        private $profileImage;
        private $profileCover;
        private $following;
        private $follower;
        private $bio;
        private $country;
        private $website;
        private $role;
        private $status;

        public function setEmail($email){
            $this->email = $email;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setScreenName($screenName){
            $this->screenName = $screenName;
        }

        public function getScreenName(){
            return $this->screenName;
        }

        public function setProfileImage($profileImage){
            $this->profileImage = $profileImage;
        }

        public function getProfileImage(){
            return $this->profileImage;
        }

        public function setProfileCover($profileCover){
            $this->profileCover = $profileCover;
        }

        public function getProfileCover(){
            return $this->profileCover;
        }

        public function setFollowing($following){
            $this->following = $following;
        }

        public function getFollowing(){
            return $this->following;
        }

        public function setFollower($follower){
            $this->follower = $follower;
        }

        public function getFollower(){
            return $this->follower;
        }

        public function setBio($bio){
            $this->bio = $bio;
        }

        public function getBio(){
            return $this->bio;
        }

        public function setCountry($country){
            $this->country = $country;
        }

        public function getCountry(){
            return $this->country;
        }

        public function setWebsite($website){
            $this->website = $website;
        }

        public function getWebsite(){
            return $this->website;
        }

        public function setRole($role){
            $this->role = $role;
        }

        public function getRole(){
            return $this->role;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }
    }
?>