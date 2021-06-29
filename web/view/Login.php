<html>

<head>
    <title>twitter</title>
    <meta charset="UTF-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
	<link rel="manifest" href="site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />
    <link rel="stylesheet" href="public/css/style-complete.css" />
</head>
<!--Helvetica Neue-->

<body>
    <div class="front-img">
        <img src="('../../public/images/background.jpg"></img>
    </div>

    <div class="wrapper">
        <!-- header wrapper -->
        <div class="header-wrapper">

            <div class="nav-container">
                <!-- Nav -->
                <div class="nav">

                    <div class="nav-left">
                        <ul>
                            <li><i class="fa fa-twitter" aria-hidden="true"></i><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                        </ul>
                    </div><!-- nav left ends-->

                    <div class="nav-right">
                        <ul>
                            <li><a href="#">Language</a></li>
                        </ul>
                    </div><!-- nav right ends-->

                </div><!-- nav ends -->

            </div><!-- nav container ends -->

        </div><!-- header wrapper end -->

        <!---Inner wrapper-->
        <div class="inner-wrapper">
            <!-- main container -->
            <div class="main-container">
                <!-- content left-->
                <div class="content-left">
                    <h1>Welcome to Halo.</h1>
                    <br />
                    <p>A place to connect with your friends — and Get updates from the people you love, And get the updates from the world and things that interest you.</p>
                </div><!-- content left ends -->

                <!-- content right ends -->
                <div class="content-right">
                    <!-- Log In Section -->
                    <div class="login-wrapper">
                   
                        <?php include_once('web/include/login-form.php');?>
                    </div><!-- log in wrapper end -->

                    <!-- SignUp Section -->
                    <div class="signup-wrapper">
                       <?php include_once('web/include/singup-form.php'); ?>
                    </div>
                    <!-- SIGN UP wrapper end -->

                </div><!-- content right ends -->

            </div><!-- main container end -->

        </div><!-- inner wrapper ends-->
    </div><!-- ends wrapper -->
</body>

</html>