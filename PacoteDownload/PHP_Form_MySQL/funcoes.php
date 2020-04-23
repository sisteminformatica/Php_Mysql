<?php

	//Abre Conexão com MYSQL


	function DBConnect(){
		$link=@mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error());
		mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
		
		return $link;
	}

	// Executa Querys
	function DBExecute($query){
		$link   = DBConnect();
        $result = @mysqli_query($link,$query) or die(mysqli_error($link));
		
		DBClose($link);
		return $result;
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

?>