var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

//posicao inicial do mapa
var geocoder;
function initialize() {	
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(-5,-39.066667);
	
    var options = {
        zoom: 8,
		center: latlng,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();
//pegando as coordenadas digitadas pelo usuário
function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      //define o centro do mapa para as coordenadas encontradas
      map.setCenter(results[0].geometry.location);
  	  alert(results[0].geometry.location);
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
//fim pegar coordenadas

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

function carregarPontos() {
	
	$.getJSON('js/pontos.json', function(pontos) {
		
		var latlngbounds = new google.maps.LatLngBounds();
		
		$.each(pontos, function(index, ponto) {
			
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
				//atribui um titulo no hover do mouse em todos os marcadores
				title: "Vaga(s) livres detectadas",
				//carrega o icone do marcador
				icon: 'img/marcador.png'
			});
			
			var myOptions = {
				content: "<p>"+" Endereço do buraco: " + ponto.Endereco +"<p>"+" Tamanho: " + ponto.Tamanho + "<p>"+ " Data de adiçao: "+ponto.Data+"</p>",
				pixelOffset: new google.maps.Size(-150, 0)
        	};

			infoBox[ponto.Id] = new InfoBox(myOptions);
			infoBox[ponto.Id].marker = marker;
			
			infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
				abrirInfoBox(ponto.Id, marker);
			});
			
			markers.push(marker);
			latlngbounds.extend(marker.position);
			
		});
		
		var markerCluster = new MarkerClusterer(map, markers,{imagePath: 'img/marcador.png'});
		
		map.fitBounds(latlngbounds);
		
	});
	
}

carregarPontos();
