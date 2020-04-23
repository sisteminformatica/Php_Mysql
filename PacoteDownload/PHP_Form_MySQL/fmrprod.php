<?php

	include "include.php";
	
	$vcod="01";//$_POST("F_Cod");
	$vprod="p01";//$_POST("F_Prod");
	$vpreco=100.00;//$_POST("F_Preco");
	$vqtde=10;//$_POST(F_Qtde);
	
	//$sql="INSERT INTO tb_produtos VALUES ('$vcod','$vprod',$vpreco,$vqtde)";
    $sql="INSERT INTO tb_produtos VALUES ('01')";
	$res=mysqli_query($con,$sql);
	$linhas=mysqli_affected_rows($con);
	
	if($linhas == 1){
		echo "Registro gravado com sucesso<br/>";
	}else{
		echo "Falha na gravação do Registro<br/>";
	}
	
	mysqli_close($con);
	
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
	<title>Formulario Produtos (Insert)"<title>
</head>
<body>
	<br/>
	<a href="frmprod.html"><Voltar</a>
</body>
</head>
</html>
	