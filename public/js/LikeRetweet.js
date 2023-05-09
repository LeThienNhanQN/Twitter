$(function(){
    $(document).on('click', '.like-btn-retweet', function(){
        var retweetId = $(this).data('retweet');
        var userId = $(this).data('user');
        var likeCount = $(this).find('.likeCount');
        var count = likeCount.text();
        var button = $(this);
       
        $.post("http://localhost/twitter/model/ajax/LikeRetweet.php", {like:retweetId, userId:userId}, function(data){
            button.addClass('unlike-btn-retweet');
            button.find('.fa-heart-o').addClass('fa-heart');
            button.find('.fa-heart').removeClass('fa-heart-o');
            button.removeClass('like-btn-retweet');
            count++;
            likeCount.text(count);
        });
        
    });
    $(document).on('click', '.unlike-btn-retweet', function(){
        var retweetId = $(this).data('retweet');
        var userId = $(this).data('user');
        var likeCount = $(this).find('.likeCount');
        var count = likeCount.text();
        var button = $(this);

        $.post("http://localhost/twitter/model/ajax/LikeRetweet.php", {unlike:retweetId, userId:userId}, function(data){

            button.addClass('like-btn-retweet');
            button.find('.fa-heart').addClass('fa-heart-o');
            button.find('.fa-heart-o').removeClass('fa-heart');
            button.removeClass('unlike-btn-retweet');
            count--;
            if(count == 0){
                likeCount.hide();
            }else{
                likeCount.text(count);
            }
        });
        
    });
});
