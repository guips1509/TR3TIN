<?php
session_start();
?>

<?php

if(isset($_SESSION['login']) && !empty($_SESSION['login']))
{  
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
        <h1 style="color:white">Confirmation de paiement !</h1>
      </div>
        
       <!-- <form method="post" action="panier.php">-->
            <!--présentation du panier sous forme de tableau-->
           <div class="table-responsive"> 
            <table class="table table-bordered">
                <tr class="active">
             
                </tr>
                <tr style=" border-width:1px; border-style:solid; border-color:black;">
                    <th class="active">References</th>
                    <th class="active">Articles</th>
                    <th class="active">Nom</th>
                    <th class="active">Quantité</th>
                    <th class="active">Prix Unitaire(€)</th>
                    <th class="active">Prix total(€)</th>
                </tr>
            
<?php

    //on compte le nbre d'articles présent dans le panier
    $nombreArticle=count($_SESSION['panier']['nomProduit']);
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
            echo '<td align="center" class="active">
                <input align="center" type="number" size="4" name="quantite" value="'. htmlspecialchars($_SESSION['panier']['quantiteProduit'][$cpt]) . '"/></td>';
            echo '<td align="center" class="active">'.$_SESSION['panier']['prixProduit'][$cpt].'</td>';
            echo '<td align="center" class="active">'.($_SESSION['panier']['prixProduit'][$cpt]*$_SESSION['panier']['quantiteProduit'][$cpt]).'</td>';
            echo '</tr>';
            echo '<form action="menu.php" method="post"><input type="hidden" name="nbreProduits" value="'.$nbreProduits.'"/></form> ';
            $total += ($_SESSION['panier']['prixProduit'][$cpt]*$_SESSION['panier']['quantiteProduit'][$cpt]);
        }
        
                
    $port = 30.0;                                           //Ici on définit la variable qui contient les frais de port pour utiliser après
    $user = "val_api1.hotmail.com";                         //Ici c'est le nom d'user du vendeur qui est fournit par paypal, faut les récupérer sur sandbox obligatoirement ainsi que password et signature ,  
    $password = "H2JBS7KX69NTNLDM";                         //ça permet d'identifier clairement le vendeur pour les différentes requêtes à envoyer à paypal 
    $signature = "AfKTSngC0PyOwAeHXv234Aowc6g1AoybMvxwHG.xKZbno4vrNCkv6Atn";
            
     
    $params = array(                                        //Ici je fais un tableau qui comprend les paramètres pour l'envoie d'un "formulaire" à paypal , tableau pour faciliter l'envoie avec simplement la variable plus bas
        'METHOD' => 'SetExpressCheckout',                   //Donc ici ce que je veux c'est un SetExpressCheckout , c'est à dire envoyer à paypal les info de la vente pour faire payer au client
        'USER' => $user,                                    //LA vente pour le vendeur stocker dans $user ici au dessus
        'VERSION' => '109.0',                               //La verison de l'api , obligatoire à indiquer
        'SIGNATURE'=> $signature,                           //Signature ici dessus
        'PWD' => $password,                                 //pareil , password stocker plus haut
        'RETURNURL' => 'http://localhost/PhpProject7/process.php',  //Si la vente se déroule bien en renvoie le client sur la page process qui elle meme redirige vers panier.php
        'CANCELURL' => 'http://localhost/PhpProject7/confirmation.php', //Si erreur alors paypal renvoie vers confirmation
                
        'PAYMENTREQUEST_0_AMT' => $total + $port,           //Ici on marque le montant total de la vente donc $total ui est calculé à partir du panier + les frais de port 
        'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',           //on indique la devise
        'PAYMENTREQUEST_0_SHIPPINGAMT' => $port,            //les frais de port
        'PAYMENTREQUEST_0_ITEMAMT' => $total,               //le montant de la vente sans fdp
        
        
                        // J'ai pasindiquer le détail des articles sinon fallait rajouter blindé de lignes à ne plus comprend en jouant avec la db etc 
        
        );
    
    $params=  http_build_query($params);        //Génère une chaîne en encodage URL, construite à partir du tableau indexé 
    $endpoint = 'https://api-3T.sandbox.paypal.com/nvp';  //l'url on on envoie la requête
    $curl = curl_init();                        // interface en ligne de commande destinée à récupérer le contenu d'une ressource , donc ici je demarre curl et je stocke dans la variable curl la réponse
    curl_setopt_array($curl, array(             //je définis les paramètres pour curl , donc l'adresse où récupérer la réponse , combien , les parametres que je récupère etc
                CURLOPT_URL => $endpoint,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_VERBOSE => 1
            ));
    
     $response =  curl_exec($curl);             //ici je prend le resultat de curl dans response
     $responseArray = array();                  //je créer un tableau 
     parse_str($response,$responseArray);       //j'y insère les données de la response
     
    if(curl_errno($curl)){                      //si j'ai une erreur dans curl j'affiche pourquoi avec le var_dump , je ferme curl 
        var_dump(curl_error($curl));
        curl_close();
        die();
    }
    else{
        if($responseArray['ACK'] == 'Success'){     //verification si la requete et la reponse vers paypal rest bonne en testant le champ ACK de la réponse fournie et si error on l'affiche avec var_dump afin de voir l'erreur
            
        }
        else{
          var_dump($responseArray);
          die();
        }
        
        curl_close($curl);
        
    }
    
     $paypal= 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token='.$responseArray['TOKEN']; //donc ici après la requete et réponse on a obtenu un token (visible par responsearray dans une page 
              //donc ici je stocke le lien vers la page de paiement avec le token fournit par paypal en le prenant dynamiquement (car token dynamique forcement) grâce au tableau 
              // j'utilise cette variable sur le bouton payer , donc dans le href pour quand on clique dessus ça nous envoie sur ce lien avec le token associé
