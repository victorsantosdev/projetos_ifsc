<?php

//include 'debuglib.php';
//mostra erros no código!
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$indice = intval($_GET['indice']);
//recebe informações do formulário

//variaveis
$quantidadenova = intval($_REQUEST['quantidadenova']);

//conecta-se ao banco de dados
$mysql['servidor']	= "mysql03.pontoauto4x4.com.br";
$mysql['usuario']	= "pontoauto4x42";
$mysql['senha']		= "cr/4x4";
$mysql['banco']		= "pontoauto4x42";
$table = $mysql['banco'];
$con = mysql_connect($mysql['servidor'],$mysql['usuario'],$mysql['senha']);
if($con == NULL)
{
	
///********************************* HTML PARA MOSTRAR ERRO DE CONEXAO COM O SERVIDOR *************************************************************	
	?>
    	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resestoque.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resestoque.css" type="text/css" />
<script type="text/JavaScript" src="/curvycorners-2.1/curvycorners.js"></script>

<style>

.aviso {
	
    margin: 0.5in auto;
    color:  #333;
    width: 60%;
    padding: 5px;
    text-align: center;
    background-color:  #CCC;
    border: 2px solid  #333;
    /* Do rounding (native in Firefox and Safari) */
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
}

}
</style>

	</head>
	<body>
    <div class= "aviso"><table cellpadding = "0" cellspacing="0" border="0" width="800" align="center">
    		<tr><td width="600" height="200" align="center" ><? echo "ERRO AO CONECTAR COM O SERVIDOR!"; ?></td></tr></table></div>

	</body>
</html>
	
<?
//************************************************************************************************************************	
	
	exit();
}
else
{
	$bd = mysql_select_db($mysql['banco'],$con);
	if(!$bd)
	{
///********************************* HTML PARA MOSTRAR ERRO DE CONEXAO COM O BD *************************************************************	
		
		?>
    	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resestoque.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resestoque.css" type="text/css" />
<script type="text/JavaScript" src="/curvycorners-2.1/curvycorners.js"></script>

<style>

.aviso {
	
    margin: 0.5in auto;
    color:  #333;
    width: 60%;
    padding: 5px;
    text-align: center;
    background-color:  #CCC;
    border: 2px solid  #333;
    /* Do rounding (native in Firefox and Safari) */
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
}

}
</style>

	</head>
	<body>
    <div class= "aviso"><table cellpadding = "0" cellspacing="0" border="0" width="800" align="center">
    		<tr><td width="600" height="200" align="center" ><? echo "ERRO AO ACESSAR A BASE DE DADOS!"; ?></td></tr></table></div>

	</body>
</html>
	
<?
///********************************************* *************************************************************	

		exit();
	}
}
//monta a query que irá gravar as informações 
$sql= "UPDATE `$table` SET `quantidade`='$quantidadenova' WHERE (`id`='$indice')";

//grava as informações 
$grava = mysql_query($sql,$con); 

			
//conta o número de colunas afetadas. Se for 1, a gravação foi efetuada 
$num_linha = mysql_affected_rows();
 
if($num_linha == 1) {
//----------------------- HTML PRODUTO CADASTRADO COM SUCESSO	
?>
    	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resestoque.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resestoque.css" type="text/css" />
<script type="text/JavaScript" src="/curvycorners-2.1/curvycorners.js"></script>

<style>

.aviso {
	
    margin: 0.5in auto;
    color:  #333;
    width: 60%;
    padding: 5px;
    text-align: center;
    background-color:  #CCC;
    border: 2px solid  #333;
    /* Do rounding (native in Firefox and Safari) */
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
}

}
</style>

	</head>
	<body>
    <div class= "aviso"><table cellpadding = "0" cellspacing="0" border="0" width="800" align="center">
    		<tr><td width="600" height="200" align="center" ><? echo "<p align='center'>QUANTIDADE ALTERADA COM SUCESSO!</p> <br>";
			echo "<a href=http://www.pontoauto4x4.com.br/sistema/alt_estoque.html>VOLTAR...</a>"; ?></td></tr></table></div>

	</body>
</html>
<!--MOSTRA O PRODUTO CADSATRADO-->

	<?php
//include 'debuglib.php';
//mostra erros no código!
//error_reporting(E_ALL);
//ini_set('display_errors', '1');


//$id = $_REQUEST['id'];
// Conecta o banco e busca o registro

//conecta-se ao banco de dados
$mysql['servidor']	= "mysql03.pontoauto4x4.com.br";
$mysql['usuario']	= "pontoauto4x42";
$mysql['senha']		= "cr/4x4";
$mysql['banco']		= "pontoauto4x42";

$con = mysql_connect($mysql['servidor'],$mysql['usuario'],$mysql['senha']);
if($con == NULL)
{
	echo "ERRO AO CONECTAR COM O SERVIDOR!";
	exit();
}
else
{
	$bd = mysql_select_db($mysql['banco'],$con);
	if(!$bd)
	{
		echo "ERRO AO ACESSAR O BANCO DE DADOS!";
		exit();
	}
}

$query ="SELECT * FROM `pontoauto4x42` WHERE (`id`='$indice')";

