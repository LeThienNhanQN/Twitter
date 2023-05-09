<?php

    class UserDAO extends Database{
        
        public function findUser($email, $password){
            $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

            $params = [
                'email' => $email,
                'password' => $password
            ];

            $row = self::dbGetRow($sql, $params);

            if(!empty($row)){
                return true;
            }else{
                return false;
            }
        }

        public function findById($userId){
            $sql = 'SELECT * FROM  users WHERE user_id = :userId';

            $params = [
                'userId' => $userId
            ];

            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                $userMapper = new UserMapper();
                $user = $userMapper->mapRow($row);

                return $user;
            }
        }

        public function findUserIdByEmail($email, $password){
            $sql = 'SELECT user_id, role_id, user_status FROM users WHERE email = :email AND password = :password';

            $params = [
                'email' => $email,
                'password' => $password
            ];

            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                $user = new User();
                $role = new Role();
                $user->setId($row['user_id']);
                $role->setId($row['role_id']);
                $user->setRole($role);
                $user->setStatus($row['user_status']);

                return $user;
            }
        }

        //check email exist
        public function checkEmail($email){
            $sql = 'SELECT email FROM users WHERE email = :email';

            $params = [
                'email' => $email
            ];

            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                return true;
            }else{
                return false;
            }
        }

        public function checkUsername($username){
            $sql = 'SELECT username FROM users WHERE username = :username';

            $params = [
                'username' => $username
            ];

            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                return true;
            }else{
                return false;
            }
        }

        public function checkPassword($password){
            $sql = 'SELECT password FROM users WHERE password = :password';

            $params = [
                'password' => $password
            ];

            $row = self::dbExecute($sql, $params);
            if(!empty($row)){
                return true;
            }else{
                return false;
            }
        }
        
        public function save($user){
            $sql = 'INSERT INTO users';
            $sql .= "(email, password, username, profile_image, profile_cover, following, ";
            $sql .= "followers, role_id, user_status, user_create_date) ";
            $sql .= "VALUES(:email, :password, :username, :profileImage, :profileCover, ";
            $sql .= "0, 0, 2, 1, CURRENT_TIMESTAMP)";   

            $params = [
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'username' => $user->getUsername(),
                'profileImage' => $user->getProfileImage(),
                'profileCover' => $user->getProfileCover()
            ];

            $row = self::dbExecute($sql, $params);
            if($row){
                return true;
            }else{
                return false;
            }
        }

        public function update($table, $user_id, $fields){
            $columns = '';
            $i = 1;
            foreach ($fields as $name => $value) {
                $columns .= "`{$name}` = :{$name}";
                if($i < count($fields)){
                    $columns .= ', ';
                }
                $i++;
            }
            $sql = "UPDATE {$table} SET {$columns} WHERE `user_id` = {$user_id}";
            if(self::dbUpdate($sql, $fields)){
                return true;
            }else{
                return false;
            }
        }

        public function findUserByUsername($username){
            $sql = 'SELECT * FROM users WHERE username = :username';

            $params = [
                'username' => $username
            ];

            $row = self::dbGetRow($sql, $params);
            if(!empty($row)){
                $userMapper = new UserMapper();
                $user = $userMapper->mapRow($row);

                return $user;
            }
        }

        public function uploadImage($file){
            $fileName = $file['name'];
            $fileTml = $file['tmp_name'];
            $fileSize = $file['size'];
            $error = $file['error'];

            $ext = explode('.', $fileName);
            $ext = strtolower(end($ext));
            $allowedExtensions = array('jpg', 'png', 'jpeg');

            if(in_array($ext, $allowedExtensions)){
                if($error === 0){
                    if($fileSize < 2097152){
                        $root = 'public/imageUser/'.$fileName;
                        move_uploaded_file($fileTml, $_SERVER['DOCUMENT_ROOT'].'/twitter/'.$root);
                        return $root;
                    }else{
                        $GLOBALS['imgError'] = "kích thước file quá lớn";
                    }
                }
            }else{
                $GLOBALS['imgError'] = "Only allowéd JPG, PNG JPEG extensions";
            }
        }

        public function search($keyword){
            $sql = 'SELECT user_id, username, screen_name, profile_image, profile_cover FROM users';
            $sql .= ' WHERE username LIKE :keyword OR screen_name LIKE :keyword';

            $params = [
                'keyword' => $keyword.'%'
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $rows){
                    $user = new User();
                    $user->setId($rows['user_id']);
                    $user->setUsername($rows['username']);
                    $user->setScreenName($rows['screen_name']);
                    $user->setProfileImage($rows['profile_image']);
                    $user->setProfileCover($rows['profile_cover']);

                    $users[] = $user;
                }
                return $users;
            }

        }

        public function updateFollowing($following, $userId){
            $sql = "UPDATE users SET following = :following WHERE user_id = :userId";
            $params = [
                'following' => $following,
                'userId' => $userId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function updateFollower($follower, $userId){
            $sql = "UPDATE users SET followers = :follower WHERE user_id = :userId";

            $params = [
                'follower' => $follower,
                'userId' => $userId
            ];

            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

          //tìm user đã follow bạn và bạn chưa follow lại
        public function findByUserSenderAndRandom($userId){
            $sql = "SELECT * FROM users WHERE user_id != :userId ";
            $sql .= "AND user_id NOT IN ";
            $sql .= "(SELECT user_receive FROM follow WHERE user_sender = :userId) ";
            $sql .= " AND role_id = 2 AND user_status = 1 ORDER BY rand() LIMIT 7";

            $params = [
                'userId' => $userId
            ];

            if(!empty(self::dbGetListCondition($sql, $params))){
                foreach(self::dbGetListCondition($sql, $params) as $rows){
                    $user = new User();
                    $user->setId($rows['user_id']);
                    $user->setUsername($rows['username']);
                    $user->setScreenName($rows['screen_name']);
                    $user->setProfileImage($rows['profile_image']);
                    $user->setProfileCover($rows['profile_cover']);

                    $users[] = $user;
                }
                return $users;
            }
        }

        public function findAll(){
            $sql = "SELECT * FROM users WHERE role_id = 2";

            if(!empty(self::dbGetList($sql))){
                foreach(self::dbGetList($sql) as $row){
                    $userMapper = new UserMapper();

                    $user = $userMapper->mapRow($row);

                    $users[] = $user;
                }

                return $users;
            }
        }

        public function updateStatus($userId, $num){
            $sql = "UPDATE users SET user_status = :num WHERE user_id = :userId";

            $params = [
                'num' => $num,
                'userId' => $userId
            ];
            if(self::dbExecute($sql, $params)){
                return true;
            }else{
                return false;
            }
        }

        public function userPagination($pageId, $total){
            $sql = "SELECT * FROM users WHERE role_id = 2 LIMIT ". ($pageId - 1) .",".$total;

            if(!empty(self::dbGetList($sql))){
                foreach(self::dbGetList($sql) as $row){
                    $userMapper = new UserMapper();

                    $user = $userMapper->mapRow($row);

                    $users[] = $user;
                }

                return $users;
            }
        }

        public function countRow(){
            $sql = "SELECT COUNT(*) FROM users WHERE role_id = 2";

            $count = 0;

            if(!empty(self::dbNumRow($sql))){
                return self::dbNumRow($sql);
            }
        }

    }
?>