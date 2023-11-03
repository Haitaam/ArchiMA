<meta charste="UTF-8">
<?php
	require("../connexion.php");
	extract($_POST);
	$r = "insert INTO message (id_message, sujet, message, date_creation_message, id_utilisateur, id_destinataire) VALUES ('".$id_message."','".$sujet."','".$message."', CURDATE(),'".$id_utilisateur."','".$id_destinataire."')";
	//Exécution de la requête d'action
	mysqli_query($con, $r);
	mysqli_close($con);
	
	require("../fonctions.php");
	redirection("index.php");
?>