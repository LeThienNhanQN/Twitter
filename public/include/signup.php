<?php
   if(isset($_GET['step']) === true){
		include_once('../../model/dao/util/connection.php');
		include_once('../../mapper/mapper.php');
		include_once('../../model/dao/init.php');
		include_once('../../model/bl/init.php');
		include_once('../../model/service/init.php');

       $user_id = $_SESSION['user_id'];
       $user = $userDAO->findById($user_id);
       $step = filter_input(INPUT_GET, 'step');

       if(isset($_POST['next'])){
			$screen_name = filter_input(INPUT_POST, 'screen_name');
			if(!empty($screen_name)){
				if(strlen($screen_name) > 30){
					$error = "tên hiển thị không lớn hơn 30 kí tự";
				}else{
					$params = array(
						'screen_name' => $screen_name
					);
					//update screen name
					$userDAO->update('users', $user_id, $params);
					header('Location: signup.php?step=2');
				}	
			}
       }else{
		   $error = "Nhập tên hiển thị";
	   }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
    <link rel="stylesheet" href="../../public/css/style-complete.css"/>
</head>
<body>
<div class="wrapper">
  <!-- nav wrapper -->
  <div class="nav-wrapper">

  	<div class="nav-container">
  		<div class="nav-second">
  			<ul>
  				<li><a href="#"></i><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
  			</ul>
  		</div><!-- nav second ends-->
  	</div><!-- nav container ends -->

  </div><!-- nav wrapper end -->

  <!---Inner wrapper-->
  <div class="inner-wrapper">
  	<!-- main container -->
  	<div class="main-container">
  		<!-- step wrapper-->
    <?php if ($_GET['step'] == '1'): ?>
   		<div class="step-wrapper">
  		    <div class="step-container">
  				<form method="post">
  					<h2>Nhập tên hiển thị</h2>
  					<h4>Don't worry, you can always change it later.</h4>
  					<div>
  						<input type="text" name="screen_name" placeholder="Tên hiển thị"/>
  					</div>
  					<div>
  						<ul>
  						  <li><?php if (isset($error)){echo $error;} ?></li>
  						</ul>
  					</div>
  					<div>
  						<input type="submit" name="next" value="Next"/>
  					</div>
  				 </form>
  			</div>
  		</div>
    <?php endif; ?>
    <?php if ($_GET['step'] == '2'):?>
  	<div class='lets-wrapper'>
  		<div class='step-letsgo'>
  			<h2>Chúng tôi rất vui vì bạn ở đây, <?php echo $user->getScreenName(); ?> </h2>
  			<p>Twitter là nơi cập nhật liên tục các tin tức, phương tiện, thể thao, truyền hình,
			   cuộc trò chuyện, và hơn thế nữa</p>
  			<br/>
  			<p>
  				Hãy cho chúng tôi biết tất cả những thứ bạn yêu thích và chúng tôi sẽ giúp bạn thiết lập
  			</p>
  			<span>
  				<a href='<?php echo BASE_URL.'my/home' ?>' class='backButton'>Let's go!</a>
  			</span>
  		</div>
  	</div>
    <?php endif; ?>

  	</div><!-- main container end -->

  </div><!-- inner wrapper ends-->
  </div><!-- ends wrapper -->

  </body>
  </html>

