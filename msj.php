<?

//Enviar Mensaje

if($nick&&$com){

$nl="\n";

$nick = str_replace("<","&lt;",$nick); 
$nick = str_replace(">","&gt;",$nick); 
$nick = str_replace("\'","&#39;",$nick); 
$nick = str_replace('\"',"&quot;",$nick); 
$nick = str_replace("\\\\","&#92;",$nick);
$nick = str_replace("á","&aacute;",$nick);
$nick = str_replace("é","&eacute;",$nick);
$nick = str_replace("í","&iacute;",$nick);
$nick = str_replace("ó","&oacute;",$nick);
$nick = str_replace("ú","&uacute;",$nick);
$nick = str_replace("Á","&Aacute;",$nick);
$nick = str_replace("É","&Eacute;",$nick);
$nick = str_replace("Í","&Iacute;",$nick);
$nick = str_replace("Ó","&Oacute;",$nick);
$nick = str_replace("Ú","&Uacute;",$nick);
$nick = str_replace("ñ","&ntilde;",$nick);
$nick = str_replace("Ñ","&Ntilde;",$nick);


$com = str_replace("<","&lt;",$com); 
$com = str_replace(">","&gt;",$com); 
$com = str_replace("\'","&#39;",$com); 
$com = str_replace('\"',"&quot;",$com); 
$com = str_replace("\\\\","&#92;",$com); 
$com = str_replace("á","&aacute;",$com);
$com = str_replace("é","&eacute;",$com);
$com = str_replace("í","&iacute;",$com);
$com = str_replace("ó","&oacute;",$com);
$com = str_replace("ú","&uacute;",$com);
$com = str_replace("Á","&Aacute;",$com);
$com = str_replace("É","&Eacute;",$com);
$com = str_replace("Í","&Iacute;",$com);
$com = str_replace("Ó","&Oacute;",$com);
$com = str_replace("Ú","&Uacute;",$com);
$com = str_replace("ñ","&ntilde;",$com);
$com = str_replace("Ñ","&Ntilde;",$com);
$com = str_replace("\n","<br>",$com);

$archivo=fopen("msj/$foto.txt", "a+");
fputs ($archivo, "$nick escribió:<br>");
fputs ($archivo, "$com<br><br>$nl$nl");
Header("Location: index.php?foto=$foto");

}

?>