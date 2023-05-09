<?php
    if(isset($_POST['signup'])){
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $username = filter_input(INPUT_POST, 'username');

        if(empty($username) || empty($email) || empty($password)){
            $error = "Nhập đầy đủ 3 trường";
        }else{
            if($email == false){
                $error = "email phải có dạng x@gmail.com";
            }else if(strlen($username) > 30){
                $error = "username không quá 30 kí tự";
            }else if(strlen($password) < 6){
                $error = "mật khẩu phải lớn hơn 6";
            }else if($userDAO->checkEmail($email)){
                $error = "email đã tồn tại";
            }else if($userDAO->checkUsername($username)){
                $error = "tài khoản đã tồn tại";
            }else{
                $user->setEmail($email);
                $user->setUsername($username);
                $user->setPassword($password);
                $user->setProfileImage('public/images/profile_img/defaultProfileImage.png');
                $user->setProfileCover('public/images/profile_cover/defaultCoverImage.png');

                $userDAO->save($user);
                $user = $userDAO->findUserIdByEmail($email, $password);
                $_SESSION['user_id'] = $user->getId();
                header('Location: public/include/signup.php?step=1');
            }
        }
    }
?>

<form method="post">
    <div class="signup-div">
        <h3>Đăng Kí</h3>
        <ul>
            <li>
                <input type="text" name="username" placeholder="username" />
            </li>
            <li>
                <input type="email" name="email" placeholder="Email" />
            </li>
            <li>
                <input type="password" name="password" placeholder="Password" />
            </li>
            <li>
                <input type="submit" name="signup" Value="Đăng Kí">
            </li>
            <?php
                if(isset($error)){
                    echo ' <li class="error-li">
                             <div class="span-fp-error">'.$error.'</div>
                           </li> ';
                }
            ?>
        </ul>
      
    </div>
</form>