

<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();
 
if ($securimage->check($_POST['captcha_txt'])) {
    // Código digitado corretamente
//    die("Ok, o código foi digitado corretamente.");

//recebe informações do formulário

//variaveis
$nome = $_POST['nome']; 
$sobrenome = $_POST['sobrenome'];
$login = strtolower($_POST['login']); 
$senha = $_POST['senha'];

//substituir virgula por ponto no email
$email = $_POST['email'];
$email = str_replace(",",".",$email);

//remover espaços antes e depois 
trim($nome = $_POST['nome']); 
trim($sobrenome = $_POST['sobrenome']); 
trim( $_POST['login']);
trim($senha = $_POST['senha']); 

//conecta-se ao banco de dados
$mysql['servidor']	= "localhost:8888";
$mysql['usuario']	= "root";
$mysql['senha']		= "root";
$mysql['banco']		= "users";

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

//###################################################################################//
//busca no banco se já existe login
$query = mysql_query("SELECT * FROM `users` WHERE (`login` LIKE '%$login%')");

if(mysql_num_rows($query) > 0) {

   echo "<p align='center'>Login j&aacute; existe, escolha outro.</p><br>";
    
echo "<p align='center'>VOLTE E TENTE CADASTRAR NOVAMENTE...</p> <br>";
//link para a página anterior 

echo "<a href=javascript:history.back()>VOLTAR...</a>"; 
} 


//else do query
else {
//monta a query que irá gravar as informações 

$sql = "INSERT INTO `users` VALUES(null,'$login','$nome','$sobrenome','$email','$senha')"; 

//grava as informações 
$grava = mysql_query($sql,$con); 


//conta o número de colunas afetadas. Se for 1, a gravação foi efetuada 
$num_linha = mysql_affected_rows();
 


if($num_linha == 1) {
  echo "<p align='center'>USUARIO CADASTRADO COM SUCESSO!</p> <br>"; 
//link para a página anterior 

  echo "<a href='learn.html'>Voltar &agrave; p&aacute;gina principal...</a>"; 

                    }//else do num_linha
					
else {
echo "<p align='center'>FALHA AO CADASTRAR USUARIO!</p> <br>"; 
echo "<p align='center'>VOLTE E TENTE CADASTRAR NOVAMENTE...</p> <br>";
//link para a página anterior 

echo "<a href=javascript:history.back()>VOLTAR...</a>"; 

//fecha a conexão 
					}
mysql_close($con); 
}
//##################################################################################

}
//else do if do captcha
else {
    // Código digitado não bate com a imagem
    echo("<p align='center'>Erro: C&oacute;digo digitado n&atilde;o bate com o c&oacute;digo da imagem.</p><br>");
	echo "<p align='center'>FALHA AO CADASTRAR USUARIO!</p> <br>"; 
echo "<p align='center'>VOLTE E TENTE CADASTRAR NOVAMENTE...</p> <br>";
//link para a página anterior 

echo "<a href=javascript:history.back()>VOLTAR...</a>"; 

}

?>