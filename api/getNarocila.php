<?php
	require("MySQLDao.php");
	$dao = new MySQLDao();
	$uporabnikId = $_GET['uporabnikId'];
	$data = $dao->getNarocila($uporabnikId);

	echo ($data);

	$dao->closeConnection();
?>