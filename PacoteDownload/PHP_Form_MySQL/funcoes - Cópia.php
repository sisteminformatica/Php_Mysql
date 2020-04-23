<?php

	//Abre Conexão com MYSQL


	function DBConnect(){
		$link=@mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error());
		mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
		
		return $link;
	}
/*
	function PDOConnect(){
		$host  = "localhost";
		$banco = "sistrest";
		$user  = "root";
		$senha = "";

		try{
			$conn = PDO("mysql:host=".$host.":dbname=".$banco, $user, $senha);
			return array("conexao"=>$conn, "mensagem"=>"Sucesso");
		}catch(PDOException $e){
			return array("conexao"=>null, "mensagem"=>"Ocorreu o seguinte erro:<br>".$se=>getMessage());
		}

	}
*/
	// Proteje contra SQL Injection
	function DBEscape($dados){
		$link = DBConnect();
		
		if(!is_array($dados))
			$dados = mysqli_real_escape_string($link,$dados);
		else {
			$arr = $dados;
			
			foreach($arr as $key => $value){
				$key   = mysqli_real_escape_string($link,$key);
				$value = mysqli_real_escape_string($link,$value);
				
				$dados[$key] = $value;
			}
		}
		
		DBClose($link);
		return $dados;
	}

	//Fecha Conexao com MYSQL
	function DBClose($link){
		@mysqli_close($link) or die(mysqli_error($link));
	}

	// Executa Querys
	function DBExecute($query){
		$link   = DBConnect();
        $result = @mysqli_query($link,$query) or die(mysqli_error($link));
		
		DBClose($link);
		return $result;
	}

	//Função para inserir registro na tabela
	function inserir($query){
		$link = DBConnect();
		$result = @mysqli_query($link,$query) or die(mysqli_error($link));
		DBClose($link);
		return $result;
	}
	
	//Grava Registros
	function DBCreate($tabela, array $data){
		$tabela = DB_PREFIX.'_'.$tabela;
		$data =DBEscape($data);
		$fields = implode(', ', array_keys($data));
		$values = "'".implode("','", $data)."'";
		
		$query = "INSERT INTO {$tabela} ({$fields}) VALUES ({$values})";
		
		return DBExecute($query);		
	}
	
	//Ler Registros
	
	function DBRead($tabela, $params = null, $fields = '*'){
		$tabela = DB_PREFIX.'_'.$tabela;
		$params = ($params) ? " {$params}" : null; //se params veio com valor então $params se nao NULL
				
		$query  = "SELECT {$fields} FROM {$tabela}{$params}";
		$result = DBExecute($query);
		
		if(!mysqli_num_rows($result)) //num_rows conta numero de registros da tabela (se lins =0 ou Registros =0)
			return false;
		else{
			while ($res = mysqli_fetch_assoc($result)){ //fetch_assoc trasnforma campos da tabela em 1 array
				$data[] = $res;
			}	
			
			return $data;
		}
		
		return $query;		
	}
	
	//Altera Registros
	function DBUpdate($tabela, array $data, $where = null){
		foreach ($data as $key => $value){
			$fields[] = "{$key} = '{$value}'";			
		}
		
		$fields = implode(', ', $fields);
		

		$tabela = DB_PREFIX.'_'.$tabela;
		$where  = ($where) ? " WHERE {$where}" : null; //se params veio com valor então $params se nao NULL
		
		$query ="UPDATE {$tabela} SET {$fields}{$where}";
		return DBExecute($query);
		
	//Deleta Registros
	function DBDelete($tabela, $where = null){
		$tabela = DB_PREFIX.'_'.$tabela;
		$where  = ($where) ? " WHERE {$where}" : null; //se params veio com valor então $params se nao NULL
		
		$query  = "DELETE FROM {$tabela}{$where}";
		return DBExecute($query);
	}
	
	
?>