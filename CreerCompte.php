<head>
    <title>Créer un compte</title>
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
Créer un compte :

<form method="post" action="Inscription.php">
    <fieldset>
    <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="" /> <br>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="" /> <br>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" value="" /> <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" value="" /> <br>
        <label for="validerpassword">Confirmer votre mot de passe :</label>
        <input type="password" id="mdp2" name="mdp2" value="" /> <br>
        <input type="submit" name='inscription' value="Inscription">
    </fieldset>
</form>
