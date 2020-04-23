<!DOCTYPE HTML>
<html lang="pt_BR">
<head>
	<meta charset="UTF-8">
	<title>PHP com MYSQLi</title>
</head>
<body>
<?php

	require 'config.php';
	require 'funcoes.php';
	$tabela=`tbl_produtos`;
	
	$altprod = array(
		'quantidade' => 200,
		'preco' => 250
	);
	//DBRead($tabela, $params = null, $fields = '*')
	DBRead($tabela,'','');
	
	//var_dump(DBUpdate('peodutos', $altprod, "codigo = '010001'"));
	/*
	$altprod = array(
		'quantidade' => 200 
	);
	
	var_dump(DBUpdate('peodutos', $altprod));
	*/
?>
</body>
</html>