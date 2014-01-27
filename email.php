<?php

/* Récupération des valeurs des champs du formulaire */
if (get_magic_quotes_gpc())
{
    $civilite = stripslashes(htmlspecialchars($_POST['civilite'])); 
    $nom = stripslashes(htmlspecialchars($_POST['nom'])); 
    $expediteur = stripslashes(htmlspecialchars($_POST['email'])); 
    $sujet = stripslashes(htmlspecialchars($_POST['sujet'])); 
    $message = stripslashes(htmlspecialchars($_POST['message'])); 
} 
else
{  
    $civilite = htmlspecialchars($_POST['civilite']);
    $nom = htmlspecialchars($_POST['nom']); 
    $expediteur = htmlspecialchars($_POST['email']); 
    $sujet = htmlspecialchars($_POST['sujet']); 
    $message = htmlspecialchars($_POST['message']); 
}
/* envoyer le mail */
if(empty($civilite) 
    || empty($nom) 
    || empty($expediteur) 
    || empty($sujet) 
    || empty($message))
{

 echo '<p>Tous les champs des formulaires doivent être complétés, vous pouvez retourner sur <a href="contact.php">la page</a> en cliquant sur le lien.</p>';

}
else
{
    /* Destinataire (votre adresse e-mail) */
$to = 'guillaume.demarez@hotmail.com';

    /* Construction du message */
$msg  = 'Bonjour,'."\r\n\r\n";
$msg .= 'Ce mail a été envoyé depuis le site d\'AquaService par '.$civilite.' '.$nom."\r\n\r\n";
$msg .= 'Voici le message qui vous est adressé :'."\r\n";
$msg .= '***************************'."\r\n";
$msg .= $message."\r\n";
$msg .= '***************************'."\r\n";
 
/* En-têtes de l'e-mail */
$headers = 'From: '.$nom.' <'.$expediteur.'>'."\r\n\r\n";
 
/* Envoi de l'e-mail */
mail($to, $sujet, $msg, $headers);

header('location:contact.php');
}
?>
