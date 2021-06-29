$(function(){
	//start when click button share
    $(document).on('click','.retweet', function(){
		var tweet_id    = $(this).data('tweet');
		var user_id     = $(this).data('user');
	    $counter        = $(this).find('.retweetCount');
	    $count          = $counter.text();
	    $button         = $(this);

		$.post('http://localhost/twitter/model/ajax/retweet.php', 
		{showPopup:tweet_id,user_id:user_id}, function(data){
			$('.popupTweet').html(data);
			$('.close-retweet-popup').click(function(){
				$('.retweet-popup').hide();
			})
		});
	});

	//start when click button retweet
	$(document).on('click', '.retweet-it', function(){
		var comment = $('.retweetMsg').val();
		var tweet_id    = $(this).data('tweet');
		var user_id     = $(this).data('user');

		$.post('http://localhost/twitter/model/ajax/retweet.php', 
			{retweet:tweet_id,user_id:user_id, comment:comment}, function(data){
				$('.retweet-popup').hide();
				$count++;
				$counter.text($count);
				$button.prop('title', 'Đã chia sẻ');
				$button.removeClass('retweet').addClass('retweeted');
		});
	});
	
});