$res = mysql_query($query); 
//
//conta o número de registros encontrados na pesquisa 
$num_reg = mysql_num_rows($res); 

while($linha = mysql_fetch_array($res)) {

// Conecta o banco e busca os registros

$linha['id'] = "id";
$marca = $linha['marca'];
$modelo = $linha['modelo'];
$motor = $linha['motor'];
$ano = $linha['ano'];
$peca = $linha['peca'];
$codigo = $linha['codigo'];
$corlata = $linha['corlata'];
$nportas = $linha['nportas'];
$precovista = $linha['precovista'];
$precoprazo = $linha['precoprazo'];
$quantidade = $linha['quantidade'];
$comentario = $linha['comentario'];
$filename = $linha['filename'];
$path = $linha['path'];
}
//-------------------------------------- MONTA A TABELA DE RESULTADOS -----------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resultado.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resultado.css" type="text/css" />
<script type="text/JavaScript" src="curvycorners-2.1/curvycorners.js"></script>

<style>

.titulo {
	
    margin: 0.5in auto;
    color:  #333;
    width: 60%;
    padding: 5px;
    text-align: center;
    background-color:  #CCC;
    border: 2px solid  #333;
    /* Do rounding (native in Firefox and Safari) */
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
}

.geral {
	
    margin: 0.5in auto;
    color:  #333;
    width: 60%;
    padding: 10px;
    text-align: center;
    background-color:  #CCC;
    border: 3px solid  #333;
    /* Do rounding (native in Firefox and Safari) */
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
}
</style>

	</head>
	<body>
    <div class= "titulo"><table cellpadding = "0" cellspacing="0" border="0" width="800" align="center">
    		<tr><td width="800" height="60" ><?php echo $marca." ".$modelo." ".$ano." "."Motor:"." ".number_format($motor, 1, '.', ',');?></td></tr></table></div>
		<div class="geral"><table cellpadding="0" cellspacing="0" border="0" width="800" align="center">
	
				<td width="400" height="300"><img src="<?php echo $path.$filename; ?>" border="1"  width="400" height="300" alt="" /></td>
				<td width="400" height="300"><table cellpadding="2" cellspacing="2" border="0" width="400">
					<tr>
						<td width="250" height="20">Marca:</td>
						<td width="300"><?php echo $marca ?></td>
					</tr>
					<tr>
						<td height="20">Modelo:</td>
						<td><?php echo $modelo; ?></td>
					</tr>
					<tr>
						<td height="20">Motor:</td>
						<td><?php echo number_format($motor, 1, '.', ','); ?></td>
					</tr>
					<tr>
						<td height="20">Ano:</td>
						<td><?php echo $ano; ?></td>
					</tr>
					<tr>
						<td height="20">Peça:</td>
						<td><?php echo $peca; ?></td>
					</tr>
					<tr>
                    	<td height="20">Código:</td>
						<td><?php echo $codigo; ?></td>
					</tr>
					<tr>
						<td height="20">Cor da Lata:</td>
						<td><?php echo $corlata; ?></td>
					</tr>
					<tr>
						<td height="20">Número de Portas:</td>
						<td><?php echo $nportas; ?></td>
					</tr>
					<tr>
						<td height="20">Preço à Vista:</td>
						<td><?php echo "R$"." ".number_format($precovista, 2, ',', '.'); ?></td>
					</tr>
					<tr>
                    <td height="20">Preço à Prazo:</td>
						<td><?php echo "R$"." ".number_format($precoprazo, 2, ',', '.'); ?></td>
					</tr>
					<tr>
                    
						<td height="20">Quantidade:</td>
						<td><?php echo $quantidade; ?></td>
					</tr>
                    <tr>
                    		<td height="20">Comentário:</td>
						<td><?php echo $comentario; ?></td>
					</tr>
				</table></td>
			</tr></table>
		</div>
	</body>
</html>
    
    
<?	
 //link para a página anterior  
//--------------------------------------------------------------------------------------------------------------------------------
                    }
					
else {
///********************************* HTML PARA MOSTRAR ERRO DE CADASTRO *************************************************************	
		
		?>
    	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resestoque.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resestoque.css" type="text/css" />
<script type="text/JavaScript" src="/sistema/curvycorners-2.1/curvycorners.js"></script>

<style>

.aviso {
	
    margin: 0.5in auto;
    color:  #333;
    width: 60%;
    padding: 5px;
    text-align: center;
    background-color:  #CCC;
    border: 2px solid  #333;
    /* Do rounding (native in Firefox and Safari) */
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
}

}
</style>

	</head>
	<body>
    <div class= "aviso"><table cellpadding = "0" cellspacing="0" border="0" width="800" align="center">
    		<tr><td width="600" height="200" align="center" ><? 
			echo "<p align='center'>FALHA AO ALTERAR QUANTIDADE!</p> <br>"; 
			echo "<p align='center'>VOLTE E TENTE ALTERAR NOVAMENTE...</p> <br>";
			//link para a página anterior
			echo "<a href=javascript:history.back()>VOLTAR...</a>";  ?></td></tr></table></div>

	</body>
</html>
	
<?
///**********************************************************************************************************		
	


//fecha a conexão 
//show_vars();					
}
mysql_close($con); 

?>