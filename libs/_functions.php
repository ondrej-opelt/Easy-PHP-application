<?php ### vytvo�eno 17.12.2014  ### ?>
<?php

#Funkce pro z�sk�n� text� z datab�ze
function fce_gettext($des,$lan)
{
  #vytvo�en� pole pro n�vrat text�
  $return=[];
  
  #Vyhled�n� text� v atab�zi, se�azen�ch podle po�ad�
  $sql=$GLOBALS['sql'];
  $dotaz ="SELECT * FROM `tbl_text` WHERE `designation`='".$des."' AND `language_id`='".$lan."' ORDER BY `tbl_text`.`order` ASC;";
  $result = $sql->query($dotaz) or die($sql->error.__LINE__);;
  
  #Zji�t�n� zda n�jak� texty existuj�
  if($result->num_rows > 0)  
  {
		while($row = $result->fetch_assoc()) 
    { 
      #Vlo��m texty do pole pod kl��em po�ad�
      $return[$row['order']]=$row['text'];
    }
  }
   
  #Vr�t�m pole text�
  return $return; 
}

#Funkce pro obnoven� str�nky
function fce_refresh()
{
  #Obnoven� str�nky  bez hl�en� 302
  header('Location: ' . $_SERVER['PHP_SELF'], true, false ? 301 : 302);
  
  #Ukon�en� pr�b�hu programu
  exit(); 
}

?>