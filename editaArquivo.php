<?php
//apontar para o arquivo JSON
//carregar arquivo JSON
Class editaJson{
  public static function editaArquivoJson($latitude,$longitude,$gravidadeCrime){
    if ($editaArquivo=fopen('teste.geojson', 'w')) {
      //gera string JSON OBS: está sem indetação por causa da formatação
      $textoJSON='{
"type": "FeatureCollection",
"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
"features": [';
      //abrir conexão com o banco de dados e recuperar os registros
      $textoJSON.='
]
}';
      //Escreve a string no
      fwrite($editaArquivo,$textoJSON);
      fclose($editaArquivo);
    }
    else {
      echo "Abertura de arquivo falhou";
    }



  }
}
?>
