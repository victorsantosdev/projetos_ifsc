<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

//recebe informações do formulário

//variaveis
$marca = $_POST['marca']; 
$modelo = $_POST['modelo'];
$ano = intval($_POST['ano']); 
$part = $_POST['part'];
$motor = (float)($_POST['motor']);
$corlata = $_POST['corlata']; 
$nportas = intval($_POST['nportas']);
$quantidade = intval($_POST['quantidade']);

//substituir virgula por ponto no preço
$preco = $_POST['preco'];
$preco = str_replace(",",".",$preco);
$preco = (float)($_POST['preco']);


//remover espaços antes e depois 
trim($marca = $_POST['marca']); 
trim($modelo = $_POST['modelo']); 
trim($part = $_POST['part']);
trim($corlata = $_POST['corlata']); 

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
		echo "ERRO AO ACESSAR A BASE DE DADOS!";
		exit();
	}
}
//tratamento de imagens

$foto = $_FILES['foto']['name'];
$image_path = "imagens/";
$foto_tmp = $_FILES['foto']['tmp_name'];

//envia a foto pra a pasta imagens

move_uploaded_file($foto_tmp,$image_path.$foto);

//monta a query que irá gravar as informações 

$sql = "INSERT INTO `banco` VALUES(null,'$marca','$modelo','$ano','$motor','$part','$preco','$corlata','$nportas','$foto','$image_path','$quantidade')"; 

//grava as informações 
$grava = mysql_query($sql,$con); 

			
//conta o número de colunas afetadas. Se for 1, a gravação foi efetuada 
$num_linha = mysql_affected_rows();
 
if($num_linha == 1) {
  echo "<p align='center'>PRODUTO CADASTRADO COM SUCESSO!</p> <br>"; 
//link para a página anterior 

  echo "<a href=javascript:history.back()>VOLTAR...</a>"; 

                    }
					
else {
echo "<p align='center'>FALHA AO CADASTRAR PRODUTO!</p> <br>"; 
echo "<p align='center'>VOLTE E TENTE CADASTRAR NOVAMENTE...</p> <br>";
//link para a página anterior 

echo "<a href=javascript:history.back()>VOLTAR...</a>"; 

//fecha a conexão 
					}
mysql_close($con); 

//redimensiona imagem!
include('m2brimagem.class.php');
$oImg = new m2brimagem($image_path.$foto);
$oImg->redimensiona(400,300,'crop');
$oImg->grava($image_path.$foto,100);
?>