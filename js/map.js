$( document ).ready(function() {
	$(".search__map").toggle();
	$(".btn__change__view").click((e) => {
		if($(".btn__change__view").val() === "View default search"){
			$(".btn__change__view").val("View on map");
			$(".search").toggle();
			$(".search__map").toggle();
		}
		else if($(".btn__change__view").val() === "View on map"){
			$(".btn__change__view").val("View default search");
			$(".search").toggle();
			$(".search__map").toggle();
		}

		let search = $(".btn__change__view--value").val();

		//Mapbox - map visualisatie
		mapboxgl.accessToken = 'pk.eyJ1IjoicjA3MDI0NjUiLCJhIjoiY2p2NnNodnYwMDNydzRkbHZ0bnM0aTQ3aCJ9.aoZTpRItL6OIKxqjC38EWg';
		var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [51.0, 4.4]
		});
	

		$.ajax({
			method: "GET",
			url: "ajax/map.php",
			data: {"search": search}, datatype: 'json'
		})
		.done(function(res) {
			if(res.status = "success"){
				let result = (JSON.parse(res));
				//Only give result not the status.
				result = result.result;
				let amountOfResults = Object.keys(result).length;

				for(let i = 0; i < amountOfResults; i++){
					console.log(result[i]);
					//columns of table posts are: id, user_id, image, filter, desc, lat, long, city, timestamp, active

					var popup = new mapboxgl.Popup({closeOnClick: false})
					.setHTML(
						`<a class="post__full" href="?image=${result[i][0]}">
							<div class="searchPost">
								<img class="post__img" src="${result[i][2]}">
								<p class="post__name">${result[i][4]}</p>
							</div>
						</a>`
					)
			
					new mapboxgl.Marker()
						.setLngLat([result[i][6], result[i][5]])
						.setPopup(popup)
						.addTo(map); 
				}
			}
		});
	
		e.preventDefault();
	});
})