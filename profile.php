<?php 
	session_start();
	require "lib/config.php";

	if ($_SESSION['authorized'] == 'admin')
	{
		$btn_admin_panel =
		"<a class='profile__admin_panel luxury' href='21aee27e7ffe2d893ea15a444ff5086f.php'>Панель администратора</a>";
	}
	// -- Функция для загрузки изображения и смены пароля -- //
	profile_upload_user_image();
	profile_change_user_password();
	// -- Переменные для вывода информации о профиле -- //
	$user_email = get_user_email($_SESSION['user_id']);
	$user_image_title = $_SESSION['user_login']."_avatar";
	$user_image_src = get_user_image($_SESSION['user_id']);

	include "lib/messages.php";
?>

<html>
	<head>
		<title>Профиль <?php echo $_SESSION['user_login']; ?></title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php include "block/block_menu.php"; ?>
		<p class="profile__user_login">
			<?php echo $_SESSION['user_first_name'] . " " . $_SESSION['user_last_name']?>
		</p>
		<?php echo !isset($btn_admin_panel) ?'':$btn_admin_panel; ?>
		<form action="#" method="POST" enctype="multipart/form-data">
			<div class="file_upload">
		        <button class="btn_chng_user_image" type="button">
		        	<img 
					class="profile__user_image al-center"
					width="<?php echo IMAGE_RESOLUTION_PROFILE; ?>" 
					height="<?php echo IMAGE_RESOLUTION; ?>" 
					src="<?php echo $user_image_src; ?>" 
					title="<?php echo $user_image_title ?>"
					>
				<input class="input_under_img" type="file" name="user_image">
				</button>       
		    </div>
			<br>
			<input type="submit" value="Загрузить">
		</form>
		<p class="profile__user_email">Почта:<br>
			<?php echo $user_email?>	
		</p>
		<form action="#" method="POST">
			<p>
				<input placeholder="Старый пароль" type="password" name="old_password">
			</p>
			<br>			
			<p>
				<input placeholder="Новый пароль:" type="password" name="new_password">
			</p>
			<br>
			<p>
				<input placeholder="Повторите нов" type="password" name="new_password_2">
			</p>
			<br>
			<p>
				<input type="submit" value="Сменить пароль">
			</p>
		</form>
		<?php include "block/block_footer.php" ?>
	</body>
</html>