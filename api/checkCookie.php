<?php

if (!isset($_COOKIE['hash'])) {
	if ("login.php" != substr($_SERVER['REQUEST_URI'], -9)) {
		header("Location: ./login.php"); /* Redirect browser */
		exit();
	}

}

else {
	require("MySQLDao.php");
	$dao = new MySQLDao();
	$uporabnisko_ime = $_COOKIE['hash'];
	$data = $dao->getUporabnik("'" . $uporabnisko_ime . "'");
	$dao->closeConnection();


	if (json_decode($data, true)[0]['uporabnisko_ime'] != $uporabnisko_ime) {
		header("Location: ./login.php"); /* Redirect browser */
		exit();
	}
/*
	else {
		header("Location: ./index.php");
		exit();
	}
*/
	
}





?>