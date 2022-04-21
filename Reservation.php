<?php
session_start();
?>

<head>
    <title>Faire une réservation</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
<body>


<?php

try {
   $pdo = new PDO('mysql:host=localhost;dbname=Projet', 'root', 'root');
 } 
 
 catch (PDOException $e) {
   echo 'Impossible de se connecter à la base de données';
   
 }

$Hotel = $_GET['ID'];
?>

<form method="post" action="ConfirmerReservation.php">

  <fieldset>
    <label for="date">Date : </label>
      <input type="date" id="date" name="date" value="" /><br>
      <input type="hidden" id="hotel" name="hotel" value=<?php\''.$Hotel.'\''?> /><br>
    </fieldset>
  <button type="submit">Valider</button>
</form>
</body>