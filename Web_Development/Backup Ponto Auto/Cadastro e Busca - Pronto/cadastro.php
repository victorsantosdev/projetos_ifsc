<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

//recebe informações do formulário

//variaveis
$marca = $_REQUEST['marca']; 
$modelo = $_REQUEST['modelo'];
$ano = intval($_REQUEST['ano']); 
$peca = $_REQUEST['peca'];
$codigo = $_REQUEST['codigo'];
$motor = (float)($_REQUEST['motor']);
$corlata = $_REQUEST['corlata']; 
$nportas = intval($_REQUEST['nportas']);
$quantidade = intval($_REQUEST['quantidade']);

//substituir virgula por ponto no preço a vista
$precovista = $_REQUEST['precovista'];
$precovista = str_replace(",",".",$precovista);
$precovista = (float)($_REQUEST['precovista']);

//substituir virgula por ponto no preço a prazo
$precoprazo = $_REQUEST['precoprazo'];
$precoprazo = str_replace(",",".",$precoprazo);
$precoprazo = (float)($_REQUEST['precoprazo']);

//remover espaços antes e depois 
trim($marca = $_REQUEST['marca']); 
trim($modelo = $_REQUEST['modelo']); 
trim($part = $_REQUEST['peca']);
trim($corlata = $_REQUEST['corlata']); 
trim($codigo = $_REQUEST['codigo']);

//conecta-se ao banco de dados
$mysql['servidor']	= "mysql01.pontoauto4x4.com.br";
$mysql['usuario']	= "pontoauto4x4";
$mysql['senha']		= "cr/4x4";
$mysql['banco']		= "estoque";

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
$image_path = "http://pontoauto4x4.tempsite.ws/sistema_estoque/imagens/";
$foto_tmp = $_FILES['foto']['tmp_name'];

//envia a foto pra a pasta imagens

move_uploaded_file($foto_tmp,$image_path.$foto);

//monta a query que irá gravar as informações 

$sql = "INSERT INTO `estoque` VALUES(null,'$marca','$modelo','$ano','$motor','$peca','$codigo','$preco','$corlata','$nportas','$precovista','$precoprazo','$quantidade','$foto','$image_path')"; 

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
include('http://pontoauto4x4.tempsite.ws/sistema_estoque/m2brimagem.class.php');
$oImg = new m2brimagem($image_path.$foto);
$oImg->redimensiona(400,300,'crop');
$oImg->grava($image_path.$foto,100);
?>