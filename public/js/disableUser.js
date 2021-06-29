$(function(){
    $(document).on('click', '#disableUser', function(){
        var userId = $(this).data('user');

        $.post('http://localhost/twitter/model/ajax/handleUser/disableUser.php', {showPopup:userId}, function(data){
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
        var userId = $(this).data('user');
        $.post('http://localhost/twitter/model/ajax/handleUser/disableUser.php', {delete:userId}, function(data){
            $('.user-popup').hide();
            window.location = window.location.href;
        });
    });
});