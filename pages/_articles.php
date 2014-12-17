<?php ### vytvoøeno 17.12.2014  ### ?>
<?php
#Naètení textù z databáze
$designation="articles";
$text=fce_gettext($designation,$language);

#Pøíprava promìných pro pøípad chybného zadání
$chyby="";

#Zjištìní zda se uložit tvorba nového èlánku
if(isset($_POST['create']))
{
  #Pøíprava promìných pro pøípad chybného zadání
  $_POST['new']=TRUE;
  
  #Zjištìní zda nìjaké pole je prázdné
  if((empty($_POST['title'])) OR (empty($_POST['text'])))
  {
    #Vytvoøení chybové hlášky
    $chyby.=$text[10];
  }
  
  #Když je vše zadáno správnì
  else
  {
    #Vytvoøení nového èlánku
    $dotaz ="INSERT INTO `db_easyapp`.`tbl_article` 
            (`id_article`, `language_id`, `user_id`, `title`, `article`) VALUES 
            (NULL, '$language', '".$_SESSION['id']."', '".$_POST['title']."', '".$_POST['text']."');";
    $result = $sql->query($dotaz);
    
    #Zjištìní zda li došlo k chybì zápisu
    if (!$result) 
    {
      #Ukonèení programu se zprávou
      printf("%s\n", $sql->error);
      exit();
    } 
    
    #Obnovení strany
    fce_refresh();
  }
}

#Zjištìní zda se má uložit úprava nového èlánku
elseif(isset($_POST['update']))
{    
  #Pøíprava promìných pro pøípad chybného zadání
  $_POST['edit']=TRUE;
  
  #Zjištìní zda nìjaké pole je prázdné
  if((empty($_POST['title'])) OR (empty($_POST['text'])))
  {
    #Vytvoøení chybové hlášky
    $chyby.=$text[10];  
  }
  
  #Když je vše zadáno správnì
  else
  {
    #Úprava èlánku v databázi   
    $dotaz ="UPDATE  `db_easyapp`.`tbl_article` SET  `title` =  '".$_POST['title']."',`article` =  '".$_POST['text']."' where `id_article`='".$_POST['id']."';";
    $result = $sql->query($dotaz);
    
    #Zjištìní zda li došlo k chybì úpravy
    if (!$result) 
    {
      #Ukonèení programu se zprávou
      printf("%s\n", $sql->error);
      exit();
    }
    
    #Obnovení strany
    fce_refresh();
  }
}

#Zjištìní zda má být zobrazen èlánek
if(isset($_POST['display']))
{
  #Pøíprava promìných pro vypsání obsahu
  $article="";
  
  #vyhledání èlánku v databázi
  $query="SELECT * FROM `tbl_article` WHERE `id_article`='".$_POST['display']."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
  while($row = $result->fetch_assoc()) 
  {
    #Pøipravení vlastností èlánku
    $article.="<h3>".$row['title']."</h3>";
    $article.="<p>".$row['article']."</p>";
    
    #Vyhledání autora èlánku v databázi
    $query="SELECT * FROM `tbl_user` WHERE `id_user`='".$row['user_id']."';";
    $result1 = $sql->query($query) or die($sql->error.__LINE__);;
    while($row1 = $result1->fetch_assoc()) 
    {
      #Pøipavení jména uživatele
      $article.="<p><b>".$text[7]."</b>".$row1['user']."</p>";
    }    
  }
  
  #vytvoøení zpìtného odkazu
  $article.="<a href='".$_SERVER['PHP_SELF']."'>".$text[8]."</a>";
}

#Zjištìní zda nemá dojít k úpravì èlánku
elseif(isset($_POST['edit']))
{
  #Vyhledání èlánku v databázi
  $query="SELECT * FROM `tbl_article` WHERE `id_article`='".$_POST['edit']."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
  while($row = $result->fetch_assoc()) 
  {
    #Vytvoøení formuláøe pro úpravu èlánku, zároveñ naètení textù èlanku a zpìtného odkazu
    $article="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
    $article.="<label for='title'>".$text[4]."</label><input id='title' name='title' type='text' max-lenght='50' size='50' value='".$row['title']."'><br>";
    $article.="<textarea id='text' name='text' type='text' max-lenght='255' cols='50' rows='5'>";
    $article.=$row['article'];
    $article.="</textarea><br>";    
    $article.="<input name='id' type='hidden' value='".$_POST['edit']."'>";
    $article.="<button name='update'>".$text[2]."</button><br>";
    $article.="<button name='cancel'>".$text[8]."</button>";
    $article.="</form><br>";
  }
}

