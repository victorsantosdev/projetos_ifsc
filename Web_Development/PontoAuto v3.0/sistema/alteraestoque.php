<?php

//include 'debuglib.php';
//mostra erros no código!
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
ini_set('display_errors', 'Off');

$indice = intval($_POST['indice']);
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$motor = $_POST['motor'];
$ano = intval($_POST['ano']);
$peca = $_POST['peca'];
$codigo = $_POST['codigo'];
$corlata = $_POST['corlata'];
$nportas = intval($_POST['nportas']);
$quantidade = intval($_POST['quantidade']);
$comentario = $_POST['comentario'];
$foto = $_POST['filename'];
$image_path = "imagens/";
//recebe informações do formulário

//variaveis
$marcanovo = $_REQUEST['marcanovo'];
$modelonovo = $_REQUEST['modelonovo'];
$motornovo = $_REQUEST['motornovo'];
$anonovo = intval($_REQUEST['anonovo']);
$pecanovo = $_REQUEST['pecanovo'];
$codigonovo = $_REQUEST['codigonovo'];
$corlatanovo = $_REQUEST['corlatanovo'];
$nportasnovo = $_REQUEST['nportasnovo'];
$quantidadenovo = intval($_REQUEST['quantidadenovo']);
$comentarionovo = $_REQUEST['comentarionovo'];

if ((strcmp($pecanovo,"Módulo") == 0)||(strcmp($pecanovo,"módulo") ==0)){
	$pecanovo = "Modulo";
}

if (strcmp($nportasnovo,"0") == 0){
	$nportasnovo = "Produto não necessita desta informação";
}

if (strcmp($comentarionovo,"") == 0){
	$comentarionovo = "Produto não comentado";
}



//substituir virgula por ponto no preço a vista
$precovistanovo = $_REQUEST['precovistanovo'];
$precovistanovo = str_replace(",",".",$precovistanovo);
//$precovistanovo = (float)($precovistanovo);

//substituir virgula por ponto no preço a prazo
$precoprazonovo = $_REQUEST['precoprazonovo'];
$precoprazonovo = str_replace(",",".",$precoprazonovo);
//$precoprazonovo = (float)($precoprazonovo);

//remover espaços antes e depois 
trim($marcanovo = $_REQUEST['marcanovo']); 
trim($modelonovo = $_REQUEST['modelonovo']); 
trim($pecanovo = $_REQUEST['pecanovo']);
trim($corlatanovo = $_REQUEST['corlatanovo']); 
trim($codigonovo = $_REQUEST['codigonovo']);

$excluir = $_POST['excluir'];
//-------------------------------TESTE SE A OPÇÃO DE EXCLUIR FOI MARCADA

if(isset($excluir) && ($excluir==1))
{
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

$query ="DELETE FROM `pontoauto4x42` WHERE (`id`='$indice')";
$res = mysql_query($query); 
mysql_close($con); 
	
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
			echo "<p align='center'>REGISTRO EXCLUIDO!</p> <br>";
			//link para a página anterior
			echo "<a href=http://www.pontoauto4x4.com.br/sistema/alt_estoque.html>VOLTAR...</a>";  ?></td></tr></table></div>

	</body>
</html>
	
<?php
}
else
{

//----------------------------------------------------------
//roda o programa normalmente

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
	
<?php
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
	
<?php
///********************************************* *************************************************************	

		exit();
	}
}

$query_temp = "SET `marca`=";
if ($marcanovo == ''){
	$query_temp = $query_temp. "'$marca'";}
	else {
			$query_temp = $query_temp. "'$marcanovo'";}

$query_temp = $query_temp.",`modelo`=";
if ($modelonovo == ''){
	$query_temp = $query_temp."'$modelo'";}
else {
			$query_temp = $query_temp. "'$modelonovo'";}	
$query_temp = $query_temp.",`motor`=";
if($motornovo ==''){
	$query_temp = $query_temp."'$motor'";}
	else {
			$query_temp = $query_temp. "'$motornovo'";}
	$query_temp = $query_temp.",`ano`=";
if($anonovo ==''){
	$query_temp = $query_temp."'$ano'";}
	else {
			$query_temp = $query_temp. "'$anonovo'";}
	$query_temp = $query_temp.",`peca`=";
if($pecanovo ==''){
	$query_temp = $query_temp. "'$peca'";}
	else {
			$query_temp = $query_temp. "'$pecanovo'";}
if ($codigo =='' and $codigonovo==''){}
	else {		
			$query_temp = $query_temp.",`codigo`=";
			$query_temp = $query_temp. "'$codigonovo'";}
