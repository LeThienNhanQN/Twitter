$(function(){

    $(document).on('click', '#enableTweet', function(){

        var tweetId = $(this).data('tweet');

        $.post('http://localhost/twitter/model/ajax/handleTweet/EnableTweet.php', {showPopup:tweetId}, function(data){
            $('.showPopup').html(data);
            $('.cancel-it').click(function(){
                $('.user-popup').hide();
            });
    
            $('.close-user-popup').click(function(){
                $('.user-popup').hide();
            });
        });
    });

    $(document).on('click', '.enable-it', function(){
        var tweetId = $(this).data('tweet');
        $.post('http://localhost/twitter/model/ajax/handleTweet/EnableTweet.php', {enable:tweetId}, function(data){
            $('.user-popup').hide();
            window.location = window.location.href;
        });
    });
});