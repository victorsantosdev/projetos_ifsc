<?php

require_once("class.phpmailer.php");
require_once("class.smtp.php");

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
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$assunto = $_POST['assunto']; 
$mensagem = $_POST['mensagem'];

//substituir virgula por ponto no email
$email = str_replace(",",".",$email);

//remover espaços antes e depois 
trim($nome = $_POST['nome']); 

if ($telefone == "") {
	$telefone = "Telefone não disponibilizado.";
}

//cria uma nova instância da classe php mailer

$mail= new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth= true;		// enable SMTP authentication
$mail->Host= "smtp.pontoauto4x4.com.br";// sets the SMTP server
$mail->Port       = 587;	// set the SMTP port for the locaweb server
$mail->Username   = "evandro@pontoauto4x4.com.br";// SMTP account username
$mail->Password   = "pacr/4x4";	// SMTP account password
$mail->Subject = $assunto;
$mail->From = $email;
$mail->FromName = $nome;
$mail->AddAddress($mail->Username, "Evandro");
$mail->Body=$mensagem;
$mail->AltBody = $mail->Body; // optional, comment out and test
$enviado = $mail->Send();

if ($enviado)/* faz o envio da mensagem */
 {
	//
///*****************EMAIL ENVIADO CERTO *************************************************************	
		?>
    	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resbusca.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resbusca.css" type="text/css" />
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
			echo "<p align='center'>EMAIL ENVIADO COM SUCESSO!</p> <br>"; 
			//link para a página anterior
			echo "<a href=http://www.pontoauto4x4.com.br>VOLTAR...</a>";  ?></td></tr></table></div>

	</body>
</html>
<?	
	
	
   
  } else {
///************************EERO AO ENVIAR EMAIL *************************************************************	
		?>
    	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resbusca.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resbusca.css" type="text/css" />
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
			echo "<p align='center'>FALHA AO ENVIAR EMAIL!</p> <br>"; 
			//link para a página anterior
			echo "<a href=javascript:history.back()>VOLTAR...</a>";  ?></td></tr></table></div>

	</body>
</html> 

<?
 }
 } 
 else
  {
	 ///*************IMAGEM DE VERIFICACAO ERRADA *************************************************************	
		?>
    	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resbusca.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resbusca.css" type="text/css" />
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
			echo "<p align='center'>IMAGEM DE VERIFICAÇÃO ERRADA, VOLTE E TENTE NOVAMENTE!</p> <br>"; 
			//link para a página anterior
			echo "<a href=javascript:history.back()>VOLTAR...</a>";  ?></td></tr></table></div>

	</body>
</html>
<? 
 }
?>