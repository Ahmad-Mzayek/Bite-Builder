<?php
	session_start();
	// if(!$_SESSION["user_id"]) 
	// 	header("Location: ../../landing_page_views/php/landing_page.php");
?> 

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			  content="width=device-width, initial-scale=1.0">
		<title>Bite Builder</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<?php include("../../global_views/php/tailwind.php"); ?>
		<link rel="stylesheet"
			  type="text/css"
			  href="../../global_views/css/theme_switch_button.css">
		<link rel="stylesheet" href="../../global_views/css/theme.css">
	</head>
	<body class="p-0 dark">
		<?php
		include("../../global_views/php/overlay.php");
		include("./dropdown_menu_overlay.php");
		include("./profile_popup.php");
		include("./delete_account_confirmation_popup.php");
		include("./change_password_popup.php");
		include("./preferences_popup.php");
		include("./meal_details_popup.php");
		include("../../global_views/php/loading.php");
		?>

		<div class="flex flex-col items-center justify-between">
			<?php include("./meal_page_header.php"); ?>

			<div class="flex items-center w-full">
				<?php
				include("./meal_page_body.php");
				include("./shopping_list.php");
				?>
			</div>

			<?php include("../../global_views/php/footer.php"); ?>
		</div>

		<?php include("./meal_page_scripts.php"); ?>
	</body>
</html>