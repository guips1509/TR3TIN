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
    
    
<?php include("connexion_bdd.php");?>
<?php include("menu.php");  ?>
            
    <?php
    // on teste si le visiteur a soumis le formulaire
    if (isset($_POST['inscription']) && $_POST['inscription'] == 'inscription') { 
       // on teste l'existence de nos variables. On teste également si elles ne sont pas vides
       if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['mdp']) && !empty($_POST['mdp'])) && (isset($_POST['confirm']) && !empty($_POST['confirm']))) { 
          // on teste les deux mots de passe
          if ($_POST['mdp'] != $_POST['confirm']) { 
             $erreur = 'Les 2 mots de passe sont différents.'; 
          } 
          else { 
            
             // on recherche si ce login est déjà utilisé par un autre membre
             $trouve_mdp=$bdd->query('SELECT count(*) FROM connexion WHERE login="'.mysql_escape_string($_POST['login']).'"');
             $mdp_trouve=$trouve_mdp->fetch();
             
             if ($data[0] == 0) { 
                $ajout_compte=$bdd->query('INSERT INTO connexion VALUES("", "'.mysql_escape_string($_POST['login']).'", "'.mysql_escape_string(md5($_POST['mdp'])).'")');
                $ajout_compte->fetch();
               
                session_start(); 
                $_SESSION['login'] = $_POST['login']; 
                header('Location: membre.php'); 
                exit(); 
             } 
             else { 
                $erreur = 'Un membre possède déjà ce login.'; 
             } 
          } 
       } 
       else { 
          $erreur = 'Au moins un des champs est vide.'; 
       }  
    }  
    ?>
    <div class="page-header">
        <h1 style="color:white">Inscription à l'espace membre </h1>
      </div>
        <div class="formulaires3">
    <form action="inscription.php" method="post">
    <label for="login">Login :</label>
     <input type="text" name="login" class="form-control" placeholder="Votre pseudo" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
    <label for="mdp">Mot de passe :</label>
     <input type="password" name="mdp" class="form-control" placeholder="Mot de passe valide" value="<?php if (isset($_POST['mdp'])) echo htmlentities(trim($_POST['mdp'])); ?>"><br />
    <label for="confirmation_mdp">Confirmation du mot de passe : </label>
    <input type="password" name="confirm" class="form-control" placeholder="Retapez le mot de passe" value="<?php if (isset($_POST['confirm'])) echo htmlentities(trim($_POST['confirm'])); ?>"><br />
    <input type="submit" name="inscription" value="inscription" class="btn btn-default">
    </form>
        </div>
    <?php
    if (isset($erreur)) echo '<br />',$erreur;  
    ?>
    </body>
    </html> 


        
    </body>
</html>