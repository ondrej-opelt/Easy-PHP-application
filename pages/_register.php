<?php ### vytvo�eno 17.12.2014  ### ?>
<?php

#Na�ten� text� z datab�ze
$designation="register";
$text=fce_gettext($designation,$language);

#Vytvo�en� fromul��e pro registraci
$register="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
$register.="<label for='user'>".$text[1]."</label><input id='user' name='user' type='text' max-lenght='25' size='25'";
#Zji�t�n� zda u� byly n�jak� data vlo�eny dop�edu
if(isset($_POST['user']))
{
  #Vlo�en� dat do pole
  $register.=" value='".$_POST['user']."'";
} 
$register.="><br>";
$register.="<label for='pass'>".$text[2]."</label><input id='pass' name='pass' type='password' max-lenght='25' size='25'><br>";
$register.="<label for='pass2'>".$text[3]."</label><input id='pass2' name='pass2' type='password' max-lenght='25' size='25'><br>";
$register.="<button name='insert'>".$text[4]."</button><br>";
$register.="<button name='cancel'>".$text[5]."</button>";
$register.="</form><br>";
?>

<html>
  <head>                                     
    <meta charset="utf-8">
      <title>Easy app</title>
  </head>    
  <body>
    <?php 
      #Vyps�n� obsahu strany
      echo $register;
      
      #Vyps�n� chyb, pokud n�jak� jsou
      if(!empty($chyby))
      {
        echo $chyby;
      }
    ?>        
  </body>
</html>  