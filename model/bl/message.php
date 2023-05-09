<?php
    class Message extends AbstractModel{
        private $message;
        private $messageTo;
        private $messageFrom;
        private $messsageStatus;

        public function setMessage($message){
            $this->message = $message;
        }

        public function getMessage(){
            return $this->message;
        }

        public function setMessageTo($messageTo){
            $this->messageTo = $messageTo;
        }

        public function getMessageTo(){
            return $this->messageTo;
        }

        public function setMessageFrom($messageFrom){
            $this->messageFrom = $messageFrom;
        }

        public function getMessageFrom(){
            return $this->messageFrom;
        }

        public function setMessageStatus($messageStatus){
            $this->messsageStatus = $messageStatus;
        }

        public function getMessageStatus(){
            return $this->messsageStatus;
        }
    }
?>