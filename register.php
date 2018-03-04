<?php 
	session_start();
	require "lib/config.php";

	if (isset($_REQUEST['user_first_name']) && isset($_REQUEST['user_last_name']) && isset($_REQUEST['user_email']) && isset($_REQUEST['user_password']))
	{
		if (!empty($_REQUEST['user_first_name']) && !empty($_REQUEST['user_last_name'])  && !empty($_REQUEST['user_email']) && !empty($_REQUEST['user_password']))
		{
			$user_first_name = htmlentities(mysqli_real_escape_string($db_connect_link,$_REQUEST['user_first_name']));
			$user_last_name = htmlentities(mysqli_real_escape_string($db_connect_link,$_REQUEST['user_last_name']));
			$user_email = htmlentities(mysqli_real_escape_string($db_connect_link,$_REQUEST['user_email']));
			$user_password = md5(htmlentities(mysqli_real_escape_string($db_connect_link,$_REQUEST['user_password'])));
			$user_image = addslashes(PATH_TO_DEF_USR_IMAGE);

			if (strlen($user_first_name) < 31 && strlen($user_last_name) < 31 && strlen($user_email) < 31)
			{
				if (!isset_email($user_email))
				{
					$pattern_email = '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u';

					if (preg_match($pattern_email, $user_email))
					{
						$query = "INSERT INTO user(user_first_name, user_last_name, user_email, user_password, user_image, user_reg_date) VALUES ('$user_first_name', '$user_last_name','$user_email','$user_password','$user_image',NOW())";
						$exec_query = mysqli_query($db_connect_link, $query);
						if (!$exec_query)
						{
							$msg = "err_query";
						}
						else
						{
							$msg = "succ_reg";
							success_auth($user_email);
						}
					}
					else
					{
						$msg = "err_email_uncorrect";
					}
				}
				else
				{
					$msg = "err_email_exists";
				}
			}	
			else
			{
				$msg = "err_strlen";
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
		<title>Регистрация</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php include "block/block_menu.php"; ?>
		<div class="content">
			<form action="register.php" method="POST">
				<p>
					<input placeholder="Имя" type="text" name="user_first_name">
				</p>
				<br>
				<p>
					<input placeholder="Фамилия" type="text" name="user_last_name">
				</p>
				<br>
				<p>
					<input placeholder="Почта" type="text" name="user_email">
				</p>
				<br>
				<p>
					<input placeholder="Пароль" type="password" name="user_password">
				</p>
				<br>
				<p>
					<input type="submit" value="Зарегистрироваться">
				</p>
				<br>
				<p>
					<a class="btn_back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Назад</a>
				</p>
			</form>
		</div>
	</body>
</html>
	</body>
</html>