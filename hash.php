<?php
//bloco de verificação de sessão
session_start();
if(!isset($_SESSION['usuario']) || !isset($_SESSION['senha']) ){
	header('location:index.php?msg=loginErro'); //Se não houver sessão redireciona para a página inicial
}

//Início do bloco de objetos
Class hashSenha{ //declaração de classe para cáculo do hash SHA256
	public static function calculaHash($senha){ // declaração de função que recebe o parâmetro senha de mysqlOps
	$hash=hash('sha256', $senha);//calcula o hash com algoritmo sha256
	return $hash;//retorna o hash calculado
	}
}

?>
