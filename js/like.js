$(document).ready(() => {
    $('.like').on('click', () => {
        let postid = $('.like').data('id');
            $post = $('.like');

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

    $('.unlike').on('click', function(){
        var postid = $('.unlike').data('id');
        $post = $('.unlike');

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