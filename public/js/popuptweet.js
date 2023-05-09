$(function(){
    $(document).on('click', '.t-show-popup', function(){
        var tweetId = $(this).data('tweet');
        $.post('http://localhost/twitter/model/ajax/popuptweet.php', {showPopup:tweetId}, function(data){
            $('.popupTweet').html(data);
            $('.tweet-show-popup-box-cut').click(function(){
                $('.tweet-show-popup-wrap').hide();
            });
        });
    });

    $(document).on('click', '.imagePopup', function(e){
        //Ngăn chặn sự lan rộng của sự kiện hiện tại tới thằng khác
        e.stopPropagation();
        var tweetId = $(this).data('tweet');
        $.post('http://localhost/twitter/model/ajax/ImagePopup.php', {showImageByTweetId:tweetId}, function(data){
            $('.popupTweet').html(data);
            $('.close-imagePopup').click(function(){
                $('.img-popup').hide();
            });
        });
    });
});