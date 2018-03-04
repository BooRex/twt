<?php 
	// -- ISSET func's
	function isset_email($user_email)
	{
		global $db_connect_link;

		$query = "SELECT COUNT(user_id) AS count FROM user WHERE user_email = '$user_email'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		if ($query_array['count'] != 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	// -- GET func's
	function get_admin_level($user_id)
	{
		global $db_connect_link;

		$query = 
		"
		SELECT a.admin_level as admin_level, ald.level_title as level_title
		FROM admin a
		JOIN admin_level_description ald ON ald.admin_level = a.admin_level
		WHERE user_id = '$user_id'
		";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		return $query_array; 
	}
	function get_admin_array()
	{
		global $db_connect_link;

		$query = "SELECT admin_id, user_id, admin_level FROM admin";
		$exec_query = mysqli_query($db_connect_link, $query);

		$i = 1;
		while ($row = mysqli_fetch_assoc($exec_query)) 
		{
			$admin_array[$i] = array(
				'admin_id' => $row['admin_id'],
				'user_id' => $row['user_id'],
				'admin_level' => $row['admin_level']
			);
			$i++;
		}
		return $admin_array;
	}
	function get_user_id($user_email)
	{
		global $db_connect_link;

		$query = "SELECT user_id FROM user WHERE user_email = '$user_email'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		return $query_array['user_id'];
	}
	function get_user_first_name($user_id)
	{
		global $db_connect_link;

		$query = "SELECT user_first_name FROM user WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		return $query_array['user_first_name'];
	}
	function get_user_last_name($user_id)
	{
		global $db_connect_link;

		$query = "SELECT user_last_name FROM user WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		return $query_array['user_last_name'];
	}
	function get_user_email($user_id)
	{
		global $db_connect_link;

		$query = "SELECT user_email FROM user WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		return $query_array['user_email'];
	}
	function get_user_password($user_id)
	{
		global $db_connect_link;

		$query = "SELECT user_password FROM user WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		return $query_array['user_password'];
	}
	function get_user_image($user_id)
	{
		global $db_connect_link;

		$query = "SELECT user_image FROM user WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		return $query_array['user_image'];
	}
	// -- UPD func's
	function upd_user_password($user_id, $new_password)
	{
		global $db_connect_link;

		$query = "UPDATE user SET user_password = '$new_password' WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);
		return true;
	}
	function upd_user_image($user_id, $new_image_path)
	{
		global $db_connect_link;
		
		// Удаляем старую перед загрузкой новой
		$old_user_image_path = get_user_image($user_id);
		if ($old_user_image_path != PATH_TO_DEF_USR_IMAGE)
		{
			unlink($old_user_image_path);
		}

		$query = "UPDATE user SET user_image = '$new_image_path' WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);
		return true;
	}
	// is_ func's
	function is_admin($user_id)
	{
		global $db_connect_link;

		$query = "SELECT COUNT(admin_id) as count FROM admin WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);

		$query_array = mysqli_fetch_assoc($exec_query);
		if ($query_array['count'] != 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	// -- Profile func's
	function profile_upload_user_image()
	{
		if (is_uploaded_file($_FILES['user_image']['tmp_name']))
		{
			$upl_image_name = $_FILES['user_image']['name'];
			$upl_image_extention = substr($upl_image_name, strrpos($upl_image_name, '.') + 1);
			$upl_image_size = $_FILES['user_image']['size'];
			if (preg_match("#(png|jpg|gif)#", $upl_image_extention))
			{
				if ($upl_image_size < IMAGE_MAX_SIZE)
				{
					$upl_images_dir = "files\\user_images\\";
					$upl_path = $upl_images_dir . md5($_SESSION['user_email'].time()) . ".$upl_image_extention";

					if (move_uploaded_file($_FILES['user_image']['tmp_name'], $upl_path)) 
					{
					    $msg = "succ_image_upl";
					    upd_user_image($_SESSION['user_id'], addslashes($upl_path));
					}
				}
				else
				{
					$msg = "err_image_size";
				}
			}
			else
			{
				$msg = "err_image_ext";
			}	
		}
	}
	
	function profile_change_user_password()
	{
		if (isset($_REQUEST['old_password']) && isset($_REQUEST['new_password']) && isset($_REQUEST['new_password_2']))
		{
			if (!empty($_REQUEST['old_password']) && !empty($_REQUEST['new_password']) && !empty($_REQUEST['new_password_2']))
			{
				$old_password = htmlentities(mysqli_real_escape_string($db_connect_link,$_REQUEST['old_password']));
				$new_password = htmlentities(mysqli_real_escape_string($db_connect_link,$_REQUEST['new_password']));
				$new_password_2 = htmlentities(mysqli_real_escape_string($db_connect_link,$_REQUEST['new_password_2']));

				if (md5($old_password) == get_user_password($_SESSION['user_id']))
				{
					if ($new_password === $new_password_2)
					{
						if ($old_password != $new_password)
						{
							$msg = "succ_pass_change";
							upd_user_password($_SESSION['user_id'], md5($new_password));
						}
						else
						{
							$msg = "err_pass_is_old";
						}
					}
					else
					{
						$msg = "err_pass_missmatch";
					}
				}
				else
				{
					$msg = "err_pass";
				}
			}
			else
			{
				$msg = "err_empty_fields";
			}
		}
	}
	// -- OTHER func's
	function success_auth($user_email)
	{
		global $_SESSION;
		global $msg;

		$_SESSION['authorized'] = "user";
		$_SESSION['user_email'] = $user_email;
		$_SESSION['user_id'] = get_user_id($user_email);
		$_SESSION['user_first_name'] = get_user_first_name($_SESSION['user_id']);
		$_SESSION['user_last_name'] = get_user_last_name($_SESSION['user_id']);

		add_lastseen_date($_SESSION['user_id']);
		if (is_admin($_SESSION['user_id']))
		{
			$_SESSION['authorized'] = "admin";
			$msg = "is_admin";
		}
		return true;
	}
	function add_lastseen_date($user_id)
	{
		global $db_connect_link;

		$query = "UPDATE user SET user_lastseen_date = NOW() WHERE user_id = '$user_id'";
		$exec_query = mysqli_query($db_connect_link, $query);
		return true;
	}
?>