$(document).ready(function(){
    // when the user clicks on like
    $('.like').on('click', function(){
        var postid = $(this).data('id');
            $post = $(this);

        $.ajax({
            url: 'ajax/index.php',
            method: 'POST',
            data: {
                'liked': 1,
                'postid': postid
            },
            success: function(response){
                $post.parent().find('span.likes_count').text(response + " likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });

    // when the user clicks on unlike
    $('.unlike').on('click', function(){
        var postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: 'ajax/index.php',
            method: 'POST',
            data: {
                'unliked': 1,
                'postid': postid
            },
            success: function(response){
                $post.parent().find('span.likes_count').text(response + " likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });
});