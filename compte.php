<?php session_start();  ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css"/>
        <script src="assets/js/jquery.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="assets/js/holder.js"></script>
        <link href="dist/css/bootstrap.css" rel="stylesheet">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <title></title>
    </head>
    <body> 
<?php include("menu.php");  ?>
    
    
<?php //include("connexion_bdd.php");?>
<?php //include("menu.php");  ?>
<?php

if(isset($_POST['connexion']) && $_POST['connexion'] == 'connexion')
{
    if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['mdp']))
    {
        
      $base = mysql_connect ($server='localhost', $login='root', $password=''); 
      mysql_select_db ('aquaservice',$base); 
      
      // on teste si une entrée de la base contient ce couple login / pass
      $sql = 'SELECT count(*) FROM connexion WHERE login="'.mysql_escape_string($_POST['login']).'" AND mdp="'.mysql_escape_string(md5($_POST['mdp'])).'"'; 
      $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error()); 
      $data = mysql_fetch_array($req); 
      
      mysql_free_result($req); 
      mysql_close(); 
        
        // si on obtient une réponse, alors l'utilisateur est un membre
      if ($data[0] == 1) { 
         $_SESSION['login'] = $_POST['login'];
         //$temps = 365*24*3600;
         //setcookie('pseudo',$_POST['login'], time() + $temps);
         //header('Location: membre.php'); 
         echo '<script language="Javascript">
                
                document.location.replace("membre.php");
                
                </script>';
         exit(); 
      } 
      // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
      elseif ($data[0] == 0) { 
         $erreur = 'Compte non reconnu.'; 
      } 
      // sinon, alors la, il y a un gros problème :)
      else { 
         $erreur = 'Problème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.'; 
      } 
   } 
   else { 
      $erreur = 'Au moins un des champs est vide.'; 
   }  
}  
        
        /*
        $cherche_mdp=$bdd->query('SELECT COUNT(*) FROM connexion
            WHERE login="'.  mysql_escape_string(md5($_POST['login'])).'"
            AND mdp="'.  mysql_escape_string(md5($_POST['mdp'])).'"');
        
        
        $mdp_cherche=$cherche_mdp->fetch();
        
        //$mdp_trouve = mysql_fetch_array($trouve_mdp);
        //mysql_free_result($trouve_mdp);
        //mysql_close();
      

        if($mdp_cherche[0] == 1)
        {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            header('location:membre.php');
            exit();
        }
        elseif($mdp_cherche[0] == 0)
        {
            $erreur = 'Compte introuvable !';
        }
        else
        {
            $erreur='Erreur dans la base de donnée !!!';
        }
     
     
 }
 else
 {
     $erreur="Au moins un des champs est vide !!";
 }
    
}
         * 
         */
?>
<div class="page-header">
        <h1 style="color:white">Connexion à l'espace membre</h1>
      </div>
<div class="formulaires2">
<form action="compte.php" method="post">
<label for="login">Login :</label>
<input type="text" name="login" class="form-control" placeholder="Votre pseudo" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
<label for="mdp">Mot de passe :</label>
<input type="password" name="mdp" class="form-control" placeholder="Mot de passe" value="<?php if (isset($_POST['mdp'])) echo htmlentities(trim($_POST['mdp'])); ?>"><br />
<input type="submit" name="connexion" value="connexion" class="btn btn-default">
<a href="inscription.php" class="btn btn-default">Inscription</a>
</form>

</div>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;  
?>

   <!--     
  <form class="form-horizontal" role="form" action="compte.php" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="login" value="<?php if(isset($_POST['login'])){echo htmlentities(trim($_POST['mdp']));}?>"></br>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="mdp" value="<?php if (isset($_POST['mdp'])) echo htmlentities(trim($_POST['mdp'])); ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="connexion" value="connexion">Sign in</button>
    </div>
      <div class="col-sm-offset-2 col-sm-10">
          <a href="inscription.php">Inscription</a>
          <?php
         /* if(isset($erreur))
          {
              echo '<br/><br/>',$erreur;
          }*/
          ?>
    </div>
  </div>
</form>
-->
    </body>
</html>