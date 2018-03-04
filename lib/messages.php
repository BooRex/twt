<?php
	switch ($msg) 
	{
		case "succ_login":
			header("Refresh: 3; URL=index.php");
			echo "<p class='msg success'>Привет, $user_login!</p>";
			break;
		case "succ_reg":
			header("Refresh: 3; URL=index.php");
			echo "<p class='msg success'>Вы успешно зарегестрированы!</p>";
			break;
		case "succ_pass_change":
			echo "<p class='msg success'>Вы успешно поменяли пароль.</p>";
			break;
		case "succ_image_upl":
			header("Refresh: 1; URL=profile.php");
			echo "<p class='msg success'>Вы успешно загрузили изображение.</p>";
			break;
		case "err_empty_fields":
			echo "<p class='msg error'>Ошибка, не все поля заполнены!</p>";
			break;
		case "err_pass_missmatch":
			echo "<p class='msg error'>Ошибка, пароли не совпадают!</p>";
			break;
		case "err_strlen":
			echo "<p class='msg error'>Ошибка, в поле можно ввести не более 30 символов!</p>";
			break;
		case "err_pass_or_email":
			echo "<p class='msg error'>Ошибка, неверная почта или пароль!</p>";
			break;
		case "err_pass":
			echo "<p class='msg error'>Ошибка, старый пароль не верный!</p>";
			break;
		case "err_pass_is_old":
			echo "<p class='msg error'>Ошибка, старый пароль совпадет с новым!</p>";
			break;
		case "err_login_exists":
			echo "<p class='msg error'>Ошибка, пользователь с таким логином уже существует!</p>";
			break; 
		case "err_email_exists":
			echo "<p class='msg error'>Ошибка, пользователь с такой почтой уже существует!</p>";
			break; 
		case "err_email_uncorrect":
			echo "<p class='msg error'>Ошибка, формат почты неверный!</p>";
			break; 
		case "err_query":
			echo "<p class='msg error'>Ошибка в запросе!</p>";
			break;
		case "err_image_size":
			echo "<p class='msg error'>Ошибка, размер изображения больше ". IMAGE_MAX_SIZE/1000000 ." МБ!</p>";
			break;
		case "err_image_ext":
			echo "<p class='msg error'>Ошибка, файл не является изображением!</p>";
			break;
		case "is_admin":
			header("Refresh: 3; URL=21aee27e7ffe2d893ea15a444ff5086f.php");
			$adm_info_array = get_admin_level($user_id);
			$admin_level = $adm_info_array['admin_level'];
			echo "<p class='msg luxury'>Вы вошли как администратор $admin_level уровня!</p>";
			break;
	}
?>