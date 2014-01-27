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
    
    
<?php include("connexion_bdd.php");?>
<?php include("menu.php");  ?>
        
        <div class="page-header">
        <h1 style="color:white">Nous contacter</h1>
      </div>
        
        <div class="formulaires">       
<form action="email.php" method="post">
    <p>
        <label for="civilite">Civilité :</label>
        <select id="civilite" name="civilite" class="form-control">
            <option value="mr" selected="selected">Monsieur</option>
            <option value="mme">Madame</option>
            <option value="mlle">Mademoiselle</option>
        </select>
    </p>
    <p>
        <label for="nom">Nom et prénom :</label>
        <input type="text" id="nom" name="nom" class="form-control" placeholder="Vos noms et prénoms"/>  
    </p>  
    <p>  
        <label for="email">E-mail :</label>  
        <input type="text" id="email" name="email" class="form-control" placeholder="Email"/>  
    </p>
    <p>  
        <label for="sujet">Sujet :</label>  
        <input type="text" id="sujet" name="sujet" class="form-control" placeholder="Objet"/>  
    </p>  
    <p>  
        <label for="message">Message :</label>  
        <textarea id="message" name="message" class="form-control" rows="3" placeholder="Votre message"></textarea>  
    </p>
    <p>
        <input type="submit" name="envoye" value="Envoyer" class="btn btn-default"/>
    </p> 
</form>
        </div>
        
        
        
    </body>
</html>