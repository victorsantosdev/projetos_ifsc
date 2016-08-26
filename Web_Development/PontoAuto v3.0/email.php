<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Fale Conosco</title>
	<link rel="stylesheet" type="text/css" href="./email.css" media="all" />
	<!--[if IE]>
	<style type="text/css" media="all">.borderitem {border-style: solid;}</style>
	<![endif]-->
 <script language="javascript"
            type="text/javascript">
//<![CDATA[
          function valida(form)

      {
                             

      //nome
                        if(form.nome.value==""){ 
                        alert("Faltou preencher o campo NOME."); 
                        return false; 
                                                                        } 

      //email
                  if(form.email.value==""){ 
                  alert("Faltou preencher o campo EMAIL."); 
                  return false; 
                                                                  }  

      //assunto
                  if(form.assunto.value==""){ 
                  alert("Faltou preencher o campo ASSUNTO."); 
                  return false; 
                                                                  } 

      //mensagem
                  if(form.mensagem.value==""){ 
                  alert("Faltou preencher o campo MENSAGEM."); 
                  return false; 
                                                                  } 
      if (ValidCaptcha() == false){
		  return false;
	  }

      return true; 
      } 
      //]]>

   //Created / Generates the captcha function    
    function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';  
        var e = Math.ceil(Math.random() * 10)+ '';  
        var f = Math.ceil(Math.random() * 10)+ '';  
        var g = Math.ceil(Math.random() * 10)+ '';  
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;
        document.getElementById("txtCaptcha").value = code
    }

    // Validate the Entered input aganist the generated security code function   
    function ValidCaptcha(){
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        var str2 = removeSpaces(document.getElementById('txtInput').value);
        if (str1 == str2){
		return true;
		}
		else {
		alert("Digite corretamente os numeros da imagem de verificação!"); 
        return false;
		}
    }

    // Remove the spaces from the entered and generated code
    function removeSpaces(string)
    {
        return string.split(' ').join('');
    }	  
	  
      </script>
     
    
</head>

<body onload="DrawCaptcha();">

<div id="background">
</div>
<div id="Div">
</div>
<div class="fale_conosco">
	
		<p class="lastNode">Fale-Conosco
	</p>
</div>
<img src="email_images/topo1.jpg" id="topo1" alt="" />
<img src="email_images/topo2.jpg" id="topo2" alt="" />
<img src="email_images/topo3.jpg" id="topo3" alt="" />
<img src="email_images/face_in.jpg" id="face_in" alt="" />
<img src="email_images/afterface.jpg" id="afterface" alt="" />
<div id="conteudo_main">
<form action="envia.php"
            enctype="multipart/form-data"
            method="post"     
            onsubmit="return valida(this)">
            
<table width="200" border="0" cellspacing="4" cellpadding="0" align="center">
  <tr>
    <td><font color="#333333" 
               face="Verdana, Geneva, sans-serif" size="+1">Nome</font></td>
    <td>        <input type="text"
               name="nome"
               size="80"
               maxlength="40"
               value="<?php echo (isset($_SESSION["nome"]) ? $_SESSION["nome"]:""); ?>"/></td>
  </tr>

  <tr>
    <td><font color="#333333" 
               face="Verdana, Geneva, sans-serif" size="+1">Email</font></td>
    <td> <input type="text"
               name="email"
               size="80"
               maxlength="40"
			   value ="<?php echo (isset($_SESSION["email"]) ? $_SESSION["email"]:""); ?>"/></td>
  </tr>
  <tr>
    <td><font color="#333333" 
               face="Verdana, Geneva, sans-serif" size="+1">Assunto</font></td>
    <td><input type="text"
               name="assunto"
               size="80"
               maxlength="100" 
			   value="<?php echo (isset($_SESSION["assunto"]) ? $_SESSION["assunto"]:""); ?>"/></td>
  </tr>
  <tr>
    <td><font color="#333333" 
               face="Verdana, Geneva, sans-serif" size="+1">Mensagem</font></td>
    <td> <textarea 	name="mensagem"
					rows="12" 
					id="mensagem" 
					cols="80" 
					value="<?php echo (isset($_SESSION["mensagem"]) ? $_SESSION["mensagem"]:""); ?>"/></textarea></td>
<br />
  </tr>
</table>  
<br />   
<table align="center">

<tr>
    <td>
    <font color="#333333" 
               face="Verdana, Geneva, sans-serif" size="+1">Digite no campo abaixo os n&uacute;meros que aparecem na imagem de verifica&ccedil;&atilde;o</font><br />
        <input type="text" id="txtCaptcha" readonly="true" 
            style="background-image:  url(/captchabg.jpg); text-align:center; border:none; font-size:26px;
            font-weight:bold; font-family:Modern" />
        <input type="button" id="btnrefresh" value="Troca" onclick="DrawCaptcha();" />
    </td>
</tr>
<tr>
    <td>
        <input type="text" id="txtInput"/>    
    </td>
</tr>
<tr>
</tr>
</table>
    
<br />               
<p align="center">                
<input type="submit"
               name="submit"
               value="ENVIAR" /><!-- botão 'enviar' -->
         
         <input type="reset"
               name="reset"
               value="RESET" /><!-- botão 'limpar' --></p>
 </form>

</div>
<img src="email_images/after_conteudo.jpg" id="after_conteudo" alt="" />
<img src="email_images/twiitin.jpg" id="twiitin" alt="" />
<img src="email_images/pre_main.jpg" id="pre_main" alt="" />
<img src="email_images/twit_down.jpg" id="twit_down" alt="" />
<img src="email_images/down_conteudo.jpg" id="down_conteudo" alt="" />
<img src="email_images/brands.jpg" id="brands" alt="" />
<img src="email_images/footer.jpg" id="footer" alt="" />
</body>
</html>
