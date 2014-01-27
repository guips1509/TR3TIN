<?php
session_start();


$login=$_SESSION['login'];
$base = mysql_connect ('localhost', 'root', ''); 
      mysql_select_db ('aquaservice',$base);  
$sql= "SELECT role FROM connexion WHERE login='$login'";
$req = mysql_query($sql) or die(mysql_errno());
$data = mysql_fetch_assoc($req);
$_TEST['AUTH'] =array(
    'login' => $login,
    'role' => $data['role']);
?>

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
            
        
   
    </body>

</html>

<?php

if($data['role'] != "admin"){
    
    echo 'Vous n\'avez pas les droits nécessaires !';
}
    else{ echo '       <form action="Ajout.php" method="post">
            Nom commun :<br/>
            <input type="text" name="nomcom"/><br/>
            Nom scientifique :<br/>
            <input type="text" name="nomscient"/><br/>
            Type d\'eau :<br/>
            <select name="typeeau">
                <option value="douce">Douce</option>
                <option value="salee">Salée</option>
                <option value="saumatre">Saumâtre</option>
            </select><br/> 
            Famille :<br/>
           <select name="famille">
                <option value="discus">Discus</option>
                <option value="africainfluvial">Africain fluvial</option>
                <option value="arowana">Arowanas</option>
            </select><br/> 
            Taille :<br/>
            <input type="text" name="taille"/><br/>
            Prix :<br/>
            <input type="text" name="prix"/><br/>
            Disponibilité :<br/>
            <input type="text" name="dispo"/><br/>
            Image :<br/>
            <input type="text" name="image"/><br/>
            Litrage de l\'aquarium :<br/>
            <input type="text" name="litrageaqua"/><br/>
            Maintenance :<br/>
            <select name="maintenance">
                <option value="facile">Facile</option>
                <option value="moyen">Moyen</option>
                <option value="difficile">Difficile</option>
                <option value="impossible">Impossible</option>
            </select><br/>
            Quantité disponible :<br/>
            <input type="text" name="quantite"/><br/>
            Origine :<br/>
            <select name="origine">
                <option value="asie">Asie</option>
                <option value="ameriquenord">Amérique du nord</option>
                <option value="ameriquesud">Amérique du sud</option>
                <option value="europe">Europe</option>
                <option value="oceanie">Océanie</option>
                <option value="merrouge">Mer rouge</option>
                <option value="oceanatl">Océan atlantique</option>
                <option value="oceanpacif">Océan Pacifique</option>
                <option value="oceanind">Océan Indien</option>
                <option value="autres">Autres</option>
            </select><br/> 
             Température de l\'eau :<br/>
            <input type="text" name="temperature"/><br/>
             Ph de l\'eau :<br/>
            <input type="text" name="ph"/><br/>
             Dureté de l\'eau<br/>
            <input type="text" name="durete"/><br/>
             Zone de vie :<br/>
            <select name="zonedevie">
                <option value="haut">Haut</option>
                <option value="milieu">Milieu</option>
                <option value="fond">Fond</option>
            </select><br/> 
            Description :<br/>
            <textarea name="description" rows=\'20\' cols=\'20\'>
            </textarea><br/>
            Espérance de vie :<br/>
            <input type="text" name="esperancedevie"/><br/>
            Comportement :<br/>
            <textarea name=\'comportement\' rows=\'20\' cols=\'20\'>
            </textarea><br/>
            Reproduction :<br/>
            <select name="reproduction">
                <option value="facile">Facile</option>
                <option value="moyenne">Moyenne</option>
                <option value="difficile">Difficile</option>
                <option value="impossible">Impossible</option>
            </select><br/> 
            Dimorphisme :<br/>
            <textarea name="dimorphisme" rows=\'20\' cols=\'20\'>
            </textarea><br/>
            ENVOYER=><input type="submit"/>
        </form>
        
';
    }

?>
