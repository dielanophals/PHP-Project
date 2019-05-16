$(document).ready(function(){
    $( ".container_post" ).on( "click", ".save", function(e) {
        if($(this).text() != "Saved!"){
            let save = $(this).data('save');
            $(this).text("Saved!");
            $.ajax({
                url: 'ajax/save.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    'save': save
                },
                success: function (data) {
                    console.log(data)
                }
            });
        }
        e.preventDefault();
    });

});
