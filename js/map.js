$( document ).ready(function() {
    var markers = Array();

	//Mapbox - map visualisatie
	mapboxgl.accessToken = 'pk.eyJ1IjoicjA3MDI0NjUiLCJhIjoiY2p2NnNodnYwMDNydzRkbHZ0bnM0aTQ3aCJ9.aoZTpRItL6OIKxqjC38EWg';
	var map = new mapboxgl.Map({
		container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
		center: [51.0, 4.4]
	});
    
    /*
        Get posts by search and place them with a marker on the map.
        The marker is placed based on longitude and latitude.
        When you click on a marker, a popup is shown of the image.
        When you click on an image, you see the details of te post.
    */

    /*
	$.ajax({
		method: "GET",
		url: "ajax/imageMap.php",
		data: {"searchBy": searchBy}, datatype: 'json'
	})
	.done(function(res) {
		if(res.status = "success"){
			//When ajax is succesful select all images on the map using a marker and popup and extra popup
            markers.foreach(function(marker)){
                var popup = new mapboxgl.Popup({closeOnClick: false})
                .setHTML(
                    //Change href due to missing db information
                    //Change source of image
                    //Change description (p)
                    //Change timeago (p)
                    '<a class="post__full" href="?image="2">' +
                        '<div class="searchPost">' +
                            '<img class="post__img" src="https://placeimg.com/200/200/any">' +
                            '<p class="post__name">Test</p>' +
                            '<p class="timeAgo"></p>' +
                        '</div>' +
                    '</a>'
                )
        
                new mapboxgl.Marker()
                    .setLngLat([30.5, 50.5])
                    .setPopup(popup)
                    .addTo(map); 
            }
        }
	});

	e.preventDefault();*/

    //Delete code below due to being implemented in foreach loop
	var popup = new mapboxgl.Popup({closeOnClick: false})
		.setHTML(
			'<a class="post__full" href="search.php?search=dog&map=true&image=2>' +
				'<div class="searchPost">' +
					'<img class="post__img" src="https://placeimg.com/200/200/any">' +
					'<p class="post__name">Test</p>' +
					'<p class="timeAgo"></p>' +
				'</div>' +
			'</a>'
		)
	
	new mapboxgl.Marker()
	  .setLngLat([50.5, 30.5])
	  .setPopup(popup)
	  .addTo(map); 

	var popup1 = new mapboxgl.Popup({closeOnClick: false})
	.setHTML(
		'<a class="post__full" href="?image="2">' +
			'<div class="searchPost">' +
				'<img class="post__img" src="https://placeimg.com/200/200/any">' +
				'<p class="post__name">Test</p>' +
				'<p class="timeAgo"></p>' +
			'</div>' +
		'</a>'
	)
  
	new mapboxgl.Marker()
		.setLngLat([30.5, 50.5])
		.setPopup(popup1)
		.addTo(map); 
});