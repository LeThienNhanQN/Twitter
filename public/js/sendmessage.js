$(function(){
    $(document).on('click', '#send', function(data){
        var message = $('#msg').val();
        var messageTo = $(this).data('user');

        $.post('http://localhost/twitter/model/ajax/message.php', 
            {sendMessage:message,messageTo:messageTo}, function(data){
            //getMessages();
            $('#msg').val('');
        });
    });

});