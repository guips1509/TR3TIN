<?php
session_start();
?>
<?php

    //on compte le nbre d'articles présent dans le panier
    $nombreArticle=count($_SESSION['panier']['nomProduit']);
  
    
        $nbreProduits = count($_SESSION['panier']['quantiteProduit']);
        $total = 0;

        for($cpt=0;$cpt<$nombreArticle;$cpt++)
        {
           $total += ($_SESSION['panier']['prixProduit'][$cpt]*$_SESSION['panier']['quantiteProduit'][$cpt]);
        }
        
                
    $port = 30.0;
    $user = "val_api1.hotmail.com";
    $password = "H2JBS7KX69NTNLDM";
    $signature = "AfKTSngC0PyOwAeHXv234Aowc6g1AoybMvxwHG.xKZbno4vrNCkv6Atn";
            
     
    $params = array(
        'METHOD' => 'GetExpressCheckoutDetails',        // les meme parametre que pour SetExpressCheckout , mais ici je fais un Get , donc je récupère les info de ventes comme adresse de livraison etc fournit par paypal  et surotut l'état de la vente
        'USER' => $user,
        'VERSION' => '109.0',
        'TOKEN' => $_GET['token'],
        'SIGNATURE'=> $signature,
        'PWD' => $password
        );
    
    $params=  http_build_query($params);
    $endpoint = 'https://api-3T.sandbox.paypal.com/nvp';
    $curl = curl_init();
    curl_setopt_array($curl, array(
                CURLOPT_URL => $endpoint,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $params,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_VERBOSE => 1
            ));
    
     $response =  curl_exec($curl);
     $responseArray = array();
     parse_str($response,$responseArray);
     
    if(curl_errno($curl)){
        var_dump(curl_error($curl));
        curl_close();
        die();
    }
    else{
        if($responseArray['ACK'] == 'Success'){
            
        }
        else{
          var_dump($responseArray);
          die();
        }
        
        curl_close($curl);
        
    }
    
    
    
      header('Location: panier.php');  // je redirige vers le panier après la vente , j'avais essayer de réinitialiser le panier avec suppresion_articles mais pas moyen , meme en recopiant le code ...
     
?>