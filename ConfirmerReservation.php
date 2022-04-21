<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ECF_GroupeHotelier', 'root', 'root');
  } 
  
  catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
    
  }
$UtilisateurNom = $_SESSION['username'];
$Hotel = valid_donnees($_POST["hotel"]);
$date = $_POST['date']

function valid_donnees($donnees){
  $donnees = trim($donnees);
  $donnees = stripslashes($donnees);
  $donnees = htmlspecialchars($donnees);
  return $donnees;
}  
  
$HotelStat = $pdo->prepare('SELECT * FROM Etablissement  WHERE ID = \''.$Hotel.'\'');
$HotelOK = $HotelStat->execute();
$Hotel = $HotelStat->fetchAll();
$UtilisateurStat = $pdo->prepare('SELECT ID FROM Client WHERE USERNAME = \''.$UtilisateurNom.'\'');
$UtilisateurOK = $UtilisateurStat->execute();
$Utilisateur = $UtilisateurStat->fetchAll();
foreach($Hotel as $row1){
  foreach ($Utilisateur as $row2){
        $Prix = $row1['PRIX'];
        $data = $pdo->prepare("
          INSERT INTO RESERVATION(ID_CLIENT, DATE_RESERVATION, ID_ETABLISSEMENT, PRIX) 
          VALUES (:id_client, :date, :ID_hotel, :Prix)");
        $data->bindParam(':id_client',$row2["ID"]);
        $data->bindParam(':date',$date);
        $data->bindParam(':ID_hotel',$row1["ID"]);
        $data->bindParam(':Prix',$Prix);
        $data->execute();
        echo "Votre réservation a été prise en compte.";
      }
  }
//$data->bindValue($valeur, ID_COMMANDE);

?>

<form action="AccueuilMembre.php">
<button type="submit">Retour à l'accueuil</button>
</form>