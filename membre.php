<?php
session_start();  
if (!isset($_SESSION['login'])) { 
   header ('Location: compte.php'); 
   exit();  
}  
?>

 
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
 
 <div class="page-header">
        <h1 style="color:white">Bienvenue, <?php echo htmlentities(trim($_SESSION['login'])); ?>!</h1>
      </div>
        <div class="formulaires4">
<a class="btn btn-default" href="deconnexion.php">Déconnexion</a>
<a class="btn btn-default" href="panier.php">Modification du panier</a>
<a class="btn btn-default" href="paiement.php">Confirmer l'achat</a>
        </div>
</body>
</html>