#Zjištìní zda nemá dojít k vytvoøení nového èlánku
elseif(isset($_POST['new']))
{
  #Vytvoøení formuláøe pro vytvoøení nového èlánku a pokud již byly zadána nìjaká data pøedem, tak jsou automaticky vyplnìna
  $article="<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
  $article.="<label for='title'>".$text[4]."</label><input id='title' name='title' type='text' max-lenght='50' size='50'";
  if(isset($_POST['title']))
  {
    $article.=" value='".$_POST['title']."'";
  } 
  $article.="><br>";
  $article.="<textarea id='text' name='text' type='text' max-lenght='255' cols='50' rows='5'>";
  if(isset($_POST['text']))
  {
    $article.=$_POST['text'];
  } 
  $article.="</textarea><br>";
  $article.="<button name='create'>".$text[9]."</button><br>";
  $article.="<button name='cancel'>".$text[8]."</button>";
  $article.="</form><br>";
}

#Když není stanovená žádná akce
else
{  
  #Vytvoøení tabulky pro pøehled èlánkù
  $article="<form action='".$_SERVER['PHP_SELF']."' method='POST'>"; 
  $article.="<button name='new'>".$text[3]."</button>";  
  $article.="<table>";
  $article.="<tr>";
  $article.="<th>".$text[4]."</th>";
  $article.="<th>".$text[5]."</th>";
  $article.="<th>".$text[6]."</th>";
  $article.="</tr>";
  
  #Vyhledání vyšech èlánkù v databázi
  $sql=$GLOBALS['sql'];
  $query="SELECT * FROM `tbl_article` WHERE `language_id`='".$language."';";
  $result = $sql->query($query) or die($sql->error.__LINE__);;
	while($row = $result->fetch_assoc()) 
  {
    #zaèátek øádku a pøipravení dat èlánku
    $article.="<tr>";
    $article.="<td>".$row['title']."</td>";
    
    #Vyhledání autora èlánku
    $query="SELECT * FROM `tbl_user` WHERE `id_user`='".$row['user_id']."';";
    $result1 = $sql->query($query) or die($sql->error.__LINE__);;
    while($row1 = $result1->fetch_assoc()) 
    {
      #Pøipravení dat autora
      $article.="<td>".$row1['user']."</td>";
    }
    
    #Vyhledání jazyku èlánku
    $query="SELECT * FROM `tbl_language` WHERE `id_language`='".$row['language_id']."';";
    $result1 = $sql->query($query) or die($sql->error.__LINE__);;
    while($row1 = $result1->fetch_assoc()) 
    {
      #Pøipravení dat o jazyku
      $article.="<td>".$row1['language']."</td>";
    }

    #Pøipravení tlaèítka pro zobrazení èlánku
    $article.="<td><button name='display' value='".$row['id_article']."'>".$text[1]."</button></td>"; 
    
    #Zjištìní zda je autor èlánku právì pøihlášený uživatel
    if($row['user_id']==$_SESSION['id'])
    {
      #Pøipravení tlaèítka pro úpravu èlánku
      $article.="<td><button name='edit' value='".$row['id_article']."'>".$text[2]."</button></td>";
    } 
    
    #Ukonèení øádku
    $article.="</tr>";        
     	
	}
  #Ukonèení tabulky pro pøehled èlánkù
  $article.="</form></table>";
}  
?>

<html>
  <head>                                     
    <meta charset="utf-8">
      <title>Easy app</title>
  </head>    
  <body>
    <?php 
      #Výpsání obsahu strany
      echo $article;
      
      #Zjištìní zda se vyskytly nìjaké chyby
      if(!empty($chyby))
      {
        #Vypsání chyb
        echo $chyby;
      }
    ?>        
  </body>
</html>  