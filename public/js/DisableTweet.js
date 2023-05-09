$(function(){
    $(document).on('click', '#disableTweet', function(){
        var tweetId = $(this).data('tweet');

        $.post('http://localhost/twitter/model/ajax/handleTweet/DisableTweet.php', {showPopup:tweetId}, function(data){
            $('.showPopup').html(data);
            $('.cancel-it').click(function(){
                $('.user-popup').hide();
            });

            $('.close-user-popup').click(function(){
                $('.user-popup').hide();
            });
        });
    });

    $(document).on('click', '.delete-it', function(){

        var tweetId = $(this).data('tweet');

        $.post('http://localhost/twitter/model/ajax/handleTweet/DisableTweet.php', {disable:tweetId}, function(data){
            $('.user-popup').hide();
            window.location = window.location.href;
        })
    });
});