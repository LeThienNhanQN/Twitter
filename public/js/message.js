$(function(){

    //show popup message
    $(document).on('click', '#messagePopup', function(){
        var getMessage = 1;
        $.post('http://localhost/twitter/model/ajax/message.php', {showMessage:getMessage}, function(data){
            $('.popupTweet').html(data);
            $('#messages').hide();
        });
    });
    

    //show message 
    $(document).on('click', '.people-message', function(){
        var userId = $(this).data('user');

        $.post('http://localhost/twitter/model/ajax/message.php', {showChatPopup:userId}, function(data){
            $('.popupTweet').html(data);

            if(autoscroll){
                scrollDown();
            }
            $('#chat').on('scroll', function(){
                if($(this).scrollTop() < this.scrollHeight - $(this).height()){
                    autoscroll = false;
                }else{
                    autoscroll = true;
                }
            });
            $('.close-msgPopup').click(function(){
                clearInterval(timer);
             });
        });

        //
        getMessages = function(){
            $.post('http://localhost/twitter/model/ajax/message.php', {showChatMessage:userId}, function(data){
                $('.main-msg-inner').html(data);

                // nếu scroll ở trên cùng =>  auto scroll == true
                //chạy scroll tới tin nhắn cuối cùng
                if(autoscroll){
                    scrollDown();
                }
                $('#chat').on('scroll', function(){
                    //nếu thanh scroll ở cuối cùng
                    //set autoscroll = false
                    if($(this).scrollTop() < this.scrollHeight - $(this).height()){
                        autoscroll = false;
                    }else{
                        autoscroll = true;
                    }
                });
                //exit msg popup
                $('.close-msgPopup').click(function(){
                    clearInterval(timer);
                 });
            });
        }
        var timer = setInterval(getMessages, 5000);
        getMessages();

        autoscroll = true;
        scrollDown = function(){

            //lấy vị trí hiên tại theo chiều dọc của thanh cuộn
            //hiển thị thanh scroll ở tin nhắn cuối cùng
            $('#chat').scrollTop($('#chat')[0].scrollHeight);
        }
        
        //back to home frame
        $(document).on('click', '.back-messages', function(){
			var getMessages = 1;
			$.post('http://localhost/twitter/model/ajax/message.php', {showMessage:getMessages}, function(data){
				$('.popupTweet').html(data);
				clearInterval(timer);
			});	
        });

        //hide message
        $(document).on('click', '.deleteMsg', function(){
            var messageId = $(this).data('message');
            var messageFrom = $(this).data('user');
            $('.message-del-inner').height('200px');
            $(document).on('click', '.cancel', function(){
                $('.message-del-inner').height('0px');
            });
            console.log(messageFrom);
            $(document).on('click', '.delete', function(){
                $.post("http://localhost/twitter/model/ajax/message.php", 
                {hideMessage:messageId, messageFrom:messageFrom}, function(data){
                    $('.message-del-inner').height('0px');
                    getMessages();
                });
            });
        });
    });
});