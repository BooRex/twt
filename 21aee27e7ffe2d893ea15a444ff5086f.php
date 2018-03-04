<?php 
	session_start();
	require "lib/config.php";
	
	if ($_SESSION['authorized'] != "admin")
	{
		header("Location: index.php");
	}

?>
<p>Вы на странице администратора!</p>