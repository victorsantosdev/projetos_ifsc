<?php

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

// Conecta o banco e busca o registro

$linha['id'] = "id";
$linha['marca'] = "marca";
$linha['modelo'] = "modelo";
$linha['motor'] = "motor";
$linha['ano'] = "ano";
$linha['peca'] = "peca";
$linha['codigo'] = "codigo";
$linha['corlata'] = "corlate";
$linha['nportas'] = "nportas";
$linha['precovista'] = "preçovista";
$linha['precoprazo'] = "preçoprazo";
$linha['quantidade'] = "quantidade";
$linha['filename'] = "imagem.jpg";
$linha['path'] = "";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/resultado.css" />
		<title></title>
		<link rel="stylesheet" href="css/resultado.css" type="text/css" />
		<script language="javascript" type="text/javascript" src="includes/funcoes.js"></script>
	</head>
	<body>
		<div class="geral"><table cellpadding="0" cellspacing="0" border="0" width="800" align="center" bgcolor="#CCCCCC">
			<tr>
				<td width="400" height="300"><img src="<?php echo $linha['path'] . $linha['filename']; ?>" width="400" height="300" alt="" /></td>
				<td width="400" height="300"><table cellpadding="0" cellspacing="0" border="0" width="400">
					<tr>
						<td width="150" height="20">Marca:</td>
						<td width="250"><?php echo $linha['marca']; ?></td>
					</tr>
					<tr>
						<td height="20">Modelo:</td>
						<td><?php echo $linha['modelo']; ?></td>
					</tr>
					<tr>
						<td height="20">Motor:</td>
						<td><?php echo $linha['motor']; ?></td>
					</tr>
					<tr>
						<td height="20">Ano:</td>
						<td><?php echo $linha['ano']; ?></td>
					</tr>
					<tr>
						<td height="20">Peça:</td>
						<td><?php echo $linha['peca']; ?></td>
					</tr>
					<tr>
                    	<td height="20">Código:</td>
						<td><?php echo $linha['codigo']; ?></td>
					</tr>
					<tr>
						<td height="20">Cor da Lata:</td>
						<td><?php echo $linha['corlata']; ?></td>
					</tr>
					<tr>
						<td height="20">Número de Portas:</td>
						<td><?php echo $linha['nportas']; ?></td>
					</tr>
					<tr>
						<td height="20">Preço à Vista:</td>
						<td><?php echo $linha['precovista']; ?></td>
					</tr>
					<tr>
                    <td height="20">Preço à Prazo:</td>
						<td><?php echo $linha['precoprazo']; ?></td>
					</tr>
					<tr>
                    
						<td height="20">Quantdiade:</td>
						<td><?php echo $linha['quantidade']; ?></td>
					</tr>
				</table></td>
			</tr></table>
		</div>
	</body>
</html>