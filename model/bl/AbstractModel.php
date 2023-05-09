<?php
    class AbstractModel{

        private $id;
        private $createDate;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setCreateDate($createDate){
            $this->createDate = $createDate;
        }

        public function getCreateDate(){
            return $this->createDate;
        }
    }
?>