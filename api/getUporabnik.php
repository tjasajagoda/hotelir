<?php
	require("MySQLDao.php");
	$dao = new MySQLDao();
	$uporabnikId = $_GET['uporabnisko_ime'];
	$data = $dao->getUporabnik($uporabnisko_ime);

	echo ($data);

	$dao->closeConnection();
?>