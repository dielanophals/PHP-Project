$(document).ready(function(){
    navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;

        $.ajax({
            url: 'ajax/location.php',
            type: 'POST',
            dataType: 'html',
            data: {
                'lat': lat,
                'long': long
            },
            success: function (data) {
                console.log(data)
            }
        });
    });
});
