<?php
$mysql['servidor']	= "127.0.0.1:3306";
$mysql['usuario']	= "usuario";
$mysql['senha']		= "senha";
$mysql['banco']		= "imagens";

$banco = mysql_connect($mysql['servidor'],$mysql['usuario'],$mysql['senha']);
$lixo = mysql_select_db($mysql['banco'],$banco);

$sql = "SELECT * FROM `imagens` WHERE `codigo`='" . $_REQUEST['codigo'] . "'";
$resp = mysql_query($sql,$banco);
$linha = mysql_fetch_assoc($resp);

header("Content-type: " . $linha['mime']);
echo $linha['conteudo'];
?>