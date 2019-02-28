<!DOCTYPE html>
<html>
  <head>
    <title>Adicionar crime ao mapa de calor</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Website CSS style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css' rel='stylesheet' />
  </head>
  <body>
    <?php
    //Bloco de verificação de sessão
    session_start();
    if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha']) ){
      header('location:index.php?msg=loginErro'); //Se não houver sessão redireciona para a página inicial
    }
    if ($_GET['msg']=="reportError"){
      echo"
      <div class='alert alert-danger text-center'>
      <strong>Aviso: </strong> Parece que você esqueceu de enviar algum dado.
      </div>
      ";
    }

    ?>
    <div class="bg-primary text-white col-lg-12 text-center">
            <h2>Arraste o marcador para coletar as coordenadas do crime no mapa</h2>
    </div>

    <style>
        .coordinates {
            background: rgba(0,0,0,0.5);
            color: #fff;
            position: absolute;
            bottom: 10px;
            left: 10px;
            padding:5px 10px;
            margin: 0;
            font-size: 11px;
            line-height: 18px;
            border-radius: 3px;
            display: none;
        }
    </style>
    <div id='map' style='width:100%; height:60%;'></div>
    <pre id='coordinates' class='coordinates'></pre>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYWpzYWxtZWlkYSIsImEiOiJjanJhbDc2MmgwYWV4NDNueWJtMW1yZHJtIn0.wYizjISkT7K5yeR4Kw4TxQ'; //chave da API
        var coordinates = document.getElementById('coordinates');
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/basic-v9', //define o estilo do mapa
            center: [-50, -14], //centraliza o mapa no Brasil
            zoom: 5 // define o nível de zoom
        });

        var marker = new mapboxgl.Marker({
            draggable: true
        })
        .setLngLat([-50, -14])
        .addTo(map);

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            coordinates.style.display = 'block';
            coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;

            //coleta latitude e longitude do mapa
            latitude=lngLat.lat;
            longitude=lngLat.lng;
            document.getElementById("lat").value = latitude; //define os o valor do elemento lat como a latitude do marcador
            document.getElementById("lng").value = longitude; // define o valor do elemento lng como a longitude do marcador

        }

        marker.on('dragend', onDragEnd);
    </script>

    <div class="row-fluid">

      <div id="formularioMeio" class="col-xs-12 bg-success">
            <h4 class="text-center"> <b>Selecione a Gravidade do Crime</b></h4>
                <form class="form-horizontal" method="post" action="getData.php"> <!--ver se da pra passar pelo url-->
                <input type="hidden" id="lat" name="lat" /> <!--local onde ficam as coordenadas-->
                <input type="hidden" id="lng" name="lng" /> <!--local onde ficam as coordenadas-->
                <input type="hidden" id="address" name="endereco" /> <!--local onde ficam as coordenadas-->
                <div class="funkyradio">
                    <div class="funkyradio-success">
                        <input type="radio" name="radio" id="radio1" value="1" />
                        <label for="radio1">
                          <strong>Crime1</strong>
                        </label>
                    </div>
                    <div class="funkyradio-primary">
                        <input type="radio" name="radio" id="radio2" value="2" />
                        <label for="radio2">
                          <strong>Crime2</strong>
                        </label>
                    </div>
                    <div class="funkyradio-info">
                        <input type="radio" name="radio" id="radio3" value="3" />
                        <label for="radio3">
                          <strong>Crime3</strong>
                        </label>
                    </div>
                    <div class="funkyradio-warning">
                        <input type="radio" name="radio" id="radio4" value="4" />
                        <label for="radio4">
                          <strong>Crime4</strong>
                        </label>
                    </div>
                    <div class="funkyradio-danger">
                        <input type="radio" name="radio" id="radio5" value="5" />
                        <label for="radio5">
                          <strong>Crime5</strong>
                        </label>
                    </div>
                    <div class="funkyradio-secondary">
                        <input type="radio" name="radio" id="radio6" value="6" />
                        <label for="radio6">
                          <strong>Crime6</strong>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-md btn-block">Enviar os dados ao servidor</button>
                </form>

       </div>
    </div>


  </body>
</html>
