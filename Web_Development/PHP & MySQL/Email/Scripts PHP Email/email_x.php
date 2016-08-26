<?php

error_reporting(E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

require_once("includes/class.phpmailer.php");

$mail	= new PHPMailer();

//$body = file_get_contents('contents.html');
//$body = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
										// enables SMTP debug information (for testing)
																						// 1 = errors and messages
																						// 2 = messages only
$mail->SMTPAuth   = true;										// enable SMTP authentication
$mail->Host       = "hermes.ifsc.edu.br";		// sets the SMTP server
$mail->Port       = 25;											// set the SMTP port for the GMAIL server
$mail->Username   = "usuario";					// SMTP account username
$mail->Password   = "senha";							// SMTP account password

$mail->SetFrom('ilhadigital@ifsc.edu.br', 'Leandro Schwarz');
$mail->AddReplyTo('ilhadigital@ifsc.edu.br', 'Leandro Schwarz');
$mail->Subject = "PHPMailer Test Subject via smtp, basic with authentication";
$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML("teste");
$address = "leandroschwarz@gmail.com";
$mail->AddAddress($address, "Leandro Schwarz 2");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

/*

// Monta o e-mail
$email['remetente_nome']     = "Forum CTS";
$email['remetente_email']    = "forumcts@ifsc.edu.br";
$email['destinatario_nome']  = "Leandro Schwarz";
$email['destinatario_email'] = "leandroschwarz@gmail.com";
$email['cabecalho']          = "From: ". $email['remetente_nome'] . " <" . $email['remetente_email'] . ">\r\nContent-type: text/html; charset=iso-8859-1\r\n";
$email['assunto']            = "Revista Ilha Digital - Valide seu email";
$email['mensagem']           = "dasa";
/*
$email['mensagem']           = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"pt-br\">
	<head>
		<title>Ilha Digital</title>
		<meta http-equiv=\"Content-Type\" content=\"text/html;charset=ISO-8859-1\" />
		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE7\" />
		<style type=\"text/css\">
			body{margin-bottom: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; background-color: #ffffff;}
			td.padrao{font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;}
			li.dados{font-family: 'Courier New', Courier, mono; font-size: 12px;}
		</style>
  </head>
	<body style=\"background-color: #ffffff;\">
		<table cellpadding=\"0\" cellspacing=\"0\" width=\"756\" border=\"0\" align=\"center\">
			<tr>
				<td style=\"width: 756px;height: 167px;background-color: #cccccc;\"><img src=\"" . $link['revista'] . "imagens/testada.jpg\" width=\"756\" height=\"167\" alt=\"\" style=\"border-width: 0px;\" usemap=\"#m_testada\" /></td>
			</tr>
			<tr>
				<td style=\"width: 756px;height: 15px;background-color: #cccccc;\"></td>
			</tr>
			<tr>
				<td style=\"width: 756px;height: 500px; vertical-align: top;\" class=\"padrao\"><p>Prezado Sr. " . $email['destinatario_nome'] . ",<br />Obrigado por seu cadastro na " . $revista['titulo'] . ".</p><br />
				<p>Os dados referentes ao seu cadastro são:</p>
				<ul>
					<li class=\"dados\">Usuário:&nbsp;" . $lixo['usuario'] . "</li>
					<li class=\"dados\">Senha:&nbsp;&nbsp;&nbsp;" . $lixo['senha'] . "</li>
				</ul>
				<p>Gostaríamos de salientar que o seu endereço de e-mail no sistema deve ser validado antes que seu acesso seja autorizado. Isto pode ser feito através do link a seguir:</p>
				<p><a href=\"" . $link['revista'] . "autenticaemail.php?codigo=" . $lixo['autenticador'] . "\">Validar seu e-mail</a></p><br />
				<p>Em caso de dúvidas favor enviar um e-mail para:</p>
				<p>sa</p>
				<p>Atenciosamente,<br />Revista Ilha Digital</p></td>
			</tr>
		</table>
	</body>
</html>";


// Send
if(mail($email['destinatario_email'],$email['assunto'],$email['mensagem'],$email['cabecalho']))
	echo "foi";
else
	echo "não foi";
*/
?>