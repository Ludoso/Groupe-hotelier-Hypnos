<?php
try
{
   
   //ouverture de la connexion a la Bdd
   $pdo = new PDO('mysql:host=localhost;dbname=ECF_GroupeHotelier;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}
$pdoStat = $pdo->prepare('SELECT * from Reservation');

//execution de la requete
$executeisOK = $pdoStat->execute();

//recup des resultats en une seule fois
$mesnoms = $pdoStat->fetchAll();
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
            <a href="AccueuilAdmin.php">
            <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
		   <div id="texte">
            <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>
  <!-- Afficher ce texte plus le nom de l'utilisateur si connecté -->
Bienvenue

<h1>Réservations</h1>
      <table id="customers" border="1" align="center">
         <tr>
            <th>
               Client
            </th>
            <th>
               Hotel
            </th>
            <th>
               Prix
            </th>
            <th>
               Emplacement
            </th>
            <th>
               Date de réservation
            </th>
         </tr>


         <?php foreach ($mesnoms as $monnom): ?>
            <?php
            //Récupère les noms des clients en fonction de l'id
            $pdoStat2 = $pdo->prepare('SELECT * from Client WHERE ID = \''.$monnom["ID_CLIENT"].'\'');

            $executeisOK2 = $pdoStat2->execute();

            $Client = $pdoStat2->fetchAll();

            //Récupère les noms des hotels en fonctions de leur id
            $pdoStat3 = $pdo->prepare('SELECT * from ETABLISSEMENT WHERE ID = \''.$monnom["ID_ETABLISSEMENT"].'\'');

            $executeisOK3 = $pdoStat3->execute();

            $Hotel = $pdoStat3->fetchAll();

            ?>
            <tr> 
               <td>
                  <?php foreach ($Client as $ClientsNom): ?>
                     <?= $ClientsNom['NOM'] ?> 
                  <?php endforeach; ?>
               </td>
                  <?php foreach ($Hotel as $HotelNom): ?>
                     <td><?= $HotelNom['NOM'] ?>
                     </td>
                     <td><?= $HotelNom['PRIX'] ?> 
                     </td>  
                     <td><?= $HotelNom['EMPLACEMENT'] ?>
                     </td>
                  <?php endforeach; ?>
               <td><?= $monnom['DATE_RESERVATION'] ?>
               </td>
            </tr>
         <?php endforeach; ?>
      </table>


</body>