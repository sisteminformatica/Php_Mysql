<?php

	//Abre Conexão com MYSQL

	function PDOConnect(){
		$host  = "localhost";
		$banco = "marcost_cok";
		$user  = "root";
		$senha = "";

		try{
			$conn
			 = new PDO("mysql:host=".$host.";dbname=".$banco, $user, $senha);
			return array("conexao"=>$conn, "mensagem"=>"Sucesso");

		}catch(PDOException $e){
			return array("conexao"=>null, "mensagem"=>"Ocorreu o seguinte erro:<br>").$e->getMessage();
		}

	}


	$teste = PDOConnect();
	print_r($teste);
	
?>