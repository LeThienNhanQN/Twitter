$(function(){
    $(document).on('click', '#enableUser', function(){
        var userId = $(this).data('user');

        $.post('http://localhost/twitter/model/ajax/handleUser/enableUser.php', {showPopup:userId}, function(data){
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
        var userId = $(this).data('user');
        $.post('http://localhost/twitter/model/ajax/handleUser/enableUser.php', {enable:userId}, function(data){
            $('.user-popup').hide();
            window.location = window.location.href;
        });
    });
});