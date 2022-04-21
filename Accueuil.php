<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=ECF_GroupeHotelier', 'root', 'root');
  } 
  
  catch (PDOException $e) {
	echo 'Impossible de se connecter à la base de données';
	
  }
//Limite du nombre d'articles par page

if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
   //Vérifie si l'username et le mot de passe ont été entrés sur la page de connexion
	if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['mdp']) && !empty($_POST['mdp']))) {
	
		$pdo = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');
      //Vérifie si les données entrées correspondent à celles d'un utilisateur normal
		$pdoStat = $pdo->prepare('SELECT count(*) AS total FROM Utilisateur WHERE USERNAME=\''.$_POST['username'].'\' AND PASSWORD=\''.$_POST['mdp'].'\' AND TYPE=3');
		$pdoStat->execute();
		$resultat = $pdoStat->fetch(PDO::FETCH_ASSOC);

      //Vérifie si les données entrées correspondent à celles d'un utilisateur admin
      $pdoStat2 = $pdo->prepare('SELECT count(*) AS total2 FROM Utilisateur WHERE USERNAME=\''.$_POST['username'].'\' AND PASSWORD=\''.$_POST['mdp'].'\' AND TYPE=2');
		$pdoStat2->execute();
		$resultat2 = $pdoStat2->fetch(PDO::FETCH_ASSOC);

      $pdoStat3 = $pdo->prepare('SELECT count(*) AS total3 FROM Utilisateur WHERE USERNAME=\''.$_POST['username'].'\' AND PASSWORD=\''.$_POST['mdp'].'\' AND TYPE=1');
		$pdoStat3->execute();
		$resultat3 = $pdoStat3->fetch(PDO::FETCH_ASSOC);

      //Dans le cas où l'utilisateur est un admin
      if ($resultat2['total'] == 1){
         session_start();
			$_SESSION['username'] = $_POST['username'];
			header('Location: AccueuilAdmin.php');
			exit();
      }

      //Dans le cas où l'utilisateur est un gérant
      elseif ($resultat['total2'] == 1) {
			session_start();
			$_SESSION['username'] = $_POST['username'];
			header('Location: AccueuilGérant.php');
			exit();
		}

	   //Dans le cas où l'utilisateur est un membre normal
		elseif ($resultat['total3'] == 1) {
			session_start();
			$_SESSION['username'] = $_POST['username'];
			header('Location: AccueuilClient.php');
			exit();
		}
	}

		//aucune réponse
		elseif ($resultat['total'] == 0) {
			echo "On est dans l'erreur = 0";
			$erreur = 'Compte non reconnu.';
		}
		//gros problème
		elseif ($resultat['total'] > 1) {
			$erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
	}
}
else {
	$erreur = 'Au moins un des champs est vide.';
	}
?>

<head>
    <title>Accueuil</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="monCSS.css">
</head>

<body>
   <!-- Bandeau de haut de page -->
	<header>
		<div id="header">
			<div id="logo">
            <a href="Accueuil.php">
				<img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
				<li><a href="Connexion.php">Se connecter</a></li>
				<li><a href="CreerCompte.php">S'inscrire</a></li>
			</div>
		</div>
	</header>

<BR><BR><BR><BR>
      <!-- Affiche la liste des hôtels disponibles -->
      <?php

         //Vérification de la page actuelle pour la base de données
         $min = 0;
         $pagesuivante = 0;
         $pageprecedente = 0;
         if (isset($_GET['min'])){
            $min = $_GET['min'];
         }
         if ($min >= 5){
            $pageprecedente = $min  - 10;
            $pagesuivante = $min  + 10; 
            echo '<a href="Accueuil.php?min='.$pageprecedente.'">Précédent</a>'; 
            echo '<a href="Accueuil.php?min='.$pagesuivante.'">Suivant</a>'; 
         }
         else{
            $pagesuivante = $min  + 10; 
            echo '<a href="Accueuil.php?min='.$pagesuivante.'">Suivant</a>'; 
         }
?>
<br><br>
	<h1>Liste des jeux</h1>
      <table id="customers" border="1" align="center">
         <tr>
            <th>
               Nom
            </th>
            <th>
               Prix
            </th>
            <th>
               Description
            </th>
            <th>
               Quantité
            </th>
            <th>
               Catégorie
            </th>
         </tr>
         <?php
         $pdoStat = $pdo->prepare("SELECT * from Etablissement LIMIT $min, 10");

         $executeisOK = $pdoStat->execute();

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
          </tr>
         <?php endforeach; ?>
      </table>

<BR><BR><BR><BR>

</body>