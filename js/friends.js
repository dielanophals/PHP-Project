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
                $('.addfriend').toggleClass("hide");
                $('.removefriend').toggleClass("hide");
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
                $('.removefriend').toggleClass("hide");
                $('.addfriend').toggleClass("hide");
            }
        });
        e.preventDefault();

    });
});
