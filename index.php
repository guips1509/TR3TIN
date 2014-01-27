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
    
    <?php 
    
    include('connexion_bdd.php');
    include('menu.php');
    
    ?>
    
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
            <?php 
              $req6 = $bdd->query('SELECT * FROM `carrousel` WHERE nom="discus"');
              $image_index6 = $req6->fetch();
              echo '<img src="'.$image_index6['image'].'" alt="First slide"/>
                 <div class="container">
            <div class="carousel-caption">
              <h1>Les poissons d\'eau douce</h1>
              <p>'.$image_index6['description'].'</p>
              <p><a class="btn btn-large btn-primary" href="Produits.php">Passez commande</a></p>
            </div>
          </div> 
                ';
              ?>
        </div>
        <div class="item">
          <?php 
              $req7 = $bdd->query('SELECT * FROM `carrousel` WHERE nom="marin"');
              $image_index7 = $req7->fetch();
              echo '<img src="'.$image_index7['image'].'" alt="First slide"/>
                 <div class="container">
            <div class="carousel-caption">
              <h1>Nos coraux</h1>
              <p>'.$image_index7['description'].'</p>
              <p><a class="btn btn-large btn-primary" href="Produits2.php">Passez commande</a></p>
            </div>
          </div> 
                ';
              ?>
        </div>
        <div class="item">
          <?php 
              $req8 = $bdd->query('SELECT * FROM `carrousel` WHERE nom="poisson"');
              $image_index8 = $req8->fetch();
              echo '<img src="'.$image_index8['image'].'" alt="First slide"/>
                 <div class="container">
            <div class="carousel-caption">
              <h1>Les poissons marin</h1>
              <p>'.$image_index8['description'].'</p>
              <p><a class="btn btn-large btn-primary" href="Produits2.php">Passez commande</a></p>
            </div>
          </div> 
                ';
              ?>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
    
    <!---------------------------------------------------vignettes------------------------------------------------------------>
    <div class="page-header">
        <h1>Les produits proposés</h1>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Aquariums</h3>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>
              <?php 
              $req1 = $bdd->query('SELECT * FROM `index` WHERE nom="aquarium"');
              $image_index1 = $req1->fetch();
              echo '<a href="#"><img title="cliquez sur l\' image pour accéder à la section" src="'.$image_index1['image'].'"/></a>';
              ?>
                        </td>
                        <td></td>
                        <td>
                            
                            nos Aquariums :
                            <ul>
                                <li>Tetra</li>
                                <li>Sera</li>
                                <li>Jewel</li>
                                <li>Aquamedic</li>
                                <li>Elos</li>
                                <li>...</li>
                            
                            </ul>
                           
                        </td>
                    </tr>
                </table>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Eau douce</h3>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>
              <?php 
              $req2 = $bdd->query('SELECT * FROM `index` WHERE nom="douce"');
              $image_index2 = $req2->fetch();
              echo '<a href="Produits.php"><img title="cliquez sur l\' image pour accéder à la section" src="'.$image_index2['image'].'"/></a>';
              ?>
                        </td>
                        <td></td>
                        <td>
                            
                            Nos poissons :
                            <ul>
                                <li>Discus</li>
                                <li>Mollys</li>
                                <li>Platys</li>
                                <li>Cychlidés</li>
                                <li>Arowanas</li>
                                <li>...</li>
                            
                            </ul>
                           
                        </td>
                    </tr>
                </table>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Eau de mer</h3>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>
              <?php 
              $req3 = $bdd->query('SELECT * FROM `index` WHERE nom="mer"');
              $image_index3 = $req3->fetch();
              echo '<a href="Produits2.php"><img title="cliquez sur l\' image pour accéder à la section" src="'.$image_index3['image'].'"/></a>';
              ?>
                </td>
                        <td></td>
                        <td>
                            
                            Nos poissons :
                            <ul>
                                <li>Clown</li>
                                <li>Demoiselles</li>
                                <li>Requins</li>
                                <li>Murènes</li>
                                <li>Scorpions</li>
                                <li>...</li>
                            
                            </ul>
                           
                        </td>
                    </tr>
                </table>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Plantes</h3>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>
              <?php 
              $req4 = $bdd->query('SELECT * FROM `index` WHERE nom="plantes"');
              $image_index4 = $req4->fetch();
              echo '<a href="Produits.php"><img title="cliquez sur l\' image pour accéder à la section" src="'.$image_index4['image'].'"/></a>';
              ?>
                    </td>
                        <td></td>
                        <td>
                            
                            Nos plantes :
                            <ul>
                                <li>Anubias</li>
                                <li>Cryptocoryne</li>
                                <li>Mousse de java</li>
                                <li>Echinodorus</li>
                                <li>Myriophyllum</li>
                                <li>...</li>
                            </ul>
                           
                        </td>
                    </tr>
                </table>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Coraux</h3>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>
              <?php 
              $req5 = $bdd->query('SELECT * FROM `index` WHERE nom="coraux"');
              $image_index5 = $req5->fetch();
              echo '<a href="Produits2.php"><img title="cliquez sur l\' image pour accéder à la section" src="'.$image_index5['image'].'"/></a>';
              ?>
                </td>
                        <td></td>
                        <td>
                            Nos coraux :
                            <ul>
                                <li>Coraux Mous</li>
                                <li>Gorgones</li>
                                <li>Sabelles-Spirographes</li>
                                <li>Les Polypes </li>
                                <li>Eponges</li>
                                <li>...</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
          </div>
          <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Divers</h3>
            </div>
            <div class="panel-body">
                <table>
                    <tr>
                        <td>
               <?php 
              $req6 = $bdd->query('SELECT * FROM `index` WHERE nom="divers"');
              $image_index6 = $req6->fetch();
              echo '<a href="#"><img title="cliquez sur l\' image pour accéder à la section" src="'.$image_index6['image'].'"/></a>';
              ?>
                        </td>
                        <td></td>
                        <td>
                            Le matériel :
                            <ul>
                                <li>Pompes</li>
                                <li>Masses filtrantes</li>
                                <li>Tests de l'eau</li>
                                <li>Pièces détachées</li>
                                <li>lampes</li>
                                <li>...</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        </div>
        
        <?php
            include ('footer.php');
        ?>

    </body>
</html>
