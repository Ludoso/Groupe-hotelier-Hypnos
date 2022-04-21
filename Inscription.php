<?php
$serveur = "localhost";
$dbname = "ECF_GroupeHotelier";
$user = "root";
$pass = "root";

$nom = valid_donnees($_POST["nom"]);
$prenom = valid_donnees($_POST["prenom"]);
$username = valid_donnees($_POST["username"]);
$password = valid_donnees($_POST["mdp"]);
$password2 = valid_donnees($_POST["mdp2"]);
$type = 1;
echo 'ok';

function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}  
     
try{
    //On se connecte à la BDD
    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbco->prepare("
INSERT INTO Client(NOM, PRENOM, USERNAME, PASSWORD, TYPE)
VALUES(:nom, :prenom, :username, :password, :type)");

$sth->bindParam(':nom',$nom);
$sth->bindParam(':prenom',$prenom);
$sth->bindParam(':username',$username);
$sth->bindParam(':password',$password);
$sth->bindParam(':type', $type);
echo 'ok';
$sth->execute();
header("Location: Connexion.php");
    
}
catch(PDOException $e){
    echo 'Impossible d inserer les données. Erreur : '.$e->getMessage();
}

?>