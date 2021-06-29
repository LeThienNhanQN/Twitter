<?php
    class Follow extends AbstractModel{
        private $userSender;
        private $userReceive;

        public function setUserSender($userSender){
            $this->userSender = $userSender;
        }

        public function getUserSender(){
            return $this->userSender;
        }

        public function setUserReceive($userReceive){
            $this->userReceive = $userReceive;
        }

        public function getUserReceive(){
            return $this->userReceive;
        }
    }
?>