
<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

//bloco de verificação de sessão
// mudar para post
$latitude = $_POST["lat"]; //latitude onde foi registrado o crime
$longitude = $_POST["lng"]; //longitude onde foi registrado o crime
$gravidadeCrime = $_POST["radio"]; //gravidade reportada do crime

if ($latitude!="" && $longitude!="" && $gravidadeCrime!="") { //testa se as strings não estão vazias
  require_once('mysqlOps.php'); //chama a classe mysqlOps uma vez
  $bancoDeDados = new bancoDeDados(); //criação de um objeto do tipo banco de dados
  $bancoDeDados::inserirDados($latitude,$longitude,$gravidadeCrime);
  //Escrita no arquivo GeoJson para mostrar o mapa de calor com os pontos dos crimes inseridos
  require_once('editaArquivo.php');
  $editaArquivoJson = new editaJson();
  $editaArquivoJson::editaArquivoJson($latitude,$longitude,$gravidadeCrime);
}else{
  header('location:crimeReport.php?msg=reportError'); // caso alguma string esteja vazia, redireciona para a pagina de registro com um aviso
}
?>
