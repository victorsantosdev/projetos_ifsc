<?php
//include 'debuglib.php';
//mostra erros no código!
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$id = $_GET['id'];
// Conecta o banco e busca o registro

//conecta-se ao banco de dados
$mysql['servidor']	= "mysql03.pontoauto4x4.com.br";
$mysql['usuario']	= "pontoauto4x42";
$mysql['senha']		= "cr/4x4";
$mysql['banco']		= "pontoauto4x42";

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

$query ="SELECT * FROM `pontoauto4x42` WHERE (`id`='$id')";

$res = mysql_query($query); 
//
//conta o número de registros encontrados na pesquisa 
$num_reg = mysql_num_rows($res); 

while($linha = mysql_fetch_array($res)) {

// Conecta o banco e busca os registros

$linha['id'] = "id";
$marca = $linha['marca'];
$modelo = $linha['modelo'];
$motor = $linha['motor'];
$ano = $linha['ano'];
$peca = $linha['peca'];
$codigo = $linha['codigo'];
$corlata = $linha['corlata'];
$nportas = $linha['nportas'];
$precovista = $linha['precovista'];
$precoprazo = $linha['precoprazo'];
$quantidade = $linha['quantidade'];
$comentario = $linha['comentario'];
$filename = $linha['filename'];
$path = $linha['path'];
}
//-------------------------------------- MONTA A TABELA DE RESULTADOS -----------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="resultado.css" />
		<title>Resultado</title>
		<link rel="stylesheet"  href="resultado.css" type="text/css" />
<script type="text/JavaScript" src="curvycorners-2.1/curvycorners.js"></script>

<!-- SCRIPT DE VALIDACAO DO FORMULARIO-->    
    <script language="javascript"
            type="text/javascript">
//<![CDATA[
          function valida(form)

      {
        //marca
                   if(form.quantidadenova.value==""){ 
                        alert("Faltou preencher o campo QUANTIDADE."); 
                        return false; 
                                                                        } 

      return true; 
      } 
      //]]>
      </script>



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
	<body>
    <div class= "titulo"><table cellpadding = "0" cellspacing="0" border="0" width="800" align="center">
    		<tr><td width="800" height="60" ><?php echo $marca." ".$modelo." ".$ano." "."Motor:"." ".number_format($motor, 1, '.', ',');?></td></tr></table></div>
		<div class="geral"><table cellpadding="0" cellspacing="0" border="0" width="800" align="center">
							<td width="400" height="300"><img src="<?php echo $path.$filename; ?>" border="1"  width="400" height="300" alt="" /></td>
							<td width="250" height="300" style="vertical-align:top;">
                            <table cellpadding="1" cellspacing="1" border="0" width="250">
					<tr>
						<td width="250" height="20">Marca:</td> <!--imprimindo ID teste -->
						<td width="300"><?php echo $marca; ?></td>
					</tr>
					<tr>
						<td height="20">Modelo:</td>
						<td><?php echo $modelo; ?></td>
					</tr>
					<tr>
						<td height="20">Motor:</td>
						<td><?php echo  number_format($motor, 1, '.', ','); ?></td>
					</tr>
					<tr>
						<td height="20">Ano:</td>
						<td><?php echo $ano; ?></td>
					</tr>
					<tr>
						<td height="20">Peça:</td>
						<td><?php echo $peca; ?></td>
					</tr>
					<tr>
                    	<td height="20">Código:</td>
						<td><?php echo $codigo; ?></td>
					</tr>
					<tr>
						<td height="20">Cor da Lata:</td>
						<td><?php echo $corlata; ?></td>
					</tr>
					<tr>
						<td height="20">Nº de Portas:</td>
						<td><?php echo $nportas; ?></td>
					</tr>
					<tr>
						<td height="20">Preço à Vista:</td>
						<td><?php echo "R$"." ".number_format($precovista, 2, ',', '.'); ?></td>
					</tr>
					<tr>
                    <td height="20">Preço à Prazo:</td>
						<td><?php echo "R$"." ".number_format($precoprazo, 2, ',', '.'); ?></td>
					</tr>
					<tr>
                    
						<td height="20">Quantidade:</td>
						<td><?php echo $quantidade;?></td>
					</tr>
                    					<tr>
                    
						<td height="50">Comentário:</td>
						<td><?php echo $comentario;?></td>
					</tr>
                    
                    
				</table>
                </td>
                <td width="150" height="300" valign="top" style="vertical-align:top;">
                <table cellpadding="2" cellspacing="3" border="0" width="150">
                <tr><td>
                <form action="alteraestoque.php" enctype="multipart/form-data" method="POST" onsubmit="return valida(this)"> 
                        <input type="text"
               				name="marcanovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
                            
                        <input type="text"
               				name="modelonovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
                  
                       <input type="text"
               				name="motornovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
              
                      <input type="text"
               				name="anonovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
       
                     <input type="text"
               				name="pecanovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />

                     <input type="text"
               				name="codigonovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
       
                     <input type="text"
               				name="corlatanovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
                            
                     <input type="text"
               				name="nportasnovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
                            
                     <input type="text"
               				name="precovistanovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
                            
                     <input type="text"
               				name="precoprazonovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br />
                            
                     <input type="text"
               				name="quantidadenovo"
              			    size="20"
               				maxlenght="40"
               				value="" /><br /><hr />
                            
                     <input type="text"
                     name="comentarionovo" 
					size="20" 
                    maxlength="300"
					value=""/><br />
                            
               <input type="hidden" readonly="readonly"
               name="indice"
               size="3"
               value= "<?php echo "$id" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="marca"
               size="12"
               value= "<?php echo "$marca" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="modelo"
               size="20"
               value= "<?php echo "$modelo" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="motor"
               size="4"
               value= "<?php echo "$motor" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="ano"
               size="5"
               value= "<?php echo "$ano" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="peca"
               size="20"
               value= "<?php echo "$peca" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="codigo"
               size="20"
               value= "<?php echo "$codigo" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="corlata"
               size="10"
               value= "<?php echo "$corlata" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="nportas"
               size="4"
               value= "<?php echo "$nportas" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="precovista"
               size="8"
               value= "<?php echo "$precovista" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="precoprazo"
               size="8"
               value= "<?php echo "$precoprazo" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="quantidade"
               size="3"
               value= "<?php echo "$quantidade" ?>"/>
               
               <input type="hidden" readonly="readonly"
               name="comentario"
               size="50"
               value= "<?php echo "$comentario" ?>"/>
               
               
               <input type="hidden" readonly="readonly"
               name="filename"
               size="20"
               value= "<?php echo "$filename" ?>"/>
                              <br />
               <font face="Verdana, Geneva, sans-serif" size="-1">Alterar Imagem</font><br />
               <input type="file" name="fotonovo" size="10" /><br /><br />
               
               <input type="submit"
               name="submit"
               value="ALTERAR" /><!-- botão 'enviar' -->
                </form> 
                
                </td>
                </tr>
			</table>
            </td>
		</div>
	</body>
</html>
<?php // show_vars(); ?>