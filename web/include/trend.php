<?php
     $trends = $trendService->statisticTweetUseHashtag();
?>

<div class="trend-wrapper">
    <div class="trend-inner">
        <div class="trend-title">
            <h3>Trend for you</h3>
        </div>
        <?php 
            if(!empty($trends))
            foreach($trends as $trend):
        ?>
        <div class="trend-body">
            <div class="trend-body-content">
                <div class="trend-link">
                    <a href="<?php echo BASE_URL.'hashtag/'.$trend->getHashtag(); ?>">
                        <?php echo $trend->getHashtag(); ?>
                    </a>
                </div>
                <div class="trend-tweets">
                    <?php echo $trend->getTweetCount() ?><span> tweets</span>
                </div>
            </div>
		</div>
        <?php
            endforeach;
        ?>
    </div>
</div>