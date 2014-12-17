<?php ### vytvoøeno 17.12.2014  ### ?>
<?php

#Naètení textù z databáze
$designation="logout";
$text=fce_gettext($designation,$language);

#Zjištìní zda má být provedeno odhlášení
if(isset($_POST['logout']))
{
  #Vyprázdnìní pøihlašovacích promìnných
  unset($_SESSION['user']);  
  unset($_SESSION['pass']);
  unset($_SESSION['id']); 
  
  #Obnovení strany
  fce_refresh();
}

#Když nemá být provedeno odhlášení
else
{
  #vytvoøím formuláø pro odhlášení
  $logout="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
  $logout.="<button name='logout'>".$text[1]."</button>";
  $logout.="</form><br>";
}

?>

<html>
  <head>                                     
    <meta charset="utf-8">
      <title>Easy app</title>
  </head>    
  <body>
    <?php 
      #Vypsání textù
      echo $logout;
    ?>        
  </body>
</html> 