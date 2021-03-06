function setMap(circuns) {
	var map = L.map('map').setView([22.674847351188536, -101.77734374999999], 5);
	
	if(circuns == "Primera") {
		//primera
		var array = [2, 3, 8, 10, 14, 18, 25, 26];
	} else if(circuns == "Segunda") {
		//segunda
		var array = [1, 5, 11, 19, 22, 24, 28, 32];
	} else if(circuns == "Tercera") {
		//tercera
		var array = [4, 7, 20, 23, 27, 30, 31];
	} else if(circuns == "Cuarta") {
		//cuarta
		var array = [9, 12, 17, 21, 29];
	} else if(circuns == "Quinta") {
		//quinta
		var array = [6, 13, 15, 16];
	}
	
	L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
		maxZoom: 12,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'examples.map-20v6611k'
	}).addTo(map);

	function onEachFeature(feature, layer) {
		layer.setStyle({
			fillOpacity: 0.9, opacity: 0.8, weight: 2, color: "#432B4D", fillColor: "#3E2F52"
		});
	}
	
	var geojson = L.geoJson(GeoJson, {
		filter: function (feature, layer) {
			var indexof = array.indexOf(parseInt(feature.properties.CVE_ENT));
			
			if(indexof != -1) {
				return feature.properties.CVE_ENT;
			}
			
			return false;
		},
		onEachFeature: onEachFeature
	}).addTo(map);
	
	map.fitBounds(geojson);
}
