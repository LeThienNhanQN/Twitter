<?php
   
   if(isset($_POST['login']) && !empty($_POST['login'])){
       $email = filter_input(INPUT_POST, 'email');
       $password = filter_input(INPUT_POST, 'password');

       if(!empty($email) or !empty($password)){
            $email = $userService->checkInput($email);
            $password = $userService->checkInput($password);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = "Email không hợp lệ";
            }else if(($userDAO->findUser($email, $password) == true)){
              $user = $userDAO->findUserIdByEmail($email, $password);
              $_SESSION['user_id'] = $user->getId();
               header('Location: my/home');
            }
       }else{
           $error = "Nhập đầy đủ tên hoặc mật khẩu";
       }
   }
?>

<div class="login-div">
    <form method="post">
        <ul>
            <li>
                <input type="text" name="email" placeholder="Nhập email" />
            </li>
            <li>
                <input type="password" name="password" placeholder="mật khấu" />
                <input type="submit" name="login" value="Đăng Nhập" />
            </li>
            <li>
                <input type="checkbox" Value="Remember me">Remember me
            </li>
            <?php
                if(isset($error)){
                    echo '<li class="error-li">
                             <div class="span-fp-error">'.$error.'</div>
                        </li> ';
                
                }
            ?>
        </ul>
        <!--
	 
	-->
    </form>
</div>