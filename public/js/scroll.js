$(function(){
	var win = $(window);
	var offset = 1;

	win.scroll(function(){
		if($(document).height() <= (win.height() + win.scrollTop())){
            offset +=3;
            console.log(offset);
			$('#loader').show();
			$.post('http://localhost/twitter/model/ajax/scrollpost.php', {scrollPost:offset}, function(data){
				$('.tweets').html(data);
				$('#loader').hide();
			});
		}
	});
});