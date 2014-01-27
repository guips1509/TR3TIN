<?php
session_start();
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
        <link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <title></title>
    </head>
    
    <body>
        
        <?php include("menu.php") ?>
        <?php include("connexion_bdd.php") ?>
       
 <div class="page-header">
        <h1 style="color:white">Articles sélectionnés</h1>
      </div>
        
       <!-- <form method="post" action="panier.php">-->
            <!--présentation du panier sous forme de tableau-->
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="active" >
                   
                </tr>
                <tr style=" border-width:1px; border-style:solid; border-color:black;">
                    <th class="active">References</th>
                    <th class="active">Articles</th>
                    <th class="active">Noms</th>
                    <th class="active">Supprimer</th>
                    <th class="active">Quantité</th>
                    <th class="active">Prix Unitaire(€)</th>
                    <th class="active">Prix total(€)</th>
                </tr>
            
<?php

    //on compte le nbre d'articles présent dans le panier
    if(isset($_SESSION['panier']['nomProduit']))
    {
        $nombreArticle=count($_SESSION['panier']['nomProduit']);
    }
    else
    {
        $nombreArticle=0;
    }
    
    
    //vide
    if($nombreArticle<=0)
    {
        echo '<tr><td><span style="color : red">Le panier est vide !!!</span></td></tr>';
    }
    //il est remplit, on peut donc afficher les articles
    else
    {

        $nbreProduits = count($_SESSION['panier']['quantiteProduit']);
        $total = 0;

        for($cpt=0;$cpt<$nombreArticle;$cpt++)
        {
            echo '<tr>';
            echo '<td class="active">'.$_SESSION['panier']['nomProduit'][$cpt].'</td>';
            echo '<td class="active"><img src="'.$_SESSION['panier']['imageProduit'][$cpt].'"/></td>';
            echo '<td align="center" class="active">'.$_SESSION['panier']['nomcomProduit'][$cpt].'</td>';
            echo '<td align="center" class="active"><form action="suppression_articles.php" method="post">
                            <input type="hidden" name="id"  value="'.$_SESSION['panier']['nomProduit'][$cpt].'"/>
                            <button type="submit"><span class="glyphicon glyphicon-remove"></span></button>
                </form>
                </td>'; 
            echo '<td align="center" class="active">
                <form action="modif_quantite.php" method="post">
                <input type="hidden" name="ID"  value="'. $_SESSION['panier']['nomProduit'][$cpt].'"/>
                <input type="number" size="4" name="quantite" value="'. htmlspecialchars($_SESSION['panier']['quantiteProduit'][$cpt]) . '"/>    
                <button type="submit"><span class="glyphicon glyphicon-repeat"></span></button>
                </form>
                </td>';
            echo '<td align="center" class="active">'.$_SESSION['panier']['prixProduit'][$cpt].'</td>';
            echo '<td align="center" class="active">'.($_SESSION['panier']['prixProduit'][$cpt]*$_SESSION['panier']['quantiteProduit'][$cpt]).'</td>';
            echo '</tr>';
            echo '<form action="menu.php" method="post"><input type="hidden" name="nbreProduits" value="'.$nbreProduits.'"/></form> ';
            
            $total += ($_SESSION['panier']['prixProduit'][$cpt]*$_SESSION['panier']['quantiteProduit'][$cpt]);
            
                
        }
            
    }

?>
</table>
            </div>
            
                
            <p><a href="index.php"><input class="btn btn-default" type="button" value="Précédent"/></a><a href="paiement.php"><input class="btn btn-default" type="button" value="Confirmer"/></a></p>
            
<!--</form>-->
</body>
</html>
