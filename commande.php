<?php
session_start();
?>
<?php


//Création de mon panier => vérification de la présence de mon panier


    if(!isset($_SESSION['panier']))
    {
                $_SESSION['panier']=array();
                $_SESSION['panier']['nomProduit']=array();
                $_SESSION['panier']['prixProduit']=array();
                $_SESSION['panier']['quantiteProduit']=array();
                $_SESSION['panier']['imageProduit']=array();
                $_SESSION['panier']['nomcomProduit']=array();
    }


//Ajout d'articles dans le panier

    if(isset($_POST['ID']))
    {
        $nomProduit=$_POST['ID'];
        $quantiteProduit=$_POST['qte'];
        $prixProduit=$_POST['prix'];
        $imageProduit=$_POST['image'];
        $nomcomProduit=$_POST['nom'];
    
   
        //recherche dans mon array $nomProduit, retourne la clé si elle est trouvée et FALSE si rien  n'a été trouvé.
        $positionProduit = array_search($nomProduit, $_SESSION['panier']['nomProduit']);
        if($positionProduit!==FALSE)
        {
            //un article à été trouvé, on augmente la quantité
            $_SESSION['panier']['quantiteProduit'][$positionProduit] += $quantiteProduit;
            
        }
        else
        {
           //false à été retourné, on ajoute un article
           array_push($_SESSION['panier']['nomProduit'], $nomProduit);
           array_push($_SESSION['panier']['quantiteProduit'], $quantiteProduit);
           array_push($_SESSION['panier']['prixProduit'], $prixProduit);
           array_push($_SESSION['panier']['imageProduit'],$imageProduit);
           array_push($_SESSION['panier']['nomcomProduit'],$nomcomProduit);
        }
    }
    
    
    header('Location: panier.php');
    exit;



?>
