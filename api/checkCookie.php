<?php
$cookie_name = "novak_janez";
$cookie_value = md5($cookie_name . "novak");


    if(!isset($_COOKIE[$cookie_name])) {
    	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    	header("Location: ./index.html"); /* Redirect browser */
      exit();
	} 



?>