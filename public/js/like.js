$(function(){
    $(document).on('click', '.like-btn', function(){
        var tweetId = $(this).data('tweet');
        var userId = $(this).data('user');
        var likeCount = $(this).find('.likeCount');
        var count = likeCount.text();
        var button = $(this);
       
        $.post("http://localhost/twitter/model/ajax/like.php", {like:tweetId, userId:userId}, function(data){
            console.log(data);
            button.addClass('unlike-btn');
            button.find('.fa-heart-o').addClass('fa-heart');
            button.find('.fa-heart').removeClass('fa-heart-o');
            button.removeClass('like-btn');
            count++;
            likeCount.text(count);
        });
        
    });
    $(document).on('click', '.unlike-btn', function(){
        var tweetId = $(this).data('tweet');
        var userId = $(this).data('user');
        var likeCount = $(this).find('.likeCount');
        var count = likeCount.text();
        var button = $(this);

        $.post("http://localhost/twitter/model/ajax/like.php", {unlike:tweetId, userId:userId}, function(data){

            button.addClass('like-btn');
            button.find('.fa-heart').addClass('fa-heart-o');
            button.find('.fa-heart-o').removeClass('fa-heart');
            button.removeClass('unlike-btn');
            count--;
            if(count == 0){
                likeCount.hide();
            }else{
                likeCount.text(count);
            }
        });
        
    });
});
