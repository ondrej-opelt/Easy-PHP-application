<?php ### vytvo�eno 17.12.2014  ### ?>
<?php

#Na�ten� text� z datab�ze
$designation="insert";
$text=fce_gettext($designation,$language);

#P��prava prom�n�ch pro p��pad chybn�ho zad�n�
$chyby="";
$_POST['register']=TRUE;

#Zji�t�n� zda n�jak� pole je pr�zdn�
if((empty($_POST['user'])) OR (empty($_POST['pass'])) OR (empty($_POST['pass2'])))
{
  #Vytvo�en� chybov� hl�ky
  $chyby.=$text[1]."<br>";
}

#Zji�t�n� zda nejsou hesla stejn�
elseif($_POST['pass']!=$_POST['pass2'])
{
  #Vytvo�en� chybov� hl�ky
  $chyby.=$text[2]."<br>";
}

#Zji�t�n� zda nen� heslo 6 a v�ce znak�
elseif(strlen($_POST['pass'])<6)
{
  #Vytvo�en� chybov� hl�ky
  $chyby.=$text[3]."<br>";
}

#Zji�t�n� zda jm�no neobsahuje pouze ��sla a p�smena
elseif(ctype_alnum($_POST['user'])==FALSE)
{
  #Vytvo�en� chybov� hl�ky
  $chyby.=$text[5]."<br>";
}

#Kdy� je v�e zad�no spr�vn�
else
{
  #Vyhled�n� zda jm�no ji� existuje
  $sql=$GLOBALS['sql'];
  $query="SELECT * FROM `tbl_user` WHERE `user`='".$_POST['user']."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;  
	if($result->num_rows > 0) 
  {   
    $chyby.=$text[4]."<br>";
  }
  
  #Kdy� jm�no je�t� neexistuje
  else
  {
    #Vytvo��m nov�ho u�ivatele
    $dotaz ="INSERT INTO `db_easyapp`.`tbl_user` 
            (`id_user`, `language_id`, `user`, `password`) VALUES 
            (NULL, '$language', '".$_POST['user']."', '".md5($_POST['pass'])."');";          
    $result = $sql->query($dotaz);
    
    #Zji�t�n� zda li do�lo k chyb� z�pisu
    if (!$result)
    {
      #Ukon�en� programu se zpr�vou
      printf("%s\n", $sql->error);
      exit();
    }
    
    #Kdy� nedo�lo k chyb� z�pisu
    else
    {   
      #vyhled�m nov� vytvo�en�ho u�ivatele v datab�zi   
      $query="SELECT * FROM `tbl_user` WHERE `user`='".$_POST['user']."' AND `password`='".md5($_POST['pass'])."';";
      $result = $sql->query($query) or die($sql->error.__LINE__);;      
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
       
      #Obnoven� strany    
      fce_refresh();     
    }
  }
    
}
?>