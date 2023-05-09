$(function(){
    $(document).on('click', '#postComment', function(){
        var comment = $('#commentField').val();
        var tweetId = $('#commentField').data('tweet');
        var userId = $('#commentField').data('user');

        if(comment != ""){
            $.post('http://localhost/twitter/model/ajax/comment.php', 
            {comment:comment, tweetId:tweetId, userId:userId}, function(data){
                $('#comment').html(data);
                $('#commentField').val("");
            });
        }
    });
});     