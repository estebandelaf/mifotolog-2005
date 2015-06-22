<html>
<head>
<? include("style.css"); ?>
<title>Admin</title>
</head>
<body leftmargin='10' topmargin='30'>
<div align='center'><?

include("conf.php");

//Contar Fotos y Obtener los Nombres
$img_filename_re = '/\.gif|jpe?g|png|bmp$/';
$pDir = opendir( "./images");
$dot = readdir( $pDir);
$dotdot = readdir( $pDir);
while( false !== ($filename = readdir( $pDir)))
{
  if ( preg_match ( $img_filename_re, strtolower($filename)) )
    $files[] = $filename;
}
if( count( $files) > 1)
  sort( $files);
closedir( $pDir);
$nOimgs = count($files);


if(!$pass) //Si no Existe una contraseña en conf.php
{
 if($submit) //Verifica el envio de la Contraseña
 {
  if($PW1==$PW2) //Verifica que la contraseña se haya ingresado bien en ambos campos
  {
   $PW3=md5($PW1); //Encripta la contraseña
   echo "<b>Tu Clave Encriptada:</b> $PW3<br><br>Abre el archivo conf.php y copia esto en donde va la clave, luego haz click <a href='admin.php'>aqu&iacute;</a><br><br><br>"; //Muestra la contraseña encriptada
  }
  else
   echo "Ingresaste mal una de las Claves"; //Msj error
 }

//Formulario que pide la contraseña
echo <<< HTML
 <b>Crea una Clave para el acceso a la administraci&oacute;n</b><br><br>
 <form action='admin.php' method='post'>
 Clave: <input type='password' size='16' name='PW1'><br>
 Confirma la clave: <input type='password' size='16' name='PW2'><br>
 <input type="submit" name='submit' value="Encriptar Clave">
 </form>
HTML;

}
else //Si Existe la contraseña en conf.php
{
 if($PW)
 {
  $PW=md5($PW);
  if($PW==$pass) //Compara contraseña enviada con la guardada
  {
//Formulario para subir foto
echo <<< HTML
 <table width="100%" align="center">
 <tr><td align="center"><b>Subir Foto</b><br>Haz Subido un total de $nOimgs Fotos</td></tr>
 <form action="admin.php" method="post" enctype="multipart/form-data"> 
 <tr><td>Foto: <input name="userfile" type="file" id="archivo"></td></tr>
 <tr><td>Mensaje:</td></tr>
 <tr><td><textarea name="msj" rows="10" cols="40"></textarea></td></tr>
 <tr><td><input name="boton" type="submit" id="boton" value="Subir Foto"></td></tr>
 </form>
</table>
HTML;
  }
  else echo "Error en la Contrase&ntilde;a<br><br><a href='admin.php'>Volver</a>";
 }
 else
 {
  //Formulario para ingresar Password
echo <<< HTML
 <form action='admin.php' method='post'>
 Clave: <input type='password' size='16' name='PW'><br>
 <input type="submit" name='submit' value="Entrar">
 </form>
HTML;
 }

}

//Agregando Foto Nueva

if($userfile)
{ 

    $nfoto=$nOimgs+1;

    if (is_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name']))
    {
         $split_path = split("/", $HTTP_POST_FILES['userfile']['name']);
         $split_path = end ($split_path);
         $extension = split("[/.]", $split_path);
         $extension = end($extension);
         $subir_en = "images/";
         $nombre_foto = "$nfoto" . "." . $extension;
         //echo "$extension<br>";
         //echo $nombre_foto;
         move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $subir_en . $nombre_foto);

    }

//Revisar msj y hacer reemplazos correspondientes
$msj = str_replace("<","&lt;",$msj); 
$msj = str_replace(">","&gt;",$msj); 
$msj = str_replace("\'","&#39;",$msj); 
$msj = str_replace('\"',"&quot;",$msj); 
$msj = str_replace("\\\\","&#92;",$msj); 
$msj = str_replace("á","&aacute;",$msj);
$msj = str_replace("é","&eacute;",$msj);
$msj = str_replace("í","&iacute;",$msj);
$msj = str_replace("ó","&oacute;",$msj);
$msj = str_replace("ú","&uacute;",$msj);
$msj = str_replace("Á","&Aacute;",$msj);
$msj = str_replace("É","&Eacute;",$msj);
$msj = str_replace("Í","&Iacute;",$msj);
$msj = str_replace("Ó","&Oacute;",$msj);
$msj = str_replace("Ú","&Uacute;",$msj);
$msj = str_replace("ñ","&ntilde;",$msj);
$msj = str_replace("Ñ","&Ntilde;",$msj);
$msj = str_replace("\n","<br>",$msj);

$nl="\n";

      $archivo=fopen("msj/$nfoto.txt", "w+");
      fputs ($archivo, "$msj<br>$nl-------------------------------<br><br><b>Comentarios:</b><br><br><br>$nl$nl");
      fclose($archivo);


//Cerrar Ventana
echo <<< HTML
<script>
  function cerrar()
  { 
   var ventana = window.self; 
   ventana.opener = window.self; 
   ventana.close(); 
  }
  javascript:cerrar()
</script>
HTML;

}

?></div>
</body>
</html>