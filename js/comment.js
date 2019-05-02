$(document).ready(() => {
    $("#btnSubmit").on("click", function(e){
        var text = $("#comment").val();
        console.log("test");
        
        $.ajax({
            method: "POST",
            url: "ajax/save_comment.php",
            data: { text: text },
            dataType: 'json'
        })
        .done(function( response ) {
            if( response.status == "success" ){
                // = "<li>" + text + "</li>"
                var li = "<li style='display:none;'>" + text + "</li>";
                $("#listupdates").append(li);
                $("#comment").val("").focus();
                //animatie
                $("#listupdates li").last().slideDown();
            }
        });
        
        
        e.preventDefault();
    });
});