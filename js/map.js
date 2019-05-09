$( document ).ready(function() {
	//Change it with ajax, due to refresh it blocks each other
	$(".btn__change__view").click((e) => {
		if($(".btn__change__view").val() === "View on map"){
			$(".search").toggle();
			$(".search__map").toggle();
		}
		else if($(".btn__change__view").val() === "View default search"){
			$(".search").toggle();
			$(".search__map").toggle();
		}
	});

	//Mapbox - map visualisatie
	mapboxgl.accessToken = 'pk.eyJ1IjoicjA3MDI0NjUiLCJhIjoiY2p2NnNodnYwMDNydzRkbHZ0bnM0aTQ3aCJ9.aoZTpRItL6OIKxqjC38EWg';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: [51.0, 4.4]
	});
	
	//Ajax call om of alle posts te laten zien o.b.v. search, laat leeg en het toont alle posts
	//Show it on the map without refresh
	/*
	$.ajax({
		method: "GET",
		url: "ajax/imageMap.php",
		data: {"searchBy": searchBy}, datatype: 'json'
	})
	.done(function(res) {
		if(res.status = "success"){
			//Maak o.b.v. de locatie een marker + popup
			//Loop door alle posts
		}
	});*/

	//e.preventDefault();

	var popup = new mapboxgl.Popup({closeOnClick: false})
	/*
		<a class="post__full" href="search.php?search=<?php echo $search; ?>&image=<?php echo $s["id"]; ?>" class="post-image">
            <div class="searchPost">
        	    <img class="post__img" src="<?php echo $s["image"]; ?>">
                <p class="post__name"><?php echo $name; ?></p>
				<p class="timeAgo"><?php echo $time; ?></p>
		    </div>
        </a>
	*/

	//Popup fix
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
	  .setLngLat([50.5, 30.5])
	  .setPopup(popup)
	  .addTo(map); 

	var popup1 = new mapboxgl.Popup({closeOnClick: false})
		.setText('We have no idea.');
  
	new mapboxgl.Marker()
		.setLngLat([30.5, 50.5])
		.setPopup(popup1)
		.addTo(map); 
});