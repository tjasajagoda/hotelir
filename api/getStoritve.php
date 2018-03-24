<?php
	require("MySQLDao.php");
	$dao = new MySQLDao();
	$kategorijaId = $_GET['kategorijaId'];
	$data = $dao->getStoritve($kategorijaId);

	echo ($data);

	$dao->closeConnection();
?>