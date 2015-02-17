var sMarker = false;
var primera = [2, 3, 8, 10, 14, 18, 25, 26];
var segunda = [1, 5, 11, 19, 22, 24, 28, 32];
var tercera = [4, 7, 20, 23, 27, 30, 31];
var cuarta  = [9, 12, 17, 21, 29];
var quinta  = [6, 13, 15, 16];

function setMap() {
	var map = L.map('map').setView([22.674847351188536, -101.77734374999999], 5);
	
	// Disable drag and zoom handlers.
	map.dragging.disable();
	map.touchZoom.disable();
	map.doubleClickZoom.disable();
	map.scrollWheelZoom.disable();

	if (map.tap) map.tap.disable();

	L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
		maxZoom: 15,
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
			'<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="http://mapbox.com">Mapbox</a>',
		id: 'examples.map-20v6611k'
	}).addTo(map);
	
	function onEachFeature(feature, layer) {
		layer.setStyle({
			fillOpacity: 0, opacity: 0.1, weight: 1.2, color: "#432B4D", fillColor: "#3E2F52"
		});
		
		layer.on('click', function(e) {
			map.removeLayer(sMarker);
			
			sMarker = L.marker([e.latlng.lat, e.latlng.lng], { 
				icon: L.icon({ 'iconUrl': '../wp-content/themes/curul501/images/marker-morado.png' }) ,
				CVE_ENT : feature.properties.CVE_ENT, 
				NOMBRE : feature.properties.NOMBRE
			}).addTo(map);

			getPip(e.latlng.lat, e.latlng.lng);
			map.setView(new L.LatLng(e.latlng.lat, e.latlng.lng), map._zoom);
		});
	}

	/*
		myLayer.on('click', function(e) {
		    resetColors();
		    e.layer.feature.properties['old-color'] = e.layer.feature.properties['marker-color'];
		    myLayer.setGeoJSON(geoJson);
		});

	*/
	
	var geojson = L.geoJson(GeoJson, {
		onEachFeature: onEachFeature
	}).addTo(map);
}


function getPip(lat, lng) {
    var estadosLayer = L.geoJson(GeoJson);
    var resultPip 	 = leafletPip.pointInLayer([lng, lat], estadosLayer);
    
    if(resultPip.length) {
		jQuery.getJSON("../wp-content/themes/curul501/js/geojson/estado-" + resultPip[0].feature.properties.CVE_ENT + ".geojson")
		.success(function (distritosGeoJson) {
			

			var distritosLayer = L.geoJson(distritosGeoJson);
			var resultDisrtPip = leafletPip.pointInLayer([lng, lat], distritosLayer);
			var district = resultDisrtPip[0].feature.properties.DISTRITO;
			var state = parseInt(resultPip[0].feature.properties.CVE_ENT);
			
			if(resultDisrtPip.length) {
				// si el map-info ya tiene informacion lo escondo y lo vuelvo a mostrar

				var info_filling = function(){
					// si hay datos los limpia
					jQuery(".map-info-representante-proporcional").html("")
					jQuery(".map-info-representante-mayoria").html("")
					
					if(primera.indexOf(parseInt(resultPip[0].feature.properties.CVE_ENT)) != -1) {
						var circum = "Primera";
					} else if(segunda.indexOf(parseInt(resultPip[0].feature.properties.CVE_ENT)) != -1) {
						var circum = "Segunda";
					} else if(tercera.indexOf(parseInt(resultPip[0].feature.properties.CVE_ENT)) != -1) {
						var circum = "Tercera";
					} else if(cuarta.indexOf(parseInt(resultPip[0].feature.properties.CVE_ENT)) != -1) {
						var circum = "Cuarta";
					} else if(quinta.indexOf(parseInt(resultPip[0].feature.properties.CVE_ENT)) != -1) {
						var circum = "Quinta";
					} else {
						var circum = "";
					}
					
					var results = jQuery(representatives).filter(function (i, value) {
						return (value.clave_estado == state && value.circum == circum) || (value.clave_estado == state && value.district == district);
					});
					
					var html  = "<h2> REPRESENTACIÓN PROPORCIONAL </h2>";
					var html2 = "<h2> MAYORÍA RELATIVA </h2>";
					
					jQuery.each(results, function( index, value ) {
						if(value.circum == "") {
							html2 += "<div class='representante-mapa'>";
							html2 += "	<div class='rep-data'>";
							html2 += "		<img class='img-rep' src='" + value.avatar_url + "' alt='" + value.name + "'/>";
							html2 += "		<a class='name-rep' href='" + value.permalink + "' title='" + value.name + "'>" + value.name + "</a>";
							html2 += "		<span class='tipo-ele'> Tipo de elección: " + value.election_type + " </span>";
							html2 += "		<span class='zona'> Distrito: " + value.district + " </span>";
							html2 += "		<span class'estado'> Estado: " + value.zone_state + " </span>";
							html2 += "	</div>";
							html2 += "	<div class='part-data'>";
							html2 += "		<img class='img-partido' src='http://curul501.org/wp-content/themes/curul501/images/" + value.politicalParty.url_logo + "' alt='" + value.politicalParty.name + "'/>";
							html2 += "		<span class='partido'> Partido politico: " + value.politicalParty.name + " </span>";
							html2 += "	</div>";
							html2 += "</div>";
						} else {
							html += "<div class='representante-mapa'>";
							html += "	<div class='rep-data'>";
							html += "		<img class='img-rep' src='" + value.avatar_url + "' alt='" + value.name + "'/>";
							html += "		<a class='name-rep' href='" + value.permalink + "' title='" + value.name + "'>" + value.name + "</a>";
							html += "		<span class='tipo-ele'> Tipo de elección: " + value.election_type + "</span>";
							html += "		<span class='zona'> Circunscripción: " + value.circum + "</span>";
							html += "		<span class'estado'> Estado: " + value.zone_state + "</span>";
							html += "	</div>";
							html += "	<div class='part-data'>";
							html += "		<img class='img-partido' src='http://curul501.org/wp-content/themes/curul501/images/" + value.politicalParty.url_logo + "' alt='" + value.politicalParty.name + "'/>";
							html += "		<span class='partido'> Partido politico: " + value.politicalParty.name + "<br/> </span>";
							html += "	</div'>";
							html += "</div>";
						}
					});
					
					jQuery(".map-info-representante-proporcional").html(html);
					jQuery(".map-info-representante-mayoria").html(html2);
				}

				if( jQuery("#map-info").css("display") == "block"){
					jQuery("#map-info").toggle( "slide", { "direction": "right" }, function(){
						info_filling()
						jQuery("#map-info").toggle( "slide", { "direction": "right", "duration": 800  });
					});
				}else{
					info_filling()
					jQuery("#map-info").toggle( "slide", { "direction": "right", "duration": 800  });

				}



			} else {
				console.log("Asegurate de estar en territorio mexicano");
			}
		});
	} else {
		console.log("Asegurate de estar en territorio mexicano");
	}
}


