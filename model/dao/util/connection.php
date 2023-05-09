<?php

    class Database{

        private static $dns = 'mysql:host=localhost;dbname=twitter';
        private static $username = 'root';
        private static $password = "";
        private static $conn = null;

        public function __construct(){
            self::db_connect();
        }

        public static function db_connect(){
            try {
                if (is_null(self::$conn)) {
                    self::$conn = new PDO(self::$dns, self::$username, self::$password);
                    self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                }
            } catch (\Throwable $e) {
                $error_message = $e->getMessage();
                echo ($error_message);
            }
        }

        public static function db_disconnect(){
            if (is_null(self::$conn)) {
                self::$conn = null;
            }
        }

        public function __destruct(){
            self::db_disconnect();
        }

        public static function dbGetRow($sql = '', $params = []){
            if (!is_null(self::$conn)) {
                $result = self::$conn->prepare($sql);
                $result->execute($params);
                if ($result->rowCount() > 0) {
                    $rows = $result->fetch();
                    $result->closeCursor();

                    return $rows;
                }
            }
            return false;
        }

        public static function dbGetListCondition($sql = '', $params = []){
           if(!is_null(self::$conn))
           {
              $result = self::$conn->prepare($sql);
              $result->execute($params);
              if($result->rowCount() > 0)
              {
                 $rows = $result->fetchAll();
                 $result->closeCursor();
                 return $rows;
              }
           }
           return false;
        }

        public static function dbGetList($sql = ''){
            if(!is_null(self::$conn)){
               $result = self::$conn->prepare($sql);
               $result->execute();
               if($result->rowCount() > 0)
               {
                  $rows = $result->fetchAll();
                  $result->closeCursor();
                  return $rows;
               }
            }
            return false;
         }


        public static function dbExecute($sql = '', $params = []){
            if(!is_null(self::$conn)){
                $result = self::$conn->prepare($sql);
                $result->execute($params);
                if ($result->rowCount() > 0) {
                    $result->closeCursor();
                    return true;
                }
            }
            return false;
        }

        public static function dbUpdate($sql = '', $fields){

            if(!is_null(self::$conn)){
                $result = self::$conn->prepare($sql);
                foreach ($fields as $key => $value) {
                    $result->bindValue(':'.$key, $value);
                }
                $result->execute();
                if ($result->rowCount() > 0) {
                    $result->closeCursor();
                    return true;
                }
            }
            return false;
        }

        public static function dbNumRowCondition($sql = '', $params = []) {
           $count = 0;
           if(!is_null(self::$conn)){
              $result = self::$conn->prepare($sql);
              $result->execute($params);
              $count = $result->fetchColumn();
              $result->closeCursor();
              return $count;
           }
           return false;
        }

        public static function dbNumRow($sql = '') {
            $count = 0;
            if(!is_null(self::$conn)){
               $result = self::$conn->prepare($sql);
               $result->execute();
               $count = $result->fetchColumn();
               $result->closeCursor();
               return $count;
            }
            return false;
         }

        public static function fetchObj($sql, $params = array()){
            if(!is_null(self::$conn)){
                $result = self::$conn->prepare($sql);
                $result->execute($params);
                $row = $result->fetchAll(PDO::FETCH_OBJ);

                return $row;
            }
        }
    }
?>