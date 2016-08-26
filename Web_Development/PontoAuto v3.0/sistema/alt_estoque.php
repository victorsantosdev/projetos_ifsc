<?php 
//include 'debuglib.php';
//mostra erros no código!
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

//##################################################################################//

//captura informações do formulário 
$modelo = $_GET['modelo']; 
$motor = $_GET['motor']; 
$ano = intval($_GET['ano']); 
$peca = $_GET['peca']; 
$codigo = $_GET['codigo']; 

//if ($_GET['motor']== (1.0) ||$_GET['motor']==(2.0)||$_GET['motor']==(3.0)||$_GET['motor']==(4.0)||$_GET['motor']==(5.0)||$_GET['motor']==(6.0)||$_GET['motor']==(7.0)||$_GET['motor']==(8.0)||$_GET['motor']==(9.0)){
// $_GET['motor']= intval($_GET['motor']);	
//}

//conecta-se ao banco de dados
$mysql['servidor']	= "mysql03.pontoauto4x4.com.br";
$mysql['usuario']	= "pontoauto4x42";
$mysql['senha']		= "cr/4x4";
$mysql['banco']		= "pontoauto4x42";
$table = $mysql['banco'];
$con = mysql_connect($mysql['servidor'],$mysql['usuario'],$mysql['senha']);
if($con == NULL)
{
//---------------------------- HTML ERRO DE CONEXAO --------------------------------------	
?>	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resbusca.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resbusca.css" type="text/css" />
<script type="text/JavaScript" src="curvycorners-2.1/curvycorners.js"></script>

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
//-----------------------------------------------------------------------------------------------------------------------------
exit();
}
else
{
	$bd = mysql_select_db($mysql['banco'],$con);
	if(!$bd)
	{
//--------------------------------------- HTML ERRO AO CONECTAR COM O BD ---------------------------------------------------------		
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resbusca.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resbusca.css" type="text/css" />
<script type="text/JavaScript" src="curvycorners-2.1/curvycorners.js"></script>

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
    		<tr><td width="600" height="200" align="center" ><? echo "ERRO AO ACESSAR O BANCO DE DADOS!"; ?></td></tr></table></div>

	</body>
</html>
	<?	
		exit();
	}
}

//##################################################################################//

$campo_query = "*";
$query_temp = "FROM `$table` WHERE (`modelo` LIKE '%";
if ("{$_GET['modelo']}" != "")
	$query_temp = $query_temp."{$_GET['modelo']}";
$query_temp = $query_temp."%' AND `motor` LIKE '%";
if ("{$_GET['motor']}" != "")
	$query_temp = $query_temp."{$_GET['motor']}";
$query_temp = $query_temp."%' AND `ano` LIKE '%";
if("{$_GET['ano']}" !="")
	$query_temp = $query_temp."{$_GET['ano']}";
	$query_temp = $query_temp."%' AND `peca` LIKE '%";
if("{$_GET['peca']}" !="")
	$query_temp = $query_temp."{$_GET['peca']}";
	$query_temp = $query_temp."%' AND `codigo` LIKE '%";
if("{$_GET['codigo']}" !="")
	$query_temp = $query_temp."{$_GET['codigo']}";
$query_temp = $query_temp."%')";


$nposts = 10;
$pagina	= (isset($_GET['pagina'])) ? (int)$_GET['pagina']: 1;
$inicio = ($nposts * $pagina) - $nposts;

$query_pronta = "SELECT $campo_query $query_temp ORDER by `id` ASC LIMIT $inicio,$nposts";

//show_vars();
//print_a($query); 

//------------------------ HTML MOSTRAR RESULTADOS DA BUSCA --------------------------------
?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resbusca.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resbusca.css" type="text/css" />

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
	<body bgcolor="#F2F2F2">
    <div class= "titulo"><table cellpadding = "0" cellspacing="0" border="0" width="800" align="center">
    		<tr><td width="800" height="60" align="center" >RESULTADOS DA BUSCA</td></tr></table></div>
		<div class="geral"><table cellpadding="0" cellspacing="0" border="0" width="800" height="300" align="center">
					<? 
//------------------------------------------------------------------------------------------------------------------	

//executa a query 
$qr = mysql_query($query_pronta); 

//conta o número de registros encontrados na pesquisa 
while($linha = mysql_fetch_array($qr)) {

echo "<a href=\"res_estoque.php?id=" . $linha['id'] . "\"> ". $linha['marca'] ." ". $linha['modelo']  ." ". $linha['ano'] ." "."Motor:"." ". $linha['motor'] ." ". $linha['peca'] ." ". $linha['codigo'] ." ".  $linha['corlata'] ." "."Portas:"." ". $linha['nportas'] . "</a><br />";
	echo"<br />";	
}

$sqlTotal = "SELECT `id` $query_temp";
$qrTotal = mysql_query($sqlTotal);
$numTotal = mysql_num_rows($qrTotal);
$totalPagina = ceil($numTotal/$nposts);


$menos = $pagina - 1;
$mais = $pagina + 1;
	
if($totalPagina > 1 ) {
 
	echo "<br />";
 
    // Mostragem de pagina
    if($menos > 0) {
		echo "<a href=".$_SERVER['PHP_SELF']."?pagina=$menos&modelo=".$_GET['modelo']."&motor=".$_GET['motor']."&ano=".$_GET['ano']."&peca=".$_GET['peca']."&codigo=".$_GET['codigo'].">anterior</a>&nbsp; ";
    }
 
    // Listando as paginas
	for($i=1;$i <= $totalPagina;$i++) {
		if($i != $pagina) {
			echo " <a href=".$_SERVER['PHP_SELF']."?pagina=". $i ."&modelo=".$_GET['modelo']."&motor=".$_GET['motor']."&ano=".$_GET['ano']."&peca=".$_GET['peca']."&codigo=".$_GET['codigo'].">$i</a> | ";
		} else {
			echo " <strong>".$i."</strong> | ";
		}
	}
 
	if($mais <= $totalPagina) {
		echo " <a href=".$_SERVER['PHP_SELF']."?pagina=$mais&modelo=".$_GET['modelo']."&motor=".$_GET['motor']."&ano=".$_GET['ano']."&peca=".$_GET['peca']."&codigo=".$_GET['codigo'].">próxima</a>";
	}
}
	
 
//show_vars();
//print_a($qr); 
 
?>