<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>CRIME MAPS</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Website CSS style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Google Fonts
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>-->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.css' rel='stylesheet' />

</head>


<body>

    <div class="container-fluid">
    <?php
    session_start();
        if(isset($_GET['msg'])){
            if($_GET['msg']=="sucessoReport" ){
                echo "
                <div class=' row-fluid alert alert-success text-center'>
                <a href='index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Sucesso! </strong> Crime reportado!
                </div>
                ";
            }
            if($_GET['msg']=="fechaSessao"){
                echo "
                <div class=' row-fluid alert alert-success text-center'>
                <a href='index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Sucesso! </strong> Você efetuou logout!
                </div>
                ";
            }
            if($_GET['msg']=="usuarioJaCadastrado"){
                echo "
                <div class=' row-fluid alert alert-danger text-center'>
                <a href='index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Aviso: </strong> esse email já está cadastrado no sistema!
                </div>
                ";
            }
            if($_GET['msg']=="usuarioCadastrado"){
                echo "
                <div class=' row-fluid alert alert-success text-center'>
                <a href='index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Sucesso! </strong> Usuário cadastrado!
                </div>
                ";
            }
            if ($_GET['msg']=="loginErro") {
              echo "
              <div class=' row-fluid alert alert-danger text-center'>
              <a href='index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Erro! </strong> Verifique os dados de acesso e tente novamente
              </div>
              ";
            }
        }

    ?>
    </div>


    <div id="header" class="row-fluid vcenter">
            <!--DESATIVADO>
            <div id="logo" class="col-lg-3 text-center" >
                <img src="img/logo.png">
            </div>
            -->
            <div id="meio" class="col-lg-6 text-center">
                <a href="crimeReport.php"><button type="button" class="btn btn-danger btn-lg btn-block"><i class="fa fa-flag fa" aria-hidden="true"></i>Adicionar Crime</button></a>
            </div>

            <?php







            if (   (isset($_GET['msg']))  ||  (!isset($_SESSION['usuario']))  || (!isset($_SESSION['senha']))   ){ //exibe o botao entrar se ainda nao houver uma sessao ativa

                if (  ($_GET['msg']=="sucessoSair") || ($_GET['msg']=="fechaSessao") || ($_GET['msg']=="")  ){
                    unset($_SESSION['usuario']);
                    unset($_SESSION['senha']);
                    echo
                    "<div id='login' class='col-lg-3 text-center' >
                    <a href='login.html'><button type='button' class='btn btn-primary btn-lg btn-block login-button'><i class='fa fa-sign-in fa' aria-hidden='true'></i> Entrar</button></a>
                    </div> ";
                }
                elseif ($_GET['msg']=="loginErro") {
                    unset($_SESSION['usuario']);
                    unset($_SESSION['senha']);
                    echo
                    "<div id='login' class='col-lg-3 text-center' >
                    <a href='login.html'><button type='button' class='btn btn-primary btn-lg btn-block login-button'><i class='fa fa-sign-in fa' aria-hidden='true'></i> Entrar</button></a>
                    </div> ";
                }

            }
            if(    (  (isset($_SESSION['usuario'])) && (isset($_SESSION['senha'])) )  || ( (isset($_GET['msg'])) && ($_GET['msg']=="loginOk")  ) ){//exibe a mensagem de boas vindas e o email do usuario

                echo //escreve bem vindo e o nome de usuário
                "<div id='login' class='col-lg-3 text-center bg-primary'>
                    <b> Bem-Vindo ".$_SESSION['usuario']."</b>
                    <form method='post' action='index.php?msg=fechaSessao'>
                    <a href='#'><button  type='submit' class='btn btn-danger btn-xs' name='sair' value='sair'><i class='fa fa-sign-out fa' aria-hidden='true'></i> sair</button></a>
                    </form>
                </div> ";

                //fazer consulta ao banco de dados para saber o nome do usuario que fez a sessao e resgatar essa informaçao

             }


            ?>

    </div>

    <!-- -->
    <div id="mapa" class="row-fluid col-lg-12">

    <div id='map' style='width:100%; height:160%;'></div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiYWpzYWxtZWlkYSIsImEiOiJjanJhbDc2MmgwYWV4NDNueWJtMW1yZHJtIn0.wYizjISkT7K5yeR4Kw4TxQ';
        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/dark-v9',
        center:[-50, -14],
        zoom:3
        });
        map.on('load', function() {
    // Add a geojson point source.
    // Heatmap layers also work with a vector tile source.
    map.addSource('earthquakes', {
        "type": "geojson",
        "data": "coordenadas.geojson"
        //carregamento de arquivo GeoJSON local
        //"data": "https://docs.mapbox.com/mapbox-gl-js/assets/earthquakes.geojson"
    });

    map.addLayer({
        "id": "earthquakes-heat",
        "type": "heatmap",
        "source": "earthquakes",
        "maxzoom": 9,
        "paint": {
            // Increase the heatmap weight based on frequency and property magnitude
            "heatmap-weight": [
                "interpolate",
                ["linear"],
                ["get", "gravidade"],
                0, 0,
                6, 1
            ],
            // Increase the heatmap color weight weight by zoom level
            // heatmap-intensity is a multiplier on top of heatmap-weight
            "heatmap-intensity": [
                "interpolate",
                ["linear"],
                ["zoom"],
                0, 1,
                9, 3
            ],
            // Color ramp for heatmap.  Domain is 0 (low) to 1 (high).
            // Begin color ramp at 0-stop with a 0-transparancy color
            // to create a blur-like effect.
            "heatmap-color": [
                "interpolate",
                ["linear"],
                ["heatmap-density"],
                0, "rgba(33,102,172,0)",
                0.2, "rgb(103,169,207)",
                0.4, "rgb(209,229,240)",
                0.6, "rgb(253,219,199)",
                0.8, "rgb(239,138,98)",
                1, "rgb(178,24,43)"
            ],
            // Adjust the heatmap radius by zoom level
            "heatmap-radius": [
                "interpolate",
                ["linear"],
                ["zoom"],
                0, 2,
                9, 20
            ],
            // Transition from heatmap to circle layer by zoom level
            "heatmap-opacity": [
                "interpolate",
                ["linear"],
                ["zoom"],
                7, 1,
                9, 0
            ],
        }
    }, 'waterway-label');

    map.addLayer({
        "id": "earthquakes-point",
        "type": "circle",
        "source": "earthquakes",
        "minzoom": 7,
        "paint": {
            // Size circle radius by earthquake magnitude and zoom level
            "circle-radius": [
                "interpolate",
                ["linear"],
                ["zoom"],
                7, [
                    "interpolate",
                    ["linear"],
                    ["get", "gravidade"],
                    1, 1,
                    6, 4
                ],
                16, [
                    "interpolate",
                    ["linear"],
                    ["get", "gravidade"],
                    1, 5,
                    6, 50
                ]
            ],
            // Color circle by earthquake magnitude
            "circle-color": [
                "interpolate",
                ["linear"],
                ["get", "gravidade"],
                1, "rgba(33,102,172,0)",
                2, "rgb(103,169,207)",
                3, "rgb(209,229,240)",
                4, "rgb(253,219,199)",
                5, "rgb(239,138,98)",
                6, "rgba(224,31,53,1)"
            ],
            "circle-stroke-color": "white",
            "circle-stroke-width": 1,
            // Transition from heatmap to circle layer by zoom level
            "circle-opacity": [
                "interpolate",
                ["linear"],
                ["zoom"],
                7, 0,
                8, 1
            ]
        }
    }, 'waterway-label');
});
    </script>

    </div>


        <!--<script src="js/jquery.min.js"></script> BLOCO DE CARREGAMENTO GOOGLE MAPS
        Maps API Javascript
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCsNAz7i3dDcPfQQz2KoirQ8Jd1_IiRtDo&ampsensor=false"></script> Lembrar de colocar restricao da chave
        <script src="js/infobox.js"></script>
        Agrupamento dos marcadores
        <script src="js/markerclusterer.js"></script>
        Arquivo de inicialização do mapa
        <script src="js/mapa.js"></script>
        </div>
        -->



        <!--aqui começa o footer-->
     <!--   <div id="rodape">
            [PARTE DESATIVADA]
            <div id="rodapeCima" class="col-lg-12 text-center bg-primary">
                <h1>Participação colaborativa</h1>
                <p>colabore reportando buracos nas vias da cidade</p>
            </div>


                <div id="rodapeEsquerda" class="col-lg-4 text-center">
                    <h3>Encontrou algum problema?</h3>
                    <a href="contato.html"><button type="button" class="btn btn-primary">Contato</button></a>
                    <h5>Clicando no botão acima é possível entrar em contato com os administradores do sistema</h5>
                </div>
                <div id="rodapeMeio" class="col-lg-4 text-center">
                    <h3>Ainda não está cadastrado?</h3>
                    <a href="signup.html"><button type="button" class="btn btn-primary">Cadastrar-se</button></a>
                    <h5>Clicando no botão acima é possível fazer o cadastro no sistema e começar a repostar buracos nas vias</h5>
                </div>
                <div id="rodapeDireita" class="col-lg-4 text-center">
                    <h3>Acesso administrativo</h3>
                    <a href="loginAdm.html"><button type="button" class="btn btn-primary">Acessar</button></a>
                    <h5>Clicando no botão acima é possível fazer acesso administrativo e fazer ajustes no sistema</h5>
                </div>
        <div id="microFoot" class="col-lg-12 bg-primary text-center">
            <a href="http://www.facebook.com"><img src="img/facebook.svg" width="32" height="22"></a>
            <a href="http://www.twitter.com"><img src="img/twitter.svg" width="32" height="22"></a>
            <a href="http://www.youtube.com"><img src="img/youtube.svg" width="32" height="22"></a>

        ‎</div>
    </div>
         -->

</body>
</html>
