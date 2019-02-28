<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Crimemapping</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
//criando arquivo de logs e armazenando os eventos
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
//Bloco de verificação de sessão
session_start();
if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha']) ){
	header('location:index.php?msg=loginErro'); //Se não houver sessão redireciona para a página inicial
}
require_once('mysqlOps.php');
    //chama a classe mysqlOps uma vez
    //Recebendo valores de login.html
		if( $_POST['email'] !="" && $_POST['password'] !="" ) {
			if ( (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))  && (strlen($_POST['password'])>5) ) {
        echo $email;
        echo $password;
				$email = $_POST['email'];
				$senha = $_POST['password']; //depois fazer um hash em cima da senha e usar somente o hash para a comparaçao
				$parametro1=""; //guardar para o futuro
				$parametro3=""; // guardar para o futuro

				$bancoDeDados = new bancoDeDados(); //cria instância do objeto banco de dados da classe bancoDeDados
				$bancoDeDados::consultaLogin($parametro1,$email,$parametro3,$senha,1);
			}else{
				if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
					echo"
					<div class='alert alert-danger text-center'>
					<!--<a href='login.html' class='close' data-dismiss='alert' aria-label='close'>&times;</a>-->
					<strong>Aviso: </strong> digite um email válido.
					</div>
					";
				}
				if (strlen($_POST['password']<=5)) {
					echo "
					<div class='alert alert-danger text-center'>
					<!--<a href='login.html' class='close' data-dismiss='alert' aria-label='close'>&times;</a>-->
					<strong>Aviso: </strong> a senha deve ter seis caracteres ou mais.
					</div>
					";
				}

				include('login.html');
			}

		}else{
			echo "
			<div class='alert alert-warning'>
    		<!--<a href='login.html' class='close' data-dismiss='alert' aria-label='close'>&times;</a>-->
    		<strong>Aviso: </strong> Você esqueceu de digitar o email ou a senha.
  			</div>
  			";
  			include('login.html');
		}
?>
</body>
</html>
