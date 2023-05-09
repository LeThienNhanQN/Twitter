notification = function(){

    $.get('http://localhost/twitter/model/ajax/notification.php', {showNotification:true}, function(data){
        if(data){
            if(data.notification > 0){
                $('#notification').addClass('span-i');
                $('#notification').html(data.notification);
                $('notification').show();
            }
            if(data.messages > 0){
                $('#messages').addClass('span-i');
                $('#messages').html(data.messages);
                $('#messages').show();
            }
        }
    }, 'json');
}

setInterval(notification, 10000);