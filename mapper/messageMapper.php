<?php 
    class MessageMapper{
        public function mapRow($row){
            $message = new Message();

            $message->setId($row['message_id']);
            $message->setMessage($row['message']);
            $message->setMessageTo($row['message_to']);
            $message->setMessageFrom($row['message_from']);
            $message->setMessageStatus($row['message_status']);
            $message->setCreateDate($row['create_date']);
            return $message;
        }
    }
?>