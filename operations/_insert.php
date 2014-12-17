<?php ### vytvoøeno 17.12.2014  ### ?>
<?php

#Naètení textù z databáze
$designation="insert";
$text=fce_gettext($designation,$language);

#Pøíprava promìných pro pøípad chybného zadání
$chyby="";
$_POST['register']=TRUE;

#Zjištìní zda nìjaké pole je prázdné
if((empty($_POST['user'])) OR (empty($_POST['pass'])) OR (empty($_POST['pass2'])))
{
  #Vytvoøení chybové hlášky
  $chyby.=$text[1]."<br>";
}

#Zjištìní zda nejsou hesla stejná
elseif($_POST['pass']!=$_POST['pass2'])
{
  #Vytvoøení chybové hlášky
  $chyby.=$text[2]."<br>";
}

#Zjištìní zda není heslo 6 a více znakù
elseif(strlen($_POST['pass'])<6)
{
  #Vytvoøení chybové hlášky
  $chyby.=$text[3]."<br>";
}

#Zjištìní zda jméno neobsahuje pouze èísla a písmena
elseif(ctype_alnum($_POST['user'])==FALSE)
{
  #Vytvoøení chybové hlášky
  $chyby.=$text[5]."<br>";
}

#Když je vše zadáno správnì
else
{
  #Vyhledání zda jméno již existuje
  $sql=$GLOBALS['sql'];
  $query="SELECT * FROM `tbl_user` WHERE `user`='".$_POST['user']."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;  
	if($result->num_rows > 0) 
  {   
    $chyby.=$text[4]."<br>";
  }
  
  #Když jméno ještì neexistuje
  else
  {
    #Vytvoøím nového uživatele
    $dotaz ="INSERT INTO `db_easyapp`.`tbl_user` 
            (`id_user`, `language_id`, `user`, `password`) VALUES 
            (NULL, '$language', '".$_POST['user']."', '".md5($_POST['pass'])."');";          
    $result = $sql->query($dotaz);
    
    #Zjištìní zda li došlo k chybì zápisu
    if (!$result)
    {
      #Ukonèení programu se zprávou
      printf("%s\n", $sql->error);
      exit();
    }
    
    #Když nedošlo k chybì zápisu
    else
    {   
      #vyhledám novì vytvoøeného uživatele v databázi   
      $query="SELECT * FROM `tbl_user` WHERE `user`='".$_POST['user']."' AND `password`='".md5($_POST['pass'])."';";
      $result = $sql->query($query) or die($sql->error.__LINE__);;      
  		while($row = $result->fetch_assoc()) 
      {
        #Pøipravím promìnné pro pøihlášení
        unset($_SESSION['user']);  
        unset($_SESSION['pass']);
        unset($_SESSION['id']); 
        
        #Naplnìní pøihlašovací promìnné
        $_SESSION['user']=$row['user']; 
        $_SESSION['pass']=$row['password']; 
        $_SESSION['id']=$row['id_user'];       	
  		}   
       
      #Obnovení strany    
      fce_refresh();     
    }
  }
    
}
?>