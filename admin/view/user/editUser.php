<?php 
    $userId = filter_input(INPUT_GET, 'userId');
    $user = $userDAO->findById($userId);
    $countTweet = $tweetDAO->countTweetByUserId($userId);
?>

<div class="row">
    <div class="col-xs-12">
        <?php
            if($user->getStatus() == 0):
        ?>
        <div class="clearfix">
            <div class="pull-left alert alert-success no-margin alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>

                <i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
                    tài khoản đã bị vô hiệu hoá
            </div>
        </div>
        <?php 
            endif;
        ?>
        <div class="hr dotted"></div>
        <div>
            <div id="user-profile-1" class="user-profile row">
                <div class="col-xs-12 col-sm-3 center">
                    <div>
                        <span class="profile-picture">
                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar" 
                            src="<?php echo BASE_URL.$user->getProfileImage() ?>" />
                        </span>
                        <div class="space-4"></div>
                        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                            <div class="inline position-relative">
                                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                    <i class="ace-icon fa fa-circle light-green"></i>
                                    &nbsp;
                                    <span class="white"><?php echo $user->getUsername() ?></span>
                                </a>

                                <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                                    <li class="dropdown-header"> Change Status </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-circle green"></i>
                                            &nbsp;
                                            <span class="green">Available</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-circle red"></i>
                                            &nbsp;
                                            <span class="red">Busy</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-circle grey"></i>
                                            &nbsp;
                                            <span class="grey">Invisible</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="space-6"></div>
                        <div class="profile-contact-info">
                        <div class="profile-contact-links align-left">
                            <a href="#" class="btn btn-link">
                                <i class="ace-icon fa fa-plus-circle bigger-120 green"></i>
                                Add as a friend
                            </a>

                            <a href="#" class="btn btn-link">
                                <i class="ace-icon fa fa-envelope bigger-120 pink"></i>
                                Send a message
                            </a>

                            <a href="#" class="btn btn-link">
                                <i class="ace-icon fa fa-globe bigger-125 blue"></i>
                                www.alexdoe.com
                            </a>
                        </div>

                        <div class="space-6"></div>

                        <div class="profile-social-links align-center">
                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
                                <i class="middle ace-icon fa fa-facebook-square fa-2x blue"></i>
                            </a>

                            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
                                <i class="middle ace-icon fa fa-twitter-square fa-2x light-blue"></i>
                            </a>

                            <a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
                                <i class="middle ace-icon fa fa-pinterest-square fa-2x red"></i>
                            </a>
                        </div>
					</div>
                    <div class="hr hr12 dotted"></div>
                    <div class="clearfix">
                        <div class="grid2">
                            <span class="bigger-175 blue"><?php echo $user->getFollower() ?></span>

                            <br />
                            Followers
                        </div>

                        <div class="grid2">
                            <span class="bigger-175 blue"><?php echo $user->getFollowing() ?></span>

                            <br />
                            Following
                        </div>
                    </div>

                    <div class="hr hr16 dotted"></div>
                </div>

                <div class="col-xs-12 col-sm-9">
                    <div class="center">
                        <span class="btn btn-app btn-sm btn-light no-hover">
                            <span class="line-height-1 bigger-170 blue"> 
                                <?php echo $user->getFollowing() ?>
                            </span>

                            <br />
                            <span class="line-height-1 smaller-90"> Following </span>
                        </span>

                        <span class="btn btn-app btn-sm btn-yellow no-hover">
                            <span class="line-height-1 bigger-170"> 
                                <?php echo $user->getFollower() ?> 
                            </span>

                            <br />
                            <span class="line-height-1 smaller-90"> Followers </span>
                        </span>

                        <a href="?c=listTweet&userId=<?php echo $user->getId() ?>">
                            <span class="btn btn-app btn-sm btn-grey no-hover">
                                <span class="line-height-1 bigger-170">  
                                    <?php echo $countTweet ?>
                                </span>

                                <br />
                                <span class="line-height-1 smaller-90"> tweet </span>
                            </span>

                        </a>
                        <?php 
                            if($user->getStatus() == 1):
                        ?>
                        <span class="btn btn-app btn-sm btn-success no-hover" id="disableUser" 
                            data-user="<?php echo $user->getId() ?>">
                            <span class="line-height-1 bigger-170"> 
                                <i class="ace-icon fa fa-trash-o"></i>
                            </span>
                            <br />
                            <span class="line-height-1 smaller-90"> Vô hiệu hoá </span>
                        </span>
                        <?php 
                            elseif($user->getStatus() == 0):
                        ?>
                        <span class="btn btn-app btn-sm btn-success no-hover" id="enableUser" 
                            data-user="<?php echo $user->getId() ?>">
                        <span class="line-height-1 bigger-170"> 
                            <i class="ace-icon fa fa-trash-o"></i>
                        </span>
                            <br />
                        <span class="line-height-1 smaller-90"> khôi phục </span>
                        </span>
                        <?php 
                            endif;
                        ?>

                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170"> 55 </span>

                            <br />
                            <span class="line-height-1 smaller-90"> Contacts </span>
                        </span>
                    </div>
                    <div class="space-12"></div>
                        <div class="profile-user-info profile-user-info-striped">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Username </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="username">
                                        <?php echo $user->getUsername() ?>
                                    </span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Screen name </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="age">
                                        <?php echo $user->getScreenName() ?>
                                    </span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Location </div>

                                <div class="profile-info-value">
                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                    <span class="editable" id="country">
                                        <?php echo $user->getCountry() ?>
                                    </span>
                                </div>
                            </div>


                            <div class="profile-info-row">
                                <div class="profile-info-name"> Joined </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="signup">2010/06/20</span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Bio </div>

                                <div class="profile-info-value">
                                    <span class="editable" id="about">
                                        <?php echo $user->getBio() ?>
                                    </span>
                                </div>
                            </div>
					    </div>
                        <div class="space-20"></div>
                        <div class="widget-box transparent">
                            <div class="widget-header widget-header-small">
                                <h4 class="widget-title blue smaller">
                                    <i class="ace-icon fa fa-rss orange"></i>
                                    Hoạt động gần đây
                                </h4>

                                <div class="widget-toolbar action-buttons">
                                    <a href="#" data-action="reload">
                                        <i class="ace-icon fa fa-refresh blue"></i>
                                    </a>
                                    &nbsp;
                                    <a href="#" class="pink">
                                        <i class="ace-icon fa fa-trash-o"></i>
                                    </a>
                                </div>
							</div>
                            <div class="widget-body">
                                <div class="widget-main padding-8">
                                    <div id="profile-feed-1" class="profile-feed">
                                        <div class="profile-activity clearfix">
                                            <div>
                                                <img class="pull-left" alt="Alex Doe's avatar" 
                                                src="<?php echo BASE_URL.$user->getProfileImage() ?>" />
                                                <a class="user" href="#"> Alex Doe </a>
                                                changed his profile photo.
                                                <a href="#">Take a look</a>

                                                <div class="time">
                                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                    an hour ago
                                                </div>
                                            </div>

                                            <div class="tools action-buttons">
                                                <a href="#" class="blue">
                                                    <i class="ace-icon fa fa-pencil bigger-125"></i>
                                                </a>

                                                <a href="#" class="red">
                                                    <i class="ace-icon fa fa-times bigger-125"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="showPopup"></div>
                </div>
            </div>
        </div>
    </div>
</div>