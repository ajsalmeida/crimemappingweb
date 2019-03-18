<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
$null = null;
//Bloco de verificação de sessão
session_start();
if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha']) ){
	header('location:index.php?msg=loginErro'); //Se não houver sessão redireciona para a página inicial
}

Class bancoDeDados{
	public static function consultaLogin($parametro1,$parametro2,$parametro3,$parametro4,$operacao){
	      require_once('hash.php');
	      $hash = new hashSenha();
	      $hashRetornado=$hash::calculaHash($parametro4);//calcula o hash da senha digitada pelo usuário

	      //debugging
	      $mysqli = new mysqli("localhost", "ajsalmeida", "qwert12345", "crimemappingweb");
	      if ($mysqli->connect_errno) {
	      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	      }
	      $mysqli = new mysqli("localhost", "ajsalmeida", "qwert12345", "crimemappingweb", 3306);
	      if ($mysqli->connect_errno) {
	        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	      }

	      //preparação da consulta com os valores das variáveis
	      $consulta="SELECT email, senha FROM usuario WHERE email='";
	        $consulta.=$parametro2."'";
	        $consulta.=" AND";
	        $consulta.=" senha='";
	        $consulta.=$hashRetornado."'";

	      //testa se usuário existe no banco de dados
	      if ($result = $mysqli->query($consulta)) {

	          $result = $mysqli->query($consulta);
	          $numLinhas=$result->num_rows;
	          $result->close();

	          if($numLinhas==1){
	          //echo "Tem uma correspondencia no banco de dados";
	          $_SESSION['usuario'] = $parametro2;//email
	          $_SESSION['senha'] = $hashRetornado;//senha
	          header('location:index.php?msg=loginOk');
	          }
	          else{//usuario e senha nao estao no banco de dados
	            //echo "Não há uma correspondência no banco de dados";
	            unset ($_SESSION['usuario']); //depois mudar o nome do usuario para o nome que consta no banco de dados para esse email
	            unset ($_SESSION['senha']);
	            header('location:index.php?msg=loginErro');
	          }

	      }
			}

  public static function inserirDados($latitude,$longitude,$gravidadeCrime){
		$mysqli = new mysqli("localhost", "ajsalmeida", "qwert12345", "crimemappingweb");
		if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$mysqli = new mysqli("localhost", "ajsalmeida", "qwert12345", "crimemappingweb", 3306);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}else {
			//insere os dados no banco de dados mysql
			$consulta="INSERT INTO registro (lat,lng,grvd) VALUES ";
			$consulta.="("."'".$latitude."'".","."'".$longitude."'".","."'".$gravidadeCrime."'".")";
			$executar = $mysqli->query($consulta);

			//Escrita no arquivo GeoJson para mostrar o mapa de calor com os pontos dos crimes inseridos
		  require_once('editaArquivo.php');
		  $editaArquivoJson = new editaJson();
		  $editaArquivoJson::editaArquivoJson($latitude,$longitude,$gravidadeCrime);
			
			//redirecionar para inicio com mensagem de sucesso
			header('location:index.php?msg=sucessoReport');
		}

	}
}

?>
