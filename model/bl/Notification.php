<?php 
    class Notification extends AbstractModel{
        private $notificationFor;
        private $notificationFrom;
        private $target;
        private $type;
        private $status;

        public function setNotificationFor($notificationFor){
            $this->notificationFor = $notificationFor;
        }

        public function getNotificationFor(){
            return $this->notificationFor;
        }

        public function setNotificationFrom($notificationFrom){
            $this->notificationFrom = $notificationFrom;
        }

        public function getNotificationFrom(){
            return $this->notificationFrom;
        }

        public function setTarget($target){
            $this->target = $target;
        }

        public function getTarget(){
            return $this->target;
        }

        public function setType($type){
            $this->type = $type;
        }

        public function getType(){
            return $this->type;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }
    }
?>