<?php ### vytvo�eno 17.12.2014  ### ?>
<?php

#Na�ten� text� z datab�ze
$designation="check";
$text=fce_gettext($designation,$language);

#P��prava prom�n�ch pro p��pad chybn�ho zad�n�
$chyby="";

#Zji�t�n� zda n�jak� pole je pr�zdn�
if((empty($_POST['user'])) or (empty($_POST['pass'])))
{
  #Vytvo�en� chybov� hl�ky
  $chyby.=$text[1]."<br>";
}

#Kdy� je v�e zad�no spr�vn�
else
{
  #Vyhled�n� existence u�ivatele v datab�zi
  $sql=$GLOBALS['sql'];
  $query="SELECT * FROM `tbl_user` WHERE `user`='".$_POST['user']."' AND `password`='".md5($_POST['pass'])."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
  
  #Zji�ten� zda byl u�ivatel nalezen
	if($result->num_rows > 0) 
  {
		while($row = $result->fetch_assoc()) 
    {
      #P�iprav�m prom�nn� pro p�ihl�en�
      unset($_SESSION['user']);  
      unset($_SESSION['pass']);
      unset($_SESSION['id']); 
      
      #Napln�n� p�ihla�ovac� prom�nn�
      $_SESSION['user']=$row['user']; 
      $_SESSION['pass']=$row['password']; 
      $_SESSION['id']=$row['id_user'];       	
		}
  }
  
  #Kdy� nebyl u�ivatel nalezen
  else
  {
    #Vytvo�en� chybov� hl�ky
    $chyby.=$text[2]."<br>";
  }
    
}

?>