$( document ).ready(function() {
	$(".search__map").toggle();
	$(".btn__change__view").click((e) => {
		console.log("klik");
		if($(".btn__change__view").val() === "View on map"){
			$(".search").toggle();
			$(".search__map").toggle();
			$(".btn__change__view").val("View default search");
			$(".btn__change__view").text("View default search");
		}
		else{
			$(".search").toggle();
			$(".search__map").toggle();
			$(".btn__change__view").val("View on map");
			$(".btn__change__view").text("View on map");
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
	});

	e.preventDefault();

	var popup = new mapboxgl.Popup({closeOnClick: false})
		.setText('Construction on the Washington Monument began in 1848.');
	
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