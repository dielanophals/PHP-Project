$(document).ready(() => {
    $(".loadmore").click(function(e) {
        let lastPostId = $(".grid div:last").attr("id");
        $(".loadmore").html("Loading...");
        
        $.ajax({
            method: "POST",
            url: "ajax/friendsPosts.php",
            data: {"lastId": lastPostId}, datatype: 'json'
        })
        .done(function(res) {
            if(res.status = "success"){
                let list = JSON.parse(res);

                for(let i = 0; i <= 20; i++){
                    if(typeof list.message[i] !== "undefined"){
                        var div = `<div id=${list.message[i][0]} class="post"><img class="post__img" src="${list.message[i][1]}"></div>`;
                        $(".grid").append(div);
                    }
                }
            }
        });

        e.preventDefault();
    });
});