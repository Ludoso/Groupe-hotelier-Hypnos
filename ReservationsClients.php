<?php
try
{
   session_start();
   //ouverture de la connexion a la Bdd
   $db = new PDO('mysql:host=localhost;dbname=ECF_GroupeHotelier;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer 
?>

<!doctype html>
   <html lang="en">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
      <title>Réservations</title>

   </head>
   <body>

   <header>
      <!-- Bandeau du haut de la page -->
		<div id="header">
			<div id="logo">
            <a href="AccueuilClient.php">
            <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
            <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>
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
         echo '<a href="ReservationsClient.php?min='.$pageprecedente.'">Précédent</a>'; 
         echo '<a href="ReservationsClients.php?min='.$pagesuivante.'">Suivant</a>'; 
      }
      else{
         $pagesuivante = $min  + 10; 
         echo '<a href="ReservationsClients.php?min='.$pagesuivante.'">Suivant</a>'; 
      }
   ?>
      <h1>Liste des jeux</h1>
      <!-- Tableau affichant la totalité des articles avec leur quantité disponible, leur prix et leur catégorie -->
      <table id="customers" border="1" align="center">
         <tr>
            <th>
               Hotel
            </th>
            <th>
               Emplacement
            </th>
            <th>
               Prix
            </th>
            <th>
               Date
            </th>
         </tr>
         <?php
        $client = $db->prepare('SELECT * from Client WHERE USERNAME = \''.$_SESSION['username'].'\'')
        
        $ClientOK = $client->execute();

        $monclient = $client->fetchAll();
            foreach($monclient as $client:){
                $pdoStat = $db->prepare('SELECT * from Reservation LIMIT \''.$min.'\', 10 WHERE ID_CLIENT = \''.$client['ID'].'\'');

                $executeisOK = $pdoStat->execute();

                $mesnoms = $pdoStat->fetchAll();
            ?>
         <?php foreach ($mesnoms as $monnom): ?>
            <?php
               $pdoStat2 = $db->prepare('SELECT * from Etablissement WHERE ID_ETABLISSEMENT = \''.$monnom["ID"].'\'');

               $executeisOK2 = $pdoStat2->execute();

               $mesnoms2 = $pdoStat2->fetchAll();
            ?>
         <tr> 
            <td><?= $monnom['NOM'] ?> 
            </td>
            <td>
               <?php foreach ($mesnoms2 as $monnom2): ?>
                  <?= $monnom2['EMPLACEMENT'] ?>
               <?php endforeach; ?>
            </td>
            <td><?= $monnom['PRIX'] ?> 
            </td>  
            <td>
               <?php foreach ($mesnoms2 as $monnom2): ?>
                  <?= $monnom2['DATE_RESERVATION'] ?>
               <?php endforeach; ?>
            </td>
          </tr>
         <?php endforeach; ?>
        <?php endforeach; ?>
         </table>
         <BR><BR><BR><BR>
   </body>
   </html>