<?php 
include 'debuglib.php';
//mostra erros no código!
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

//##################################################################################//

//captura informações do formulário 
$modelo = $_REQUEST['modelo']; 
$motor = (float)($_REQUEST['motor']); 
$ano = intval($_REQUEST['ano']); 
$peca = $_REQUEST['peca']; 
$codigo = $_REQUEST['codigo']; 


//##################################################################################//

// Usa a função mysql_real_escape_string() para evitar erros no MySQL
//$modelo = mysql_real_escape_string($modelo);
//$motor = mysql_real_escape_string($motor);
//$ano = mysql_real_escape_string($ano);

//##################################################################################//

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
		<link rel="stylesheet" type="text/css" href="../Backup/Programming/Web_Development/Backup Ponto Auto/Cadastro e Busca - Pronto/resbusca.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="../Backup/Programming/Web_Development/Backup Ponto Auto/Cadastro e Busca - Pronto/resbusca.css" type="text/css" />
<script type="text/JavaScript" src="../Backup/Programming/Web_Development/Backup Ponto Auto/Cadastro e Busca - Pronto/curvycorners-2.1/curvycorners.js"></script>

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

$query="SELECT * FROM `$table` WHERE (`modelo` LIKE '%";
if ($modelo != "")
	$query = $query.$modelo;
$query = $query."%' AND `motor` LIKE '%";
if ($motor != "")
	$query = $query.$motor;
$query = $query."%' AND `ano` LIKE '%";
if($ano !="")
	$query = $query.$ano;
	$query = $query."%' AND `peca` LIKE '%";
if($peca !="")
	$query = $query.$peca;
	$query = $query."%' AND `codigo` LIKE '%";
if($codigo !="")
	$query = $query.$codigo;
$query = $query."%') ORDER by  `id`";
//$query = "SELECT * FROM `banco`";
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
        <script type="text/JavaScript">
        function paginacao (pagina)
		{ 
			document.teste.pagina.value = pagina;
			document.teste.submit();
		}
		        
        </script>

<script type="text/JavaScript" src="/curvycorners-2.1/curvycorners.js"></script>

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
$res = mysql_query($query,$con); 

//conta o número de registros encontrados na pesquisa 
while(($aux = mysql_fetch_array($res,MYSQL_ASSOC)) != FALSE) {
		$linha[] = $aux;
}
for($i = 0;$i < count($linha);$i++){
	echo "<a href=\"resultado.php?id=" . $linha[$i]['id'] . "\"> ". $linha[$i]['marca'] ." ". $linha[$i]['modelo']  ." ". $linha[$i]['ano'] ." "."Motor:"." ". $linha[$i]['motor'] ." ". $linha[$i]['peca'] ." ". $linha[$i]['codigo'] ." ".  $linha[$i]['corlata'] ." "."Portas:"." ". $linha[$i]['nportas'] . "</a><br />";
	echo"<br />";

}



 
?> 