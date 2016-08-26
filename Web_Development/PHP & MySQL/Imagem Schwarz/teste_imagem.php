<?php
require_once("debuglib5.php");

$mysql['servidor']	= "127.0.0.1:3306";
$mysql['usuario']	= "usuario";
$mysql['senha']		= "senha";
$mysql['banco']		= "imagens";

$banco = mysql_connect($mysql['servidor'],$mysql['usuario'],$mysql['senha']);
if($banco == NULL)
{
	echo "Erro ao conectar o servidor!";
	exit();
}
else
{
	$lixo = mysql_select_db($mysql['banco'],$banco);
	if(!$lixo)
	{
		echo "Erro ao acessar a base de dados!";
		exit();
	}
	// Inserir imagens no banco
	if(isset($_REQUEST['henviado']))
	{
		if(is_uploaded_file($_FILES['ffoto']['tmp_name']))
		{
			$foto['conteudo']= file_get_contents($_FILES['ffoto']['tmp_name']);
			$foto['tamanho'] = getimagesize($_FILES['ffoto']['tmp_name']);
			$foto['mime'] = $foto['tamanho']['mime'];
			$sql = "INSERT INTO `imagens`(`codigo`,`conteudo`,`mime`) VALUES('','" . addslashes($foto['conteudo']) . "','" . $foto['mime'] . "')";
			$resp = mysql_query($sql,$banco);
		}
	}
	
	// Busca a ultima imagem
	$sql = "SELECT MAX(`codigo`) FROM `imagens`";
	$resp = mysql_query($sql,$banco);
	$linha = mysql_fetch_array($resp,MYSQL_NUM);
}

?>


<html>
	<head>
		<title>Entrada de Imagens</title>
	</head>
	<body>
		<form name="fimagem" enctype="multipart/form-data" action="teste_imagem.php" method="post">
			<input type="file" name="ffoto" size="50" /><br />
			<input type="hidden" name="henviado" value="1" />
			<input type="submit" value="Gravar" />
		</form>
		<br /><br />
		<img name="teste" src="teste_imagem2.php?codigo=<?php echo $linha[0]; ?>" />
	</body>
</html>