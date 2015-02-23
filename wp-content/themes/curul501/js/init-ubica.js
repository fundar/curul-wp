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
				//icon: L.icon({ 'iconUrl': '../wp-content/themes/curul501/images/marker-morado.png' }) ,
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
	return map;
}


function getPip(lat, lng) {
    var estadosLayer = L.geoJson(GeoJson);
    var resultPip 	 = leafletPip.pointInLayer([lng, lat], estadosLayer);
    
    if(resultPip.length) {
		jQuery.getJSON("../wp-content/themes/curul501/js/geojson/estado-" + resultPip[0].feature.properties.CVE_ENT + ".geojson")
		.success(function (distritosGeoJson) {
			// Agregar hash con las coordenadas para compartir
			window.location.hash = lat + "," + lng
			
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
					
					var dip  = "<h2> REPRESENTACIÓN PROPORCIONAL </h2>";
					var dip2 = "<h2> MAYORÍA RELATIVA </h2>";
					var sen  = "<h2> PRIMERA MINORÍA </h2>";
					var sen2 = "<h2> MAYORÍA RELATIVA </h2>";

					jQuery.each(representatives, function( index, value ) {
						if(value.tipo == 1){
							if( (value.clave_estado == state && value.circum == circum) || (value.clave_estado == state && value.district == district) ){
								if(value.circum == "") {
									dip2 += "<div class='representante-mapa'>";
									dip2 += "	<div class='rep-data'>";
									dip2 += "		<img class='img-rep' src='" + value.avatar_url + "' alt='" + value.name + "'/>";
									dip2 += "		<a class='name-rep' href='" + value.permalink + "' title='" + value.name + "'>" + value.name + "</a>";
									dip2 += "		<span class='zona'> Distrito: " + value.district + " </span>";
									dip2 += "		<span class'estado'> Estado: " + value.zone_state + " </span>  <br>";
									dip2 += "	</div>";
									dip2 += "	<div class='part-data'>";
									dip2 += "		<img class='img-partido' src='http://curul501.org/wp-content/themes/curul501/images/" + value.politicalParty.url_logo + "' alt='" + value.politicalParty.name + "'/>";
									dip2 += "		<span class='partido'> Partido politico: " + value.politicalParty.name + " </span>";
									dip2 += "	</div>";
									dip2 += "</div>";
								} else {
									dip += "<div class='representante-mapa'>";
									dip += "	<div class='rep-data'>";
									dip += "		<img class='img-rep' src='" + value.avatar_url + "' alt='" + value.name + "'/>";
									dip += "		<a class='name-rep' href='" + value.permalink + "' title='" + value.name + "'>" + value.name + "</a>";
									dip += "		<span class='zona'> Circunscripción: " + value.circum + "</span>";
									dip += "		<span class'estado'> Estado: " + value.zone_state + "</span>  <br>";
									dip += "	</div>";
									dip += "	<div class='part-data'>";
									dip += "		<img class='img-partido' src='http://curul501.org/wp-content/themes/curul501/images/" + value.politicalParty.url_logo + "' alt='" + value.politicalParty.name + "'/>";
									dip += "		<span class='partido'> Partido politico: " + value.politicalParty.name + "<br/> </span>";
									dip += "	</div'>";
									dip += "</div>";
								}
							}
						}else if(value.tipo == 2){
							if( value.clave_estado == state ){
								if ( value.election_type == "Primera Minoría"){
									sen += "<div class='representante-mapa'>";
									sen += "	<div class='rep-data'>";
									sen += "		<img class='img-rep' src='" + value.avatar_url + "' alt='" + value.name + "'/>";
									sen += "		<a class='name-rep' href='" + value.permalink + "' title='" + value.name + "'>" + value.name + "</a>";
									sen += "		<span class='zona'> Circunscripción: " + value.circum + "</span>";
									sen += "		<span class'estado'> Estado: " + value.zone_state + "</span>  <br>";
									sen += "	</div>";
									sen += "	<div class='part-data'>";
									sen += "		<img class='img-partido' src='http://curul501.org/wp-content/themes/curul501/images/" + value.politicalParty.url_logo + "' alt='" + value.politicalParty.name + "'/>";
									sen += "		<span class='partido'> Partido politico: " + value.politicalParty.name + "<br/> </span>";
									sen += "	</div'>";
									sen += "</div>";
								} else  if(value.election_type == "Mayoría Relativa") {
									sen2 += "<div class='representante-mapa'>";
									sen2 += "	<div class='rep-data'>";
									sen2 += "		<img class='img-rep' src='" + value.avatar_url + "' alt='" + value.name + "'/>";
									sen2 += "		<a class='name-rep' href='" + value.permalink + "' title='" + value.name + "'>" + value.name + "</a>";
									sen2 += "		<span class='zona'> Distrito: " + value.district + " </span>";
									sen2 += "		<span class'estado'> Estado: " + value.zone_state + " </span>  <br>";
									sen2 += "	</div>";
									sen2 += "	<div class='part-data'>";
									sen2 += "		<img class='img-partido' src='http://curul501.org/wp-content/themes/curul501/images/" + value.politicalParty.url_logo + "' alt='" + value.politicalParty.name + "'/>";
									sen2 += "		<span class='partido'> Partido politico: " + value.politicalParty.name + " </span>";
									sen2 += "	</div>";
									sen2 += "</div>";
								} 
								
							}
						}
					});
					
					jQuery(".diputados .map-info-representante-proporcional").html(dip);
					jQuery(".diputados .map-info-representante-mayoria").html(dip2);
					jQuery(".senadores .map-info-representante-minoria").html(sen);
					jQuery(".senadores .map-info-representante-mayoria").html(sen2);
					
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


function hash_to_search(map){
	var latlng = (window.location.hash).split("#")[1].split(",")

	sMarker = L.marker( latlng,{ 
		icon: L.icon({ 'iconUrl': '../wp-content/themes/curul501/images/marker-morado.png' }) ,
	}).addTo(map);

	getPip(latlng[0], latlng[1])  	
}