$(function(){
    $(document).on('click', '.addTweetBtn', function(){

        $('.status').removeClass().addClass('status-removed');
		$('.hash-box').removeClass().addClass('hash-removed');
        $('#count').attr('id', 'count-removed');
        
        $.post('http://localhost/twitter/model/ajax/tweetForm.php', function(data){
			$('.popupTweet').html(data);
			$('.closeTweetPopup').click(function(){
				$('.popup-tweet-wrap').hide();
				$('.status-removed').removeClass().addClass('status');
				$('.hash-removed').removeClass().addClass('hash-box');
				$('#count-removed').attr('id', 'count');
			});
		});
    });

    $(document).on('submit', '#popupForm', function(e){
        //ngăn trình duyệt chuyển tiếp người dùng tới trang đích của liên kết
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        //append cho phép chèn 1 cặp key=>value vào formdata
        formData.append('file', $('#file')[0].files[0]);
        formData.append('action', $('#action'));

        $.ajax({
            url: "http://localhost/twitter/model/ajax/saveTweet.php",
            type: "POST",
            data: formData,
            success: function(data){
                //parse json
                console.log(data);
                result = JSON.parse(data);
				if(result['error']){
					$('<div class="error-banner"><div class="error-banner-inner"><p id="errorMsg">'+result.error+'</p></div></div>').insertBefore('.header-wrapper');
					$('.error-banner').hide().slideDown(300).delay(5000).slideUp(300);
					$('.popup-tweet-wrap').hide();
				}else if (result['success']){
					$('<div class="error-banner"><div class="error-banner-inner"><p id="errorMsg">'+result.success+'</p></div></div>').insertBefore('.header-wrapper');
					$('.error-banner').hide().slideDown(300).delay(5000).slideUp(300);
					$('.popup-tweet-wrap').hide();
				}
            },
            cache: false,
			contentType: false,
			processData: false
        });
    });
});