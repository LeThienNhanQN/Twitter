$(function(){

    $(document).on('click', '.deleteTweet', function(){
        var tweetId = $(this).data('tweet');
        var userId = $(this).data('user');

        $.post('http://localhost/twitter/model/ajax/deleteTweet.php', {showPopup:tweetId, userId:userId}, 
        function(data){
            $('.popupTweet').html(data);
            $('.close-retweet-popup,.cancel-it').click(function(){
				$('.retweet-popup').hide();
			});
        });
    })

    $(document).on('click', '.delete-it', function(){
        var tweetId = $(this).data('tweet');
        var userId = $(this).data('user');

        $.post('http://localhost/twitter/model/ajax/deleteTweet.php', {delete:tweetId, userId:userId}, 
        function(data){
            $('.retweet-popup').hide();
            console.log(data);
            window.location = window.location.href;
        });
    })

    $(document).on('click', '.deleteComment', function(){
        var tweetId = $(this).data('tweet');
        var commentId = $(this).data('id');

        $.post('http://localhost/twitter/model/ajax/deleteComment.php', {tweetId:tweetId, commentId:commentId});
        $.post('http://localhost/twitter/model/ajax/popuptweet.php', {showPopup:tweetId}, function(data){
            $('.popupTweet').html(data);
            $('.tweet-show-popup-box-cut').click(function(){
                $('.tweet-show-popup-wrap').hide();
            });
        });
    });
});