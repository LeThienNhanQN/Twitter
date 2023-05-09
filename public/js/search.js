$(function(){
    $('.search').keyup(function () {
        var search = $(this).val();
        //jQuery.post( url [, data ] [, success ] [, dataType ] )
        $.post('http://localhost/twitter/model/ajax/search.php', {search:search}, function(data){
            $('.search-result').html(data);
            if(search == ""){
                $('.search-result').html("");
                $('.search-result li').click(function(){
                    $('.search-result li').hide();
                });
            }
        });
    });
    $(document).on('keyup', '.search-user', function(){
        $('.message-recent').hide();
        var search = $(this).val();

        $.post("http://localhost/twitter/model/ajax/searchUserMsg.php", {search:search}, function(data){
            $('.message-body').html(data);
        });
    });
});