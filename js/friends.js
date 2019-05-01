$(document).ready(function(){
    $('.addfriend').click(function(){
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
            }
        });
        e.preventDefault();

    });
});
