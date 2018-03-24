<?php
	require("MySQLDao.php");
	$dao = new MySQLDao();
		

	$uporabnikId = $_POST['uporabnikId'];
	$casStoritve = $_POST['casStoritve'];
	$seznamStoritev = $_POST['seznamStoritev'];

	$idNarocila = $dao->addNarocilo($uporabnikId, $casStoritve);

	//echo ($idNarocila);
	$dao->addStoritve($idNarocila, $seznamStoritev);


	$dao->closeConnection();
?>
