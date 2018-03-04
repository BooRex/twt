<?php
	define(DB_NAME, "supersite");
	define(DB_HOST, "localhost");
	define(DB_USER, "root");
	define(DB_PASS, "");

	$db_connect_link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (!$db_connect_link)
	{
		echo "БД не подключена!";
	}
?>