if ($codigo !='' and $codigonovo==''){}
	else {		
			$query_temp = $query_temp.",`codigo`=";
			$query_temp = $query_temp. "'$codigo'";}

if($corlata =='' and $corlatanovo==''){}
	else {
			$query_temp = $query_temp.",`corlata`=";
			$query_temp = $query_temp. "'$corlatanovo'";}
			
if($corlata !='' and $corlatanovo==''){
			$query_temp = $query_temp.",`corlata`=";
			$query_temp = $query_temp. "'$corlata'";}
						
	$query_temp = $query_temp.",`nportas`=";
if($nportasnovo ==''){
	$query_temp = $query_temp. "'$nportas'";}
	else {
			$query_temp = $query_temp. "'$nportasnovo'";}
	$query_temp = $query_temp.",`precovista`=";
if($precovistanovo ==''){
	$query_temp = $query_temp. "'$precovista'";}
	else {
			$query_temp = $query_temp. "'$precovistanovo'";}
	$query_temp = $query_temp.",`precoprazo`=";
if ($precoprazonovo == ''){
	$query_temp = $query_temp. "'$precoprazo'";}
	else {
			$query_temp = $query_temp. "'$precoprazonovo'";}

$query_temp = $query_temp.",`quantidade`=";
if($quantidadenovo ==''){
	$query_temp = $query_temp. "'$quantidade'";}
	else {
			$query_temp = $query_temp. "'$quantidadenovo'";}

if($comentario !='' and $comentarionovo==''){}
	else {
			$query_temp = $query_temp.",`comentario`=";
			$query_temp = $query_temp. "'$comentario'";}

if(($comentario !='' and $comentarionovo!='') or ($comentario == '' and $comentarionovo !='')){
	
			$query_temp = $query_temp.",`comentario`=";
			$query_temp = $query_temp. "'$comentarionovo'";}




if(($foto != NULL) and ($_FILES['fotonovo']['name']=='')){}
else{
	//tratamento de imagens
$fotonovo = $_FILES['fotonovo'];
$fotonovo = $_FILES['fotonovo']['name'];
$foto_tmp = $_FILES['fotonovo']['tmp_name'];
$query_temp = $query_temp.",`filename`=";
	
//envia a foto pra a pasta imagens
move_uploaded_file($foto_tmp,$image_path.$fotonovo);
$query_temp = $query_temp. "'$fotonovo'";
}

//monta a query que irá gravar as informações 
$sql= "UPDATE `$table` $query_temp WHERE (`id`='$indice')";

//grava as informações 
$grava = mysql_query($sql,$con); 

//redimensiona imagem e insere a marca dagua da loja!
include('m2brimagem.class.php');
$oImg = new m2brimagem($image_path.$fotonovo);
$oImg->redimensiona(400,300,'crop');
$oImg->marca('watermark.png',5,150,NULL);
$oImg->grava($image_path.$fotonovo,100);
			
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
    		<tr><td width="600" height="200" align="center" ><? echo "<p align='center'>REGISTROS ALTERADOS COM SUCESSO!</p> <br>";
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
    		<tr><td width="800" height="60" ><?php echo $marca." ".$modelo." ".$ano." "."Motor:"." ".$motor;?></td></tr></table></div>
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
						<td><?php echo $motor; ?></td>
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
						<td><?php echo "R$"." ".$precovista; ?></td>
					</tr>
					<tr>
                    <td height="20">Preço à Prazo:</td>
						<td><?php echo "R$"." ".$precoprazo; ?></td>
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
    
    
<?	//show_vars();
 //link para a página anterior  
//--------------------------------------------------------------------------------------------------------------------------------
                    }
					
if ($num_linha == 0){
	
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
			echo "<p align='center'>NADA A ALTERAR, REGISTROS IGUAIS!</p> <br>"; 
			//link para a página anterior
			echo "<a href=javascript:history.back()>VOLTAR...</a>"; ?></td></tr></table></div>

	</body>
</html>
<?php //show_vars(); ?>
<?php					
}
else if ($num_linha!=0 && $num_linha!=1){
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
			echo "<p align='center'>FALHA AO ALTERAR REGISTRO!</p> <br>"; 
			echo "<p align='center'>VOLTE E TENTE ALTERAR NOVAMENTE...</p> <br>";
			//link para a página anterior
			echo "<a href=javascript:history.back()>VOLTAR...</a>";  ?></td></tr></table></div>

	</body>
</html>
	
<?php
///**********************************************************************************************************		
	


//fecha a conexão 
//show_vars();					
}
mysql_close($con); 
}
?>