<?php
	include_once('../../model/dao/util/connection.php');
	include_once('../../model/dao/init.php');
    include_once('../../mapper/mapper.php');
    include_once('../../model/bl/init.php');
    include_once('../../model/service/init.php');

    if($userService->loggedIn() === false){
        header('Location: index.php');
    }else{
        $userId = $_SESSION['user_id'];
        $user = $userDAO->findById($userId);

        if(isset($_POST['screenName'])){
            $screen_name = filter_input(INPUT_POST, 'screenName');
            $bio = filter_input(INPUT_POST, 'bio');
            $country = filter_input(INPUT_POST, 'country');
            $website = filter_input(INPUT_POST, 'website');

            if(strlen($screen_name) > 30){
                $error = "tên không dài quá 30 kí tự";
            }else if(strlen($bio) > 120){
                $error = "chi tiết không quá 120 kí tự";
            }else{
                $params = [
                    'screen_name' => $screen_name,
                    'bio' => $bio,
                    'country' => $country,
                    'website' => $website
                ];
                $userDAO->update('users', $userId, $params);
                header('Location: '.BASE_URL.'profile/'.$user->getUsername());
            }
        }else{
            $error = "nhập tên hiển thị";
        }

        if(isset($_FILES['profileCover'])){
            if(!empty($_FILES['profileCover']['name'][0])){
                $fileRoot = $userDAO->uploadImage($_FILES['profileCover']);
                //echo $fileRoot;
                $params = [
                    'profile_cover' => $fileRoot
                ];
                $userDAO->update('users', $userId, $params);
            }
		}
		
		if(isset($_FILES['profileImage'])){
			if(!empty($_FILES['profileImage']['name'][0])){
				$fileRoot = $userDAO->uploadImage($_FILES['profileImage']);
				$params = [
					'profile_image' => $fileRoot
				];
				$userDAO->update('users', $userId, $params);
			}
		}
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user->getUsername(); ?></title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL ?>apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL ?>favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL ?>favicon-16x16.png">
	<link rel="manifest" href="<?php echo BASE_URL ?>site.webmanifest">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/Font-Awesome-4.6.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>public/css/style-complete.css"/>
    <script src="https://code.jquery.com/jquery-3.1.1.js" 
    integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">
	<!-- header wrapper -->
<div class="header-wrapper">

<div class="nav-container">
	<!-- Nav -->
	<div class="nav">
		<div class="nav-left">
			<ul>
				<li><a href="<?php echo BASE_URL ?>my/home"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
				<li><a href="<?php echo BASE_URL;?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notifications<span id="notificaiton"></span></a></li>
				<li id="messagePopup"><i class="fa fa-envelope" aria-hidden="true"></i>Messages<span id="messages"></span></li>

			</ul>
		</div>
		<!-- nav left ends-->
		<div class="nav-right">
			<ul>
				<li><input type="text" placeholder="Search" class="search"/><i class="fa fa-search" aria-hidden="true"></i>
				<div class="search-result">
					 			
				</div></li>
				<li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo $user->getProfileImage();?>"/></label>
				<input type="checkbox" id="drop-wrap1">
				<div class="drop-wrap">
					<div class="drop-inner">
						<ul>
							<li><a href="<?php echo $user->getUsername();?>"><?php echo $user->getUsername();?></a></li>
							<li><a href="settings/account">Settings</a></li>
							<li><a href="public/include/logout.php">Log out</a></li>
						</ul>
					</div>
				</div>
				</li>
				<li><label for="pop-up-tweet" class="addTweetBtn">Tweet</label></li>
			</ul>
		</div>
		<!-- nav right ends-->
	</div>
	<!-- nav ends -->
</div>
<!-- nav container ends -->
</div>
<!-- header wrapper end -->

<!--Profile cover-->
<div class="profile-cover-wrap"> 
<div class="profile-cover-inner">
	<div class="profile-cover-img">
		<img src="<?php echo BASE_URL.$user->getProfileCover();?>"/>
		<!-- profileCover -->

		<div class="img-upload-button-wrap">
			<div class="img-upload-button1">
				<label for="cover-upload-btn">
					<i class="fa fa-camera" aria-hidden="true"></i>
				</label>
				<span class="span-text1">
					Thay đổi ảnh bìa của bạn 
				</span>
				<input id="cover-upload-btn" type="checkbox"/>
				<div class="img-upload-menu1">
					<span class="img-upload-arrow"></span>
					<form method="post" enctype="multipart/form-data">
						<ul>
							<li>
								<label for="file-up">
									Tải lên
								</label>
								<input type="file" onchange="this.form.submit();" name="profileCover" id="file-up" />
							</li>
								<li>
								<label for="cover-upload-btn">
									Thoát 
								</label>
							</li>
						</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="profile-nav">
	<div class="profile-navigation">
		<ul>
			<li>
				<a href="#">
					<div class="n-head">
						TWEETS
					</div>
					<div class="n-bottom">
						0
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="n-head">
						FOLLOWINGS
					</div>
					<div class="n-bottom">
						0
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="n-head">
						FOLLOWERS
					</div>
					<div class="n-bottom">
						0
					</div>
				</a>
			</li>
			<li>
				<a href="#">
					<div class="n-head">
						LIKES
					</div>
					<div class="n-bottom">
						0
					</div>
				</a>
			</li>
			
		</ul>
		<div class="edit-button">
			<span>
				<button class="f-btn" type="button" onclick="window.location.href='<?php echo BASE_URL.$user->getUsername();?>'" value="Cancel">Cancel</button>
			</span>
			<span>
				<input type="submit" id="save" value="Save Changes">
			</span>
		 
		</div>
	</div>
</div>
</div><!--Profile Cover End-->

<div class="in-wrapper">
<div class="in-full-wrap">
  <div class="in-left">
	<div class="in-left-wrap">
		<!--PROFILE INFO WRAPPER END-->
<div class="profile-info-wrap">
	<div class="profile-info-inner">
		<div class="profile-img">
			<img src="<?php echo BASE_URL.$user->getProfileImage();?>"/>
			<!-- profileImage -->
			<div class="img-upload-button-wrap1">
			 <div class="img-upload-button">
				<label for="img-upload-btn">
					<i class="fa fa-camera" aria-hidden="true"></i>
				</label>
				<span class="span-text">
					Change your profile photo
				</span>
				<input id="img-upload-btn" type="checkbox"/>
				<div class="img-upload-menu">
				 <span class="img-upload-arrow"></span>
					<form method="post" enctype="multipart/form-data">
						<ul>
							<li>
								<label for="profileImage">
									Upload photo
								</label>
								<input id="profileImage" type="file"  onchange="this.form.submit();" name="profileImage"/>
								
							</li>
							<li><a href="#">Remove</a></li>
							<li>
								<label for="img-upload-btn">
									Cancel
								</label>
							</li>
						</ul>
					</form>
				</div>
			  </div>
			  <!-- img upload end-->
			</div>
		</div>


			<form id="editForm" method="post" enctype="multipart/Form-data">	
  				<?php if(isset($imgError)){
                      echo '<li>'.$imgError.'</li>';
                      }
                ?>
  				<div class="profile-name-wrap">
					<div class="profile-name">
						<input type="text" name="screenName" value="<?php echo $user->getScreenName();?>"/>
					</div>
					<div class="profile-tname">
						@<?php echo $user->getUsername();?>
					</div>
				</div>
				<div class="profile-bio-wrap">
					<div class="profile-bio-inner">
						<textarea class="status" name="bio"><?php echo $user->getBio();?></textarea>
						<div class="hash-box">
					 		<ul>
					 		</ul>
					 	</div>
					</div>
				</div>
					<div class="profile-extra-info">
					<div class="profile-extra-inner">
						<ul>
							<li>
								<div class="profile-ex-location">
									<input id="cn" type="text" name="country" placeholder="Country" value="<?php echo $user->getCountry();?>" />
								</div>
							</li>
							<li>
								<div class="profile-ex-location">
									<input type="text" name="website" placeholder="Website" value="<?php echo $user->getWebsite();?>"/>
								</div>
							</li>
							<?php if(isset($error)){echo '<li style="color: red;">'.$error.'</li>';}?>
 				</form>
				<script type="text/javascript">
					$('#save').click(function(){
						$('#editForm').submit();
					}); 
				</script>
						</ul>						
					</div>
				</div>
				<div class="profile-extra-footer">
					<div class="profile-extra-footer-head">
						<div class="profile-extra-info">
							<ul>
								<li>
									<div class="profile-ex-location-i">
										<i class="fa fa-camera" aria-hidden="true"></i>
									</div>
									<div class="profile-ex-location">
										<a href="#">0 Photos and videos </a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="profile-extra-footer-body">
						<ul>
						  <!-- <li><img src="#"></li> -->
						</ul>
					</div>
				</div>
			</div>
			<!--PROFILE INFO INNER END-->
		</div>
		<!--PROFILE INFO WRAPPER END-->
	</div>
	<!-- in left wrap-->
</div>
<!-- in left end-->

<div class="in-center">
	<div class="in-center-wrap">	
	</div>
	<!-- in left wrap-->
<div class="popupTweet"></div>
</div>
<!-- in center end -->

<div class="in-right">
	<div class="in-right-wrap">
	<!-- WHO TO FOLLOW -->

	<!-- TRENDS -->
	</div>
	<!-- in left wrap-->
</div>
<!-- in right end -->

   </div>
   <!--in full wrap end-->
 
  </div>
  <!-- in wrappper ends-->

</div>
<!-- ends wrapper -->
</body>
</html>