?>
    
                                

?>
</table>
           </div>
            <p style="color:white">Il y a <?php echo $_SESSION['nbresarticles']; ?> articles dans le panier, pour un montant total de <?php echo $total; ?> €. Voulez-vous passer au paiement ?</p>
            <p><a href="panier.php"><input class="btn btn-default" type="button" value="Précédent"/></a><a href="<?=$paypal; ?>"><input class="btn btn-default" type="button" value="Payer"/></a></p>

            
<!--</form>-->
</body>
</html>

<?php

}
}
else
{
   
echo '<!DOCTYPE html>
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
             <header>
   
                <div class="header">
                    <div class="row">
                         <div class="col-lg-8">
                             <img src="images/logo2.png" id="logo" alt="logo du site"/><br/>
                             <span id="intro">Bienvenue chez AquaService</span>

                         </div>
                         <div class="col-lg-2">
                             <div id="compte_connexion" class="header"><a href="#"></a></div>
                         </div>
                         <div class="col-lg-2">
                             <!--<img src="images/panier2.png" id="panier" alt="panier du client"/><br/>-->
                         </div>
                     </div> 

               </div>    
<!-------------------------navbar---------------------------------------------->
        <div class="navbar-wrapper">
            <div class="container">

              <div class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">AquaService</a>
                  </div>
                  <div class="navbar-collapse collapse"> <!-- Modif navbar , ajouter les cliquables -->
                    <ul class="nav navbar-nav">
                      <li><a href="index.php">Home</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Eau douce <b class="caret"></b></a>  <!-- menu déroulant, encore rendre cliquable -->
                        <ul class="dropdown-menu">
                          <li><a href="Produits.php">Poissons</a></li>
                          <li><a href="#">Invertébrés</a></li>
                          <li><a href="#">Plantes</a></li>
                          <li><a href="#">Matériel</a></li>
                          <li><a href="#">Décorations</a></li>
                          <li><a href="#">Accessoires</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Eau de mer <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="Produits2.php">Poissons</a></li>
                          <li><a href="#">Invertébrés</a></li>
                          <li><a href="#">Plantes</a></li>
                          <li><a href="#">Matériel</a></li>
                          <li><a href="#">Décorations</a></li>
                          <li><a href="#">Accessoires</a></li>
                        </ul>
                      </li>
                      <li><a href="contact.php">Contact</a></li>
                      <li><a href="compte.php">Compte</a></li>
                    </ul>                     
                  </div>
                </div>
              </div>

            </div>
        </div>

</header>
    Vous n\'êtes pas encore inscrit ou connecté sur notre site, pour finaliser votre payement veuillez vous vendre sur la page <a href="compte.php">d\'inscription</a> 
            </body>
            </html>';
}



?>

