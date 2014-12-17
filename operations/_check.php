<?php ### vytvoøeno 17.12.2014  ### ?>
<?php

#Naètení textù z databáze
$designation="check";
$text=fce_gettext($designation,$language);

#Pøíprava promìných pro pøípad chybného zadání
$chyby="";

#Zjištìní zda nìjaké pole je prázdné
if((empty($_POST['user'])) or (empty($_POST['pass'])))
{
  #Vytvoøení chybové hlášky
  $chyby.=$text[1]."<br>";
}

#Když je vše zadáno správnì
else
{
  #Vyhledání existence uživatele v databázi
  $sql=$GLOBALS['sql'];
  $query="SELECT * FROM `tbl_user` WHERE `user`='".$_POST['user']."' AND `password`='".md5($_POST['pass'])."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
  
  #Zjištení zda byl uživatel nalezen
	if($result->num_rows > 0) 
  {
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
  }
  
  #Když nebyl uživatel nalezen
  else
  {
    #Vytvoøení chybové hlášky
    $chyby.=$text[2]."<br>";
  }
    
}

?>