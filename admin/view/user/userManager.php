<?php

    $pageId = filter_input(INPUT_GET, 'pageid');

    $total = 8;
    $maxPageId = 0;

    $countRow = $userDAO->countRow();

    if(($countRow / $total) % 2 == 0) {
        if(($countRow % $total) == 0) {
            $maxPageId = $countRow / $total;
        }else {
            $maxPageId = ($countRow / $total) + 1;
        }
    }else if(($countRow / $total) % 2 != 0){
        if(($countRow % $total) == 0) {
            $maxPageId = ($countRow / $total);
        }else {
            $maxPageId = floor(($countRow / $total) + 1);
        }	
    }

    if ($pageId == 1) {

    } else {
        $pageId = $pageId - 1;
        $pageId = $pageId * $total + 1;
    }

    $users = $userDAO->userPagination($pageId, $total);

?>
<div class="row">
    <div class="col-xs-12">
        <div class="row">
        <form action="." id="formSubmit" method="get">
            <?php 
                foreach($users as $user):
                    $countTweet = $tweetDAO->countTweetByUserId($user->getId());
                    $countLike = $tweetDAO->countLikeByUserId($user->getId());
            ?>
            <div class="col-xs-6 col-sm-3 pricing-box">
                 <div class="widget-box widget-color-dark">
                    <div class="widget-header">
                        <h5 class="widget-title bigger lighter"><?php echo $user->getUsername() ?></h5>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <ul class="list-unstyled spaced2">
                                <li>
                                    <i class="ace-icon fa fa-check green"></i>
                                    <?php echo $user->getUsername() ?>
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-times green"></i>
                                    <?php echo $user->getScreenName() ?>
                                </li>
                                <li>
                                    <i class="ace-icon fa fa-check green"></i>
                                    <?php echo $user->getFollowing() ?> following
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-check green"></i>
                                    <?php echo $user->getFollower() ?> follower
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-check green"></i>
                                    <?php echo  $countTweet ?> tweet
                                </li>

                                <li>
                                    <i class="ace-icon fa fa-check green"></i>
                                    <?php echo $countLike ?> like
                                </li>

                            </ul>
                        </div>

                        <div>
                            <a href="?c=editUser&userId=<?php echo $user->getId() ?>" 
                            class="btn btn-block btn-inverse">
                                <span>Chỉnh sửa</span>
                            </a>
                        </div>
                    </div>
				</div>
            </div>
            <?php 
                endforeach;
            ?>

            <div class = "s-paging">
                 <ul class="pagination" id="pagination">
                    <?php 
                            if($pageId == 1):
                        ?>
                        <li class="page-item" disabled><a class="page-link" href="#" disabled>Previous</a></li>
                        <li class="page-item">
                            <a class="page-link" 
                                href=".?c=listUser&pageid=<?php echo $pageId + 1 ?>">
                            Next
                            </a>
                        </li>
                        <?php 
                            elseif($pageId == $maxPageId):
                        ?>
                        <li class="page-item">
                            <a class="page-link" 
                                href=".?c=listUser&pageid=<?php echo $pageId - 1 ?>">
                            Previous
                            </a>
                        </li>
                        <li class="page-item" disabled>
                            <a class="page-link" 
                                href="#" disabled>
                                Next
                            </a>
                        </li>

                        <?php 
                            elseif($pageId < $maxPageId && $pageId > 1):
                        ?>
                        <li class="page-item">
                            <a class="page-link" 
                                href=".?c=listUser&pageid=<?php echo $pageId - 1 ?>">
                            Previous
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" 
                                href=".?c=listUser&pageid=<?php echo $pageId + 1 ?>">
                            Next
                            </a>
                        </li>
                        <?php 
                            endif;
                        ?>
                </ul>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var totalPages = ${model.totalPage};
    <!-- trang hiện tại -->
    var currentPage = ${model.page};
    var limit = 2;
    $(function () {
        window.pagObj = $('#pagination').twbsPagination({
            totalPages: totalPages,
            visiblePages: 10,
            startPage: currentPage,
            onPageClick: function (event, page) {
                if (currentPage != page) {
                    $('#maxPageItem').val(limit);
                    $('#page').val(page);
                    $('#formSubmit').submit();
                }
            }
        });
    });
</script>