<?php session_start();  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="assets/js/jquery.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>
        <script src="assets/js/holder.js"></script>
        <link href="dist/css/bootstrap.css" rel="stylesheet">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css"/>
        <title></title>
    </head>
    
    <body>
        <?php include("menu.php") ?>
        <?php include("connexion_bdd.php") ?>
          
     <div class="page-header">
        <h1 style="color:white">Poissons eau douce</h1>
      </div>
        <div class="conteneur">
            <div class="menugauche"></div>              <!-- Div pour le menu deroulant à gauche-->
        <div id="menu_articles"> 
                                                           <!-- Suppression navbar pour la mettre dans le menu -->

     
            <form action="Produits.php" method="post">
                <select style="display:inline-block;width: 150px;" class="form-control" name="ordre">
                <option value="A">A-Z</option>
                <option value="Z">Z-A</option>
                <option value="plus">Le + cher</option>
                <option value="moins">Le - cher</option>
                </select>
                <select  style="display:inline-block;width: 150px;" class="form-control" name="nbreArticles">
                    <option value="6">6</option>
                    <option value="12">12</option>
                    <option value="18">18</option>
                    <option value="24">24</option>
                </select>
            <input style="display:inline-block;width: 100px;" class="form-control" type="submit"/>
            </form>
     
        
        </div>
        <div class="menu_produits">
        <div id="produits">
        
            
                       
        <?php
                    $nbreArticles=6;
                    if(!empty($_POST['nbreArticles']))
                    {
                        $nbreArticles=$_POST['nbreArticles']; //On recupere depuis select
                    }
                    else if(!empty($_GET['nbreArticles']))
                        $nbreArticles=$_GET['nbreArticles']; //On recupere depuis url
        
        $pageActuelle= (empty($_GET['page']) ? 0 :  $_GET['page']);
        
        if(!empty($_GET['ordre']))
            $_POST['ordre'] = $_GET['ordre'];
                    
                     if(isset($_POST['ordre']) && $_POST['ordre']=="A")
                     {
                         $rep = $bdd->query('SELECT * FROM poissons ORDER BY nom_commun LIMIT ' . ($nbreArticles * $pageActuelle) . ', ' . $nbreArticles);
                        while($donnees=$rep->fetch())
                        {
                             echo '<div class="article" ><p>'.$donnees['nom_commun'].'<br/>
                                 '.$donnees['taille'].' cm<br/>
                                 '.$donnees['prix'].' €    </p>
                                 <img src="' .$donnees['image'] .'"/><br/>
                                 <form style="" method="post" action="commande.php">
                                 <input class="form-control" type="hidden" name="ID" value="'.$donnees['ID'].'"/>
                                 <input class="form-control" type="hidden" name="nom" value="'.$donnees['nom_commun'].'"/>   
                                 <input class="form-control" type="hidden" name="prix" value="'.$donnees['prix'].'"/>
                                 <input class="form-control" type="hidden" name="image" value="'.$donnees['image'].'"/>    
                                 <input class="form-control" type="number" name="qte" value="0"/>
                                 <input class="form-control" type="submit" value="Ajouter au panier"/>
                                 </form><br/></div>';
                        }
                     }
                     else if(isset($_POST['ordre']) && $_POST['ordre']=="Z")
                     {
                         $rep = $bdd->query('SELECT * FROM poissons ORDER BY nom_commun DESC LIMIT ' . ($nbreArticles * $pageActuelle) . ', ' . $nbreArticles);
                        while($donnees=$rep->fetch())
                        {
                             echo '<div class="article" ><p>'.$donnees['nom_commun'].'<br/>
                                 '.$donnees['taille'].' cm<br/>
                                 '.$donnees['prix'].' €    </p>
                                 <img src="' .$donnees['image'] .'"/><br/>
                                 <form style="" method="post" action="commande.php">
                                 <input class="form-control" type="hidden" name="ID" value="'.$donnees['ID'].'"/>
                                 <input class="form-control" type="hidden" name="nom" value="'.$donnees['nom_commun'].'"/>   
                                 <input class="form-control" type="hidden" name="prix" value="'.$donnees['prix'].'"/>
                                 <input class="form-control" type="hidden" name="image" value="'.$donnees['image'].'"/>    
                                 <input class="form-control" type="number" name="qte" value="0"/>
                                 <input class="form-control" type="submit" value="Ajouter au panier"/>
                                 </form><br/></div>';
                             

                        }
                     }
                     else if(isset($_POST['ordre']) && $_POST['ordre']=="plus")
                         {
                         $rep = $bdd->query('SELECT * FROM poissons ORDER BY prix DESC LIMIT ' . ($nbreArticles * $pageActuelle) . ', ' . $nbreArticles);
                        while($donnees=$rep->fetch())
                        {
                             echo '<div class="article" ><p>'.$donnees['nom_commun'].'<br/>
                                 '.$donnees['taille'].' cm<br/>
                                 '.$donnees['prix'].' €    </p>
                                 <img src="' .$donnees['image'] .'"/><br/>
                                 <form style="" method="post" action="commande.php">
                                 <input class="form-control" type="hidden" name="ID" value="'.$donnees['ID'].'"/>
                                 <input class="form-control" type="hidden" name="nom" value="'.$donnees['nom_commun'].'"/>   
                                 <input class="form-control" type="hidden" name="prix" value="'.$donnees['prix'].'"/>
                                 <input class="form-control" type="hidden" name="image" value="'.$donnees['image'].'"/>    
                                 <input class="form-control" type="number" name="qte" value="0"/>
                                 <input class="form-control" type="submit" value="Ajouter au panier"/>
                                 </form><br/></div>';
                        }
                     }
                     else if(isset($_POST['ordre']) && $_POST['ordre']=="moins")
                         {
                         $rep = $bdd->query('SELECT * FROM poissons ORDER BY prix LIMIT ' . ($nbreArticles * $pageActuelle) . ', ' . $nbreArticles);
                        while($donnees=$rep->fetch())
                        {
                             echo '<div class="article" ><p>'.$donnees['nom_commun'].'<br/>
                                 '.$donnees['taille'].' cm<br/>
                                 '.$donnees['prix'].' €    </p>
                                 <img src="' .$donnees['image'] .'"/><br/>
                                 <form style="" method="post" action="commande.php">
                                 <input class="form-control" type="hidden" name="ID" value="'.$donnees['ID'].'"/>
                                 <input class="form-control" type="hidden" name="nom" value="'.$donnees['nom_commun'].'"/>   
                                 <input class="form-control" type="hidden" name="prix" value="'.$donnees['prix'].'"/>
                                 <input class="form-control" type="hidden" name="image" value="'.$donnees['image'].'"/>    
                                 <input class="form-control" type="number" name="qte" value="0"/>
                                 <input class="form-control" type="submit" value="Ajouter au panier"/>
                                 </form><br/></div>';
                        }
                     }
                    else
                   {
                        $rep = $bdd->query('SELECT * FROM poissons ORDER BY prix LIMIT ' . ($nbreArticles * $pageActuelle) . ', ' . $nbreArticles);
                        while($donnees=$rep->fetch())
                        {
                             echo '<div class="article" ><p>'.$donnees['nom_commun'].'<br/>
                                 '.$donnees['taille'].' cm<br/>
                                 '.$donnees['prix'].' €    </p>
                                 <img src="' .$donnees['image'] .'"/><br/>
                                 <form style="" method="post" action="commande.php">
                                 <input class="form-control" type="hidden" name="ID" value="'.$donnees['ID'].'"/>
                                 <input class="form-control" type="hidden" name="nom" value="'.$donnees['nom_commun'].'"/>   
                                 <input class="form-control" type="hidden" name="prix" value="'.$donnees['prix'].'"/>
                                 <input class="form-control" type="hidden" name="image" value="'.$donnees['image'].'"/>    
                                 <input class="form-control" type="number" name="qte" value="0"/>
                                 <input class="form-control" type="submit" value="Ajouter au panier"/>
                                 </form><br/></div>';
                        }
                   }
                     
                     
                   

                    ?>
        </div>
        </div>
        </div>
        <?php
         
            $req_count=$bdd->query('SELECT COUNT(*) AS resultat FROM poissons');
            
            $donnee_count = $req_count->fetch();
            
            $nbPages = ceil($donnee_count['resultat'] / $nbreArticles);
            echo'<div id="pagination">';
            echo '<ul class="pagination">
             <li><a href="#">&laquo;</a></li>';
            for($i=0;$i<$nbPages;$i++)
            {
                $active = ($i==$pageActuelle) ? 'class="active"' : '';
                
                if(isset($_POST['ordre']))
                    echo '<li ' . $active. '><a href="Produits.php?page=' . $i . '&ordre=' . $_POST['ordre'] . '&nbreArticles='. $nbreArticles . '">'. ($i+1) .'</a></li>';
                else
                    echo '<li ' . $active. '><a href="Produits.php?page=' . $i . '">'. ($i+1) .'</a></li>';
                    
            }
                if(isset($_POST['ordre']))
                    echo '<li><a href="Produits.php?page=' . ($pageActuelle+1) . '&ordre=' . $_POST['ordre'] .' ">&raquo;</a></li></ul>';
                else
                    echo '<li><a href="Produits.php?page=' . ($pageActuelle+1) .' ">&raquo;</a></li></ul>';
              echo'</div>';  
           ?> 
    </body>

</html>
