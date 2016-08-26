<?php 

//mostra erros no código!
error_reporting(E_ALL);
ini_set('display_errors', '1');

//##################################################################################//

//captura informações do formulário 
$modelo = $_POST['modelo']; 
$motor = (float)($_POST['motor']); 
$ano = intval($_POST['ano']); 

//##################################################################################//

// Usa a função mysql_real_escape_string() para evitar erros no MySQL
$modelo = mysql_real_escape_string($modelo);
$motor = mysql_real_escape_string($motor);
$ano = mysql_real_escape_string($ano);

//##################################################################################//

//conecta-se ao banco de dados
$mysql['servidor']	= "localhost:8888";
$mysql['usuario']	= "root";
$mysql['senha']		= "root";
$mysql['banco']		= "banco";

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

//##################################################################################//


//condição para digitar somente o modelo
if ($motor == 0 && $ano == 0)
{
	$query ="SELECT * FROM `banco` WHERE (`modelo` LIKE '%$modelo%') ORDER BY `id`";

//executa a query 
$res = mysql_query($query); 

//conta o número de registros encontrados na pesquisa 
$num_reg = mysql_num_rows($res); 


while($mostra = mysql_fetch_array($res)) {

$indice = $mostra['id'];
$marca = $mostra['marca'];
$modelo = $mostra['modelo'];
$ano = $mostra['ano'];
$motor = $mostra['motor'];
$peca = $mostra['part'];
$corlata = $mostra['corlata'];
$nportas = $mostra['nportas'];
$preco = $mostra['preco'];
$quantidade = $mostra['quantidade'];
$imagem = $mostra['filename'];
$caminho = $mostra['path'];



echo "<tr>"; 
//exibe os resultados 
echo "<td><br /> $indice  </td>";
echo "<td> $marca </td>"; 
echo "<td> $modelo </td>"; 
echo "<td> $ano </td>";
echo "<td> $motor </td>";
echo "<td> $peca </td>";
echo "<td> $corlata </td>";
echo "<td> $nportas </td>";
echo "<td> $quantidade </td>";
echo "<td> $preco </td>"; 
//mostra a imagem correspondente
echo "<td><a href='$caminho$imagem'><font>imagem</font><br /></a></td>";
echo "</tr>"; 
} 

//informa a quantidade de registros encontrados 
echo "<br /> <br /> $num_reg Resultados Encontrados<br />"; 


//encerra a conexão mysq

mysql_close($con); 

}

//##################################################################################//

else if ($motor == 0)
{
	$query ="SELECT * FROM `banco` WHERE (`modelo` LIKE '%$modelo%') AND (`ano` LIKE '%$ano%') ORDER BY `id`";

//executa a query 
$res = mysql_query($query); 

//conta o número de registros encontrados na pesquisa 
$num_reg = mysql_num_rows($res); 


while($mostra = mysql_fetch_array($res)) {

$indice = $mostra['id'];
$marca = $mostra['marca'];
$modelo = $mostra['modelo'];
$ano = $mostra['ano'];
$motor = $mostra['motor'];
$peca = $mostra['part'];
$corlata = $mostra['corlata'];
$nportas = $mostra['nportas'];
$preco = $mostra['preco'];
$quantidade = $mostra['quantidade'];
$imagem = $mostra['filename'];
$caminho = $mostra['path'];

echo "<tr>"; 
//exibe os resultados 
echo "<td><br /> $indice  </td>";
echo "<td> $marca </td>"; 
echo "<td> $modelo </td>"; 
echo "<td> $ano </td>";
echo "<td> $motor </td>";
echo "<td> $peca </td>";
echo "<td> $corlata </td>";
echo "<td> $nportas </td>";
echo "<td> $quantidade </td>";
echo "<td> $preco </td>"; 
//mostra a imagem correspondente
echo "<td><a href='$caminho$imagem'><font>imagem</font><br /></a></td>";
echo "</tr>"; 
} 

//informa a quantidade de registros encontrados 
echo "<br /> <br /> $num_reg Resultados Encontrados<br />"; 


//encerra a conexão mysq

mysql_close($con); 

}

//##################################################################################//

else if ($ano == 0){

//monta a query de busca, inserindo o nome como parâmetro  
$query ="SELECT * FROM `banco` WHERE (`modelo` LIKE '%$modelo%') AND (`motor` LIKE '%$motor%') ORDER BY `id`"; 

//executa a query 
$res = mysql_query($query); 

//conta o número de registros encontrados na pesquisa 
$num_reg = mysql_num_rows($res); 


while($mostra = mysql_fetch_array($res)) {

$indice = $mostra['id'];
$marca = $mostra['marca'];
$modelo = $mostra['modelo'];
$ano = $mostra['ano'];
$motor = $mostra['motor'];
$peca = $mostra['part'];
$corlata = $mostra['corlata'];
$nportas = $mostra['nportas'];
$preco = $mostra['preco'];
$quantidade = $mostra['quantidade'];
$imagem = $mostra['filename'];
$caminho = $mostra['path'];

echo "<tr>"; 
//exibe os resultados 
echo "<td><br /> $indice  </td>";
echo "<td> $marca </td>"; 
echo "<td> $modelo </td>"; 
echo "<td> $ano </td>";
echo "<td> $motor </td>";
echo "<td> $peca </td>";
echo "<td> $corlata </td>";
echo "<td> $nportas </td>";
echo "<td> $quantidade </td>";
echo "<td> $preco </td>"; 
//mostra a imagem correspondente
echo "<td><a href='$caminho$imagem'><font>imagem</font><br /></a></td>";
echo "</tr>"; 
} 

//informa a quantidade de registros encontrados 
echo "<br /> <br /> $num_reg Resultados Encontrados<br />"; 


//encerra a conexão mysq

mysql_close($con); 
 }

//##################################################################################// 
 else {

//monta a query de busca, inserindo o nome como parâmetro  
$query ="SELECT * FROM `banco` WHERE (`modelo` LIKE '%$modelo%') AND (`motor` LIKE '%$motor%') AND (`ano` LIKE '%$ano%') ORDER BY `id`"; 

//executa a query 
$res = mysql_query($query); 

//conta o número de registros encontrados na pesquisa 
$num_reg = mysql_num_rows($res); 


while($mostra = mysql_fetch_array($res)) {

$indice = $mostra['id'];
$marca = $mostra['marca'];
$modelo = $mostra['modelo'];
$ano = $mostra['ano'];
$motor = $mostra['motor'];
$peca = $mostra['part'];
$corlata = $mostra['corlata'];
$nportas = $mostra['nportas'];
$preco = $mostra['preco'];
$quantidade = $mostra['quantidade'];
$imagem = $mostra['filename'];
$caminho = $mostra['path'];

echo "<tr>"; 
//exibe os resultados 
echo "<td><br /> $indice  </td>";
echo "<td> $marca </td>"; 
echo "<td> $modelo </td>"; 
echo "<td> $ano </td>";
echo "<td> $motor </td>";
echo "<td> $peca </td>";
echo "<td> $corlata </td>";
echo "<td> $nportas </td>";
echo "<td> $quantidade </td>";
echo "<td> $preco </td>"; 
//mostra a imagem correspondente
echo "<td><a href='$caminho$imagem'><font>imagem</font><br /></a></td>";
echo "</tr>"; 
} 

//informa a quantidade de registros encontrados 
echo "<br /> <br /> $num_reg Resultados Encontrados<br />"; 


//encerra a conexão mysq

mysql_close($con); 
 }
 
 
?> 