
<!------------------------entête------------------>
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
                      <li>
                                 <?php
                              if(isset($_SESSION['login']) && !empty($_SESSION['login']))
                              {
                                  echo'<a href="membre.php">Zone membre</a>';
                              }
                              else
                              {
                                  echo '<a href="compte.php">Compte</a>';
                              }
                                 ?>
                          </li>
                      
                    </ul>
                       <ul class="nav navbar-nav navbar-right">
                           <li><a href="panier.php"><button type="button" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-shopping-cart"></span></button>
                            <span class="badge">
                                <?php
                                
                                if(isset($_SESSION['panier']['quantiteProduit']))
                                {
                                    $temp = count($_SESSION['panier']['quantiteProduit']);
                                }
                                else
                                {
                                   $nbrProduits = 0;
                                   $temp=0;
                                }
                                
                                $nbrProduits = 0;

                                for($i=0; $i< $temp; $i++)
                                {
                                    if(isset($_SESSION['panier']['quantiteProduit']))
                                    {
                                        $nbrProduits += $_SESSION['panier']['quantiteProduit'][$i];
                                    }
                                    else
                                    {
                                      $nbrProduits=0;
                                    }
                                 
                                }
                                
                                echo $nbrProduits;
                                $_SESSION['nbresarticles'] = $nbrProduits;
                                
                                ?>
                        </span></a></li>
                       </ul>
                  </div>
                </div>
              </div>

            </div>
        </div>

</header>