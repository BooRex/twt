<?php
	session_start();
	require "lib/config.php";

	if (isset($_REQUEST['user_email']) && isset($_REQUEST['user_password']))
	{
		if (!empty($_REQUEST['user_email']) && !empty($_REQUEST['user_password']))
		{
			$user_email = $_REQUEST['user_email'];
			$user_password = $_REQUEST['user_password'];

			$user_id = get_user_id($user_email);
			if (md5($user_password) == get_user_password($user_id))
			{
				$msg = "succ_login";
				success_auth($user_email);
			}
			else
			{
				$msg = "err_pass_or_email";
			}	
		}
		else
		{
			$msg = "err_empty_fields";
		}
	}
	include "lib/messages.php";
?>
<html>
	<head>
		<title>Вход на сайт</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php include "block/block_menu.php"; ?>
		<form action="login.php" method="POST">
			<div class="form__content">
				<p>
					<input placeholder="Почта" type="text" name="user_email">
				</p>
				<br>
				<p>
					<input placeholder="Пароль" type="password" name="user_password">
				</p>
				<br>
				<p>
					<input type="submit" value="Войти">
				</p>
				<br>
				<p>
					<a class="btn_back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Назад</a>
				</p>
			</div>
		</form>
	</body>
</html>