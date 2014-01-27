<?php
session_start();

if(isset($_POST['ID']) && is_numeric($_POST['ID']) && isset($_POST['quantite']) && is_numeric($_POST['quantite']))
{
    $id = $_POST['ID'];
    $qtite = $_POST['quantite'];
    
    $position = array_search($id, $_SESSION['panier']['nomProduit']); 
    
    if($position !==FALSE)
        {
            
            $_SESSION['panier']['quantiteProduit'][$position] = $qtite;
            
        }
        
}

header('Location: panier.php');
exit;

?>
