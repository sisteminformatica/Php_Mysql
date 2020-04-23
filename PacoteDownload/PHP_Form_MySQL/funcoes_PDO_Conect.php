<?php

	//Abre Conexão com MYSQL

	function PDOConnect(){
		$host  = "localhost";
		$banco = "marcost_cook";
		$user  = "root";
		$senha = "";

		try{
			$conn
			 = new PDO("mysql:host=".$host.";dbname=".$banco, $user, $senha);
			return array("conexao"=>$conn, "mensagem"=>"Sucesso");
		}catch(PDOException $e){
			return array("conexao"=>null, "mensagem"=>"Ocorreu o seguinte erro:<br>" .$se=>getMessage());
		}

	}

	function DBConnect(){
		$link=@mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error());
		mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
		
		return $link;
	}

	$teste = PDOConnect();
	print_r($teste);
	
?>