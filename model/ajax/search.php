<?php
    include_once('../dao/util/connection.php');
    include_once('../bl/init.php');
    include_once('../dao/init.php');

    if(isset($_POST['search']) && !empty($_POST['search'])){
        $search = filter_input(INPUT_POST, 'search');
        $users = $userDAO->search($search);

        if(!empty($users)){
            echo '<div class="nav-right-down-wrap"><ul>';
            foreach($users as $user){
                echo '<li>
                <div class="nav-right-down-inner">
                  <div class="nav-right-down-left">
                      <a href="'.BASE_URL.'profile/'.$user->getUsername().'"><img src="'.BASE_URL.$user->getProfileImage().'"></a>
                  </div>
                  <div class="nav-right-down-right">
                      <div class="nav-right-down-right-headline">
                          <a href="'.BASE_URL.'profile/'.$user->getUsername().'">'.$user->getScreenName().'</a><span>@'.$user->getUsername().'</span>
                      </div>
                      <div class="nav-right-down-right-body">
                       
                      </div>
                  </div>
              </div> 
                 </li> ';
            }
            echo '</ul> </div>';
        }else{
            echo '<div class="nav-right-down-wrap"><ul>';
            echo '<li>
            <div class="nav-right-down-inner">
              <div class="nav-right-down-right">
                  <div class="nav-right-down-right-headline">
                        không có kết quả 
                  </div>
                  <div class="nav-right-down-right-body">
                   
                  </div>
              </div>
          </div> 
             </li> ';
            echo '</ul> </div>';
        }
    }else{
        echo "invalid";
    }
?>