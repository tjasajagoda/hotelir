<?php
	require("MySQLDao.php");
	$dao = new MySQLDao();
	$hotelId = $_GET['hotelId'];
	$data = $dao->getKategorije($hotelId);

	echo ($data);

	$dao->closeConnection();
?>