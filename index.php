<?

//Archivo de Configuracion
include("conf.php");

$string["dir"] = dirname($_SERVER["SCRIPT_NAME"]);

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

//Foto que se cargara al inicio
if(!$foto) $foto=$nOimgs;

echo <<< HTML
 <html>
 <head>
  <title>Fotolog's $title</title>
HTML;

 include("style.css");

echo <<< HTML
 </head>
 <body lefmargin='0' topmargin='0'>

  <table width='$tamweb' align='center'>
   <tr>
    <td width='120' align='center'><a href=""#" onClick="window.open('admin.php','hrscp','width=400,height=400,top=150,left=175,scrolling=1,frameborder=0,status=0,menubar=0,scrollbars=1');return false;">admin</a></td>
    <td width='100%' align='center'>Due&ntilde;@: $dueno ($mail)</td>
   </tr>
   <tr>
    <td valign='top'>
HTML;

//Variables para la Foto Grande
$fotoa=$foto-1; //da la ubicacion en el arreglo
$fotou="$files[$fotoa]"; //toma el nombre de la foto en la ubicacion $fotoa
$fotot="images/$fotou"; //direccion para poder tomar el tamaño y otras acciones

//Mostrar fotos
for($i=$nOimgs;$i>0;$i--)
{
//Variables para las fotos chicas
$fotoaa=$i-1; //da la ubicacion en el arreglo
$fotouu="$files[$fotoaa]"; //toma el nombre de la foto en la ubicacion $fotoaa
$fotott="images/$fotouu"; //direccion para poder tomar el tamaño y otras acciones
$sizee=sprintf("%.2f", (filesize($fotott))/1024);
//Imprimir Todas las fotos
echo "<a href='?foto=$i'><img src='$fotott' width='100' alt='$fotouu | $sizee Kb'></a><br><br>";
}

echo <<< HTML
    </td>
    <td valign='top'>
HTML;

//Validar que la foto exista
if($foto<=$nOimgs)
{

//Foto Grande, revisar ancho y mostrar
$size=sprintf("%.2f", (filesize($fotot))/1024);
$tam=getimagesize($fotot);
if($tam[0]>$tamfotos) echo "<img src='images/$fotou' width='$tamfotos' alt='$fotou | $size Kb | Tama&ntilde;o Original: $tam[0]x$tam[1]px'><br><br>";
else echo "<img src='images/$fotou' alt='$fotou | $size Kb | Tama&ntilde;o Original: $tam[0]x$tam[1]px'><br><br>";

//Incluir Comentarios
include("msj/$foto.txt");

echo <<< HTML
<br><br>
<FORM ACTION='msj.php' METHOD='post'>
Nick: <input type='text' name='nick'><br>
Comentario:<br>
<textarea name='com' rows='10' cols='40'></textarea><br>
<input type='hidden' value='$foto' name='foto'>
<input type='submit' value='Enviar Comentario' name='enviar'>
</FORM>
HTML;

}
//Fin de la Validacion
else
echo <<< HTML
<br><br><center>
Lo Sentimos, no encontramos la foto que Solicita.
</center>
HTML;

echo <<< HTML
    </td>
   </tr>
  </table>
  <div align='center'>MiFoToLoG v.2.1<br>Powered by <a href='http://www.guarida.cl' target='_blank'>Guarida.cl</a> © <a href='http://delaf.guarida.cl' target='_blank'>DeLaF</a></div>
 </body>
 </html>
HTML;

?>