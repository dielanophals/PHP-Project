mapboxgl.accessToken = 'pk.eyJ1IjoicjA3MDI0NjUiLCJhIjoiY2p2NnNodnYwMDNydzRkbHZ0bnM0aTQ3aCJ9.aoZTpRItL6OIKxqjC38EWg';
var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: [-96, 37.8],
	zoom: 3
});

var popup = new mapboxgl.Popup({closeOnClick: false})
	.setText('Construction on the Washington Monument began in 1848.');

var marker = new mapboxgl.Marker()
  .setLngLat([30.5, 50.5])
  .setPopup(popup)
  .addTo(map);