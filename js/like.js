$(document).ready(() => {
    $('.like').click( function () {
        let postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: 'ajax/likes.php',
            method: 'POST',
            data: {
                'liked': 1,
                'postid': postid
            },
            success: function(response){
                $post.parent().find('span.likes-count').text(response + " likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });

    $('.unlike').click( function () {
        let postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: 'ajax/likes.php',
            method: 'POST',
            data: {
                'unliked': 1,
                'postid': postid
            },
            success: function(response){
                $post.parent().find('span.likes-count').text(response + " likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });
});