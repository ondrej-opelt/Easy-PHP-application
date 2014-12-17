<?php ### vytvo�eno 17.12.2014  ### ?>
<?php

#Na�ten� text� z datab�ze
$designation="logout";
$text=fce_gettext($designation,$language);

#Zji�t�n� zda m� b�t provedeno odhl�en�
if(isset($_POST['logout']))
{
  #Vypr�zdn�n� p�ihla�ovac�ch prom�nn�ch
  unset($_SESSION['user']);  
  unset($_SESSION['pass']);
  unset($_SESSION['id']); 
  
  #Obnoven� strany
  fce_refresh();
}

#Kdy� nem� b�t provedeno odhl�en�
else
{
  #vytvo��m formul�� pro odhl�en�
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
      #Vyps�n� text�
      echo $logout;
    ?>        
  </body>
</html> 