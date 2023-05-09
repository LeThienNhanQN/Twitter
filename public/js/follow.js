$(function(){

    $('.follow-btn').click(function(){
        var userSendFollow = $(this).data('follow');
        var userReceiverFollow = $(this).data('profile');
        var button = $(this);
        //check button has a class named
        //unfollow
        if(button.hasClass('following-btn')){
            $.post('http://localhost/twitter/model/ajax/follow.php', 
                {
                  unfollow:userSendFollow, 
                  userReceiverFollow:userReceiverFollow
                }, 
                function(data){
                result = JSON.parse(data);
                console.log(data);
                button.removeClass('following-btn');
                button.removeClass('unfollow-btn');
                button.html('<i class="fa fa-user-plus"></i>Follow');
                //$('.count-following').text(result['following']);
                $('.count-followers').text(result.follower);
            });
        }else{ 
            //follow
            $.post('http://localhost/twitter/model/ajax/follow.php', 
            { 
              follow:userSendFollow,
              userReceiverFollow:userReceiverFollow
            }, function(data){
                result = JSON.parse(data);
                console.log(data);
                button.removeClass('follow-btn');
                button.removeClass('following-btn');
                button.text('Following');
                //$('.count-following').text(result['following']);
                $('.count-followers').text(result.follower);
            });
        }
    });
    $('.follow-btn').hover(function(){
        $button = $(this);
    
        if($button.hasClass('following-btn')) {
          $button.addClass('unfollow-btn');
          $button.text('Unfollow');
        }
      }, function(){
        if($button.hasClass('following-btn')) {
          $button.removeClass('unfollow-btn');
          $button.text('Following');
        }
      });
});