<?php
	switch ($msg) 
	{
		case "succ_login":
			header("Refresh: 3; URL=index.php");
			echo "<p class='msg success'>Привет $user_login! <a href='index.php'>Перейти на главную.</a></p>";
			break;
		case "succ_reg":
			echo "<p class='msg success'>Вы успешно зарегестрированы! <a href='index.php'>Перейти на главную.</a></p>";
			break;
		case "is_admin":
			header("Refresh: 3; URL=21aee27e7ffe2d893ea15a444ff5086f.php");
			echo "adm";
			break;
	}
?>