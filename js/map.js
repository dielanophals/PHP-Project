$( document ).ready(function() {
	$(".search__map").toggle();
	$(".btn__change__view").click((e) => {
		if($(".btn__change__view").html() === "View default search"){
			$(".btn__change__view").html("View on map");
			$(".search").toggle();
			$(".search__map").toggle();
		}
		else if($(".btn__change__view").html() === "View on map"){
			$(".btn__change__view").html("View default search");
			$(".search").toggle();
			$(".search__map").toggle();
		}

		/*
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
			url: "ajax/map.php",
			data: {"search": search}, datatype: 'json'
		})
		.done(function(res) {
			if(res.status = "success"){
				//When ajax is succesful select all images on the map using a marker and popup and extra popup
				/*markers.foreach(function(marker){
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
				});*/
				/*
				console.log(success);
			}
		});
	
		e.preventDefault();*/
	});
})