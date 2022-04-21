<?php
session_start();
try
{
   
   //ouverture de la connexion a la Bdd
   $db = new PDO('mysql:host=localhost;dbname=ECF_GroupeHotelier;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}

//Prépare la récupération de toutes les catégories disponibles

//Prépare a récupérer les données de l'utilisateur
$pdoUtilisateur = $db->prepare('SELECT * from Client WHERE USERNAME=\''.$_SESSION['username'].'\'');

$executeUtilisateur = $pdoUtilisateur->execute();

$Utilisateur = $pdoUtilisateur->fetchAll();
?>

<head>
  <title>Accueuil</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="monCSS.css">
</head>

<body>
  <!-- Bandeau du haut de la page -->
  <header>
		<div id="header">
			<div id="logo">
        <a href="AccueuilMembre.php">
        <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
      <div id="Utilisateur">
        <?php foreach ($Utilisateur as $UtilisateurNom):
          echo $UtilisateurNom['NOM']. " " .$UtilisateurNom['PRENOM'];
        endforeach;?>
			</div>
			<div id="texte">
        <a href="RéservationsClient.php">Voir ses réservations</a><br>
        <a href="Contact.php">Contacter Hypnos</a><br>
        <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>
  <!-- Afficher ce texte plus le nom de l'utilisateur si connecté -->

<BR><BR><BR><BR>
<?php
  $min = 0;
  $pagesuivante = 0;
  $pageprecedente = 0;
  if (isset($_GET['min'])){
    $min = $_GET['min'];
  }
  if ($min >= 5){
    $pageprecedente = $min  - 10;
    $pagesuivante = $min  + 10; 
    echo '<a href="AccueuilClient.php?min='.$pageprecedente.'">Précédent</a>'; 
    echo '<a href="AccueuilClient.php?min='.$pagesuivante.'">Suivant</a>'; 
  }
  else{
    $pagesuivante = $min  + 10; 
    echo '<a href="AccueuilClient.php?min='.$pagesuivante.'">Suivant</a>'; 
  }
?>
<h1>Liste des hôtels</h1>
  <table id="customers" border="1" align="center">
    <tr>
      <th>
        Nom
      </th>
      <th>
        Prix
      </th>
      <th>
        Emplacement
      </th>
      <th>
        Faire une réservation
      </th>
    </tr>
    <?php
      //prepa de la requete pour récupérer les produits disponibles
      $pdoStat = $db->prepare("SELECT * from ETABLISSEMENT LIMIT $min, 10");

      //execution de la requete
      $executeisOK = $pdoStat->execute();

      //recup des resultats en une seule fois
      $mesnoms = $pdoStat->fetchAll();
    ?>

  <?php foreach ($mesnoms as $monnom): ?>
    <tr> 
      <td><?= $monnom['NOM'] ?> 
      </td>
      <td><?= $monnom['PRIX'] ?> 
      </td>  
      <td><?= $monnom['EMPLACEMENT'] ?>
      </td>
      <td>
      <? $monlien= "Reservation.php?ID=".$monnom['ID'] ?>  
               <a href="<? echo $monlien; ?>">Voir détail</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>

<BR><BR><BR><BR>

</body>