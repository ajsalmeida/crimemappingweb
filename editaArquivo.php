<?php
//apontar para o arquivo JSON
//carregar arquivo JSON
Class editaJson{
  public static function editaArquivoJson($latitude,$longitude,$gravidadeCrime){
    //abre conexão com o mysql
    $mysqli = new mysqli("localhost", "ajsalmeida", "qwert12345", "crimemappingweb");

    if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $mysqli = new mysqli("localhost", "ajsalmeida", "qwert12345", "crimemappingweb", 3306);
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }else { //Lê o conteúdo da tabela no mysql
      $consulta = "SELECT * FROM registro";
      $result = $mysqli->query($consulta);
      //escreve o conteúdo da tabela no arquivo geojson
      while ($row = $myquery->fetch_assoc()) {
        $latitude=$row["lat"];
        $longitude=$row["lng"];
        $gravidadeCrime=$row["grvd"];
        echo $latitude;
        echo $longitude;
        echo $gravidadeCrime;
        fopen('JSON_data/coordenadas.geojson', 'w')
     }

  }
}
}
?>
