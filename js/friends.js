$(document).ready(function(){
    $('.addfriend').click(function(e){
      let friend = $(this).data('friend');

        $.ajax({
            url: 'ajax/addfriend.php',
            type: 'POST',
            dataType: 'html',
            data: {
                'friend': friend,
            },
            success: function (data) {
                $('.addfriend').html("Unfollow");
                $('.addfriend').addClass("removefriend");
                $('.addfriend').removeClass("addfriend");
            }
        });
        e.preventDefault();

    });

    $('.removefriend').click(function(e){
      let friend = $(this).data('friend');

        $.ajax({
            url: 'ajax/removefriend.php',
            type: 'POST',
            dataType: 'html',
            data: {
                'friend': friend,
            },
            success: function (data) {
                $('.removefriend').html("Follow");
                $('.removefriend').addClass("addfriend");
                $('.removefriend').removeClass("removefriend");
            }
        });
        e.preventDefault();

    });
});
