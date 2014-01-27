<?php
session_start();
 
        if(isset($_POST['id']))
        {
                $nomProduit = $_POST['id'];
                
 
                $temp['panier'] = array();
                $temp['panier']['nomProduit'] = array();
                $temp['panier']['imageProduit']=array();
                $temp['panier']['nomcomProduit']=array();
                $temp['panier']['quantiteProduit'] = array();
                $temp['panier']['prixProduit'] = array();
               
                
 
 
                for($i=0; $i<count($_SESSION['panier']['nomProduit']); $i++)
                {
                        if($_SESSION['panier']['nomProduit'][$i] != $nomProduit)
                        {
                                array_push($temp['panier']['nomProduit'], $_SESSION['panier']['nomProduit'][$i]);
                                array_push($temp['panier']['imageProduit'], $_SESSION['panier']['imageProduit'][$i]);
                                array_push($temp['panier']['nomcomProduit'], $_SESSION['panier']['nomcomProduit'][$i]);
                                array_push($temp['panier']['quantiteProduit'], $_SESSION['panier']['quantiteProduit'][$i]);
                                array_push($temp['panier']['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
                        }
                }
 
                $_SESSION['panier'] = $temp['panier'];
        }
 
        header('Location: panier.php');
        exit;
?>
