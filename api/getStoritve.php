<?php
	require("MySQLDao.php");
	$dao = new MySQLDao();
	$hotelId = $_GET['hotelId'];
	$data = $dao->getStoritve($hotelId);

	echo ($data);

	$dao->closeConnection();
?>