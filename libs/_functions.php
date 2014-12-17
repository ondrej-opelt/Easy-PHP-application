<?php ### vytvoøeno 17.12.2014  ### ?>
<?php

#Funkce pro získání textù z databáze
function fce_gettext($des,$lan)
{
  #vytvoøení pole pro návrat textù
  $return=[];
  
  #Vyhledání textù v atabázi, seøazených podle poøadí
  $sql=$GLOBALS['sql'];
  $dotaz ="SELECT * FROM `tbl_text` WHERE `designation`='".$des."' AND `language_id`='".$lan."' ORDER BY `tbl_text`.`order` ASC;";
  $result = $sql->query($dotaz) or die($sql->error.__LINE__);;
  
  #Zjištìní zda nìjaké texty existují
  if($result->num_rows > 0)  
  {
		while($row = $result->fetch_assoc()) 
    { 
      #Vložím texty do pole pod klíèem poøadí
      $return[$row['order']]=$row['text'];
    }
  }
   
  #Vrátím pole textù
  return $return; 
}

#Funkce pro obnovení stránky
function fce_refresh()
{
  #Obnovení stránky  bez hlášení 302
  header('Location: ' . $_SERVER['PHP_SELF'], true, false ? 301 : 302);
  
  #Ukonèení prùbìhu programu
  exit(); 
}

?>