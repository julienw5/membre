<?php

include 'function.inc.php';
include 'database.php';

$view = 'connexion.php';

if($_SESSION['logged_in'] == 'ok'){
        $view = 'membre.view.php';
}

switch ($_GET['page']){


		case 'membre':

			// traitement des modifications

		// la template à utiliser
		$view = 'membre.view.php';

		break;


		case 'delete':
				$user = $_SESSION['user'];
				$query = "  DELETE FROM membre WHERE pseudo = :pseudo";

				//Préparer lecture
				$preparedStatement = $db->prepare($query);
				$preparedStatement->execute(array(':pseudo' => $user));

				$_SESSION['logged_in'] != 'ok';
				header('location: index.php');
		break;

		case 'deco':
				//delete session
				session_destroy();
				//delete $ session
				unset($_SESSION);
				//redirection
				header("Location: index.php");
		break;

		case 'connexion':
		default:
		require 'connect.app.php';
		break;
}

include 'header.view.php';

include $view;

include 'footer.view.php';