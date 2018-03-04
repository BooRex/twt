<?php 
	session_start();
	require "lib/config.php";

	//echo "<pre>"; print_r($_SESSION); echo "</pre>"; //for debug
?>

<html>
	<head>
		<title>Super Site</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">	

		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php include "block/block_menu.php"; ?>

		<div class="content">
			<p>Добро пожаловать на сайт!</p>	
		</div>
		
		<?php include "block/block_footer.php"; ?>
	</body>
</html>