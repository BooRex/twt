<?php 
	session_start();

?>
<div class="menu">
	<div class="menu__links">
		<a class="menu__links-item" href="index.php">Главная</a>
		<a class='menu__links-item' href='catalogue.php'>Каталог</a>
		<?php if (isset($_SESSION['authorized'])) 
		{
			switch ($_SESSION['authorized']) 
			{
				case "user":
					echo 
					"
					<a class='menu__links-item' href='mytours.php'>Мои туры</a>
					";
					break;
				case "manager":
					echo 
					"
					<a class='menu__links-item' href='orders.php'>Заказы</a>
					<a class='menu__links-item' href='tour_change.php'>Изменить тур</a>
					";
					break;
				case "admin":
					echo 
					"
					<a class='menu__links-item' href='orders.php'>Заказы</a>
					<a class='menu__links-item' href='tour_add.php'>Добавить тур</a>
					<a class='menu__links-item' href='tour_change.php'>Изменить тур</a>
					<a class='menu__links-item' href='users.php'>Пользователи</a>
					";
					break;	
			}
			echo 
			"
			<span class='menu__auth'>
				<a class='link_user_profile' href='profile.php'>
					<img 
						class='menu__user_image' 
						width='" . IMAGE_RESOLUTION_MENU . "' 
						height='" . IMAGE_RESOLUTION_MENU . "' 
						src='" . get_user_image($_SESSION['user_id']) . "'
					>
				</a>
				<a class='menu__links-item menu__link_exit' href='exit.php'>Выйти</a>
			</span>
			";
		}
		else
		{
			echo 
			"
			<span class='menu__auth'>
				<a class='menu__links-item' href='login.php'>Войти</a>
				<a class='menu__links-item' href='register.php'>Зарегистрироваться</a>
			</span>
			";
		}

		?>
	</div>
</div>