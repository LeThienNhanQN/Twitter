<?php 
	//$tweets = $tweetDAO->findAll();
	$pageId = filter_input(INPUT_GET, 'pageid');

	$total = 10;
	$maxPageId = 0;

	$countRow = $tweetDAO->countRow();

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
			$maxPageId = ($countRow / $total) + 1;
		}	
	}

	if ($pageId == 1) {

	} else {
		$pageId = $pageId - 1;
		$pageId = $pageId * $total + 1;
	}
	$tweets = $tweetDAO->tweetPagination($pageId, $total);
?>

<div>
     <div class = "row search-page" id="search-page-1">
        <div class="col-xs-12">
            <div class="row">
					<div class="col-xs-12 col-sm-3">
						<div class="search-area well well-sm">

							<div class="search-filter-header bg-primary">
								<h5 class="smaller no-margin-bottom">
									<i class="ace-icon fa fa-sliders light-green bigger-130">
									</i>&nbsp; Tìm Kiếm
								</h5>
							</div>
							<div class="space-10"></div>

							<form>
								<div class="row">
									<div class="col-xs-12 col-sm-11 col-md-10">
										<div class="input-group">
											<input type="text" class="form-control" name="keywords" placeholder="Look within results" />
											<div class="input-group-btn">
												<button type="button" class="btn btn-default no-border btn-sm">
													<i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>

							<div class="hr hr-dotted"></div>

							<h4 class="blue smaller">
								<i class="fa fa-tags"></i>
								Category
							</h4>


						</div>
					</div>

					<div class="col-xs-12 col-sm-9">
						<div class="row">
							<div class="search-area well col-xs-12">
								<div class="pull-left">
									<b class="text-primary">Hiển Thị</b>

									&nbsp;
									<div id="toggle-result-format" class="btn-group btn-overlap" data-toggle="buttons">
										<label title="Thumbnail view" class="btn btn-lg btn-white btn-success active" data-class="btn-success" aria-pressed="true">
											<input type="radio" value="2" autocomplete="off" />
											<i class="icon-only ace-icon fa fa-th"></i>
										</label>

										<label title="List view" class="btn btn-lg btn-white btn-grey" data-class="btn-primary">
											<input type="radio" value="1" checked="" autocomplete="off" />
											<i class="icon-only ace-icon fa fa-list"></i>
										</label>

										<label title="Map view" class="btn btn-lg btn-white btn-grey" data-class="btn-warning">
											<input type="radio" value="3" autocomplete="off" />
											<i class="icon-only ace-icon fa fa-crosshairs"></i>
										</label>
									</div>
								</div>

								<div class="pull-right">
									<b class="text-primary">Sắp Xếp</b>

									&nbsp;
									<select>
										<option>Relevance</option>
										<option>Newest First</option>
										<option>Rating</option>
									</select>
								</div>
							</div>
						</div>

						<div class="space-12"></div>
						<div class="row">
							<div class="col-xs-12">
								<?php 
									foreach($tweets as $tweet):
										$user = $userDAO->findById($tweet->getUserId());
								?>
								<div class="media search-media">
									<div class="media-left">
										<a href="<?php echo BASE_URL.'profile/'.$user->getUsername() ?>">
											<img class="media-object" src="<?php echo BASE_URL.$user->getProfileImage() ?>" />
										</a>
									</div>

									<div class="media-body">
										<div>
											<h4 class="media-heading">
												<a href="<?php echo BASE_URL.'profile/'.$user->getUsername() ?>"
												 class="blue"><?php echo $user->getScreenName() ?></a>
											</h4>
										</div>
										<p>
											<?php
												if($tweet->getStatus() != ''){
													echo $tweetService->getTweetLink($tweet->getStatus());
												}
											?>
										</p>
										<?php 
											if($tweet->getTweetImage() != ''):
										?>	
										<img src="<?php echo BASE_URL.$tweet->getTweetImage() ?>" alt="">
										<?php 
											endif;
										?>
										<div class="search-actions text-center">
											
											<?php 
												if($tweet->getCheckStatus() == 1):
											?>
											<a class="search-btn-action btn btn-sm btn-block btn-info"
												data-tweet = <?php echo $tweet->getId() ?> id = "disableTweet">
												Vô hiệu hoá!
											</a>

											<?php 
												else:
											?>
											<a class="search-btn-action btn btn-sm btn-block btn-info"
											data-tweet = <?php echo $tweet->getId() ?> id = "enableTweet">
												Khôi phục!
											</a>
											<?php 
												endif;
											?>
										</div>
									</div>
								</div>

								<?php 
									endforeach;
								?>
								<div class = "s-paging">
									<ul class="pagination">
										<?php 
											if($pageId == 1):
										?>
										<li class="page-item" disabled><a class="page-link" href="#" disabled>Previous</a></li>
										<li class="page-item">
											<a class="page-link" 
												href=".?c=listTweet&pageid=<?php echo $pageId + 1 ?>">
											Next
											</a>
										</li>
										<?php 
											elseif($pageId == $maxPageId):
										?>
										<li class="page-item">
											<a class="page-link" 
												href=".?c=listTweet&pageid=<?php echo $pageId - 1 ?>">
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
												href=".?c=listTweet&pageid=<?php echo $pageId - 1 ?>">
											Previous
											</a>
										</li>
										<li class="page-item">
											<a class="page-link" 
												href=".?c=listTweet&pageid=<?php echo $pageId + 1 ?>">
											Next
											</a>
										</li>
										<?php 
											endif;
										?>
									</ul>
								</div>
								
							</div>
						</div>
					</div>
					<div class="showPopup"></div>
            </div>
        </div>
     </div>
</div>