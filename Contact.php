<head>
    <title>Contact</title>
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
		</div>
	</header>
Contacter Hypnos :

<form method="post" action="AccueilClient.php">
    <fieldset>
    <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="" /> <br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="" /> <br>
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" value="" /> <br>
        <label for="tel">Téléphone :</label>
        <input type="text" id="tel" name="tel" value="" /> <br>
        <input type="submit" name='contact' value="contact">
    </fieldset>
</form>
