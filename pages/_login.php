<?php ### vytvo�eno 17.12.2014  ### ?>
<?php
#Na�ten� text� z datab�ze
$designation="login";
$text=fce_gettext($designation,$language);

#Vytvo�en� fromul��e pro registraci
$login="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
$login.="<label for='user'>".$text[1]."</label><input id='user' name='user' type='text' max-lenght='25' size='25'";
if(isset($_POST['user']))
{
  #Vlo�en� dat do pole
  $login.=" value='".$_POST['user']."'";
} 
$login.="><br>";
$login.="<label for='pass'>".$text[2]."</label><input id='pass' name='pass' type='password' max-lenght='25' size='25'><br>";
$login.="<button name='submit'>".$text[3]."</button><br>";
$login.="<button name='register'>".$text[4]."</button>";
$login.="</form><br>";
?>

<html>
  <head>                                     
    <meta charset="utf-8">
      <title>Easy app</title>
  </head>    
  <body>
    <?php 
      #Vyps�n� obsahu strany
      echo $login;
      
      #Vyps�n� chyb, pokud n�jak� jsou
      if(!empty($chyby))
      {
        echo $chyby;
      }
    ?>        
  </body>
</html>                


        