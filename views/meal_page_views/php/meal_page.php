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
	</head>
	<body class="light">
		<?php
		include("../../global_views/php/overlay.php");
		include("./dropdown_menu_overlay.php");
		include("./meal_filters_popup.php");
		include("../../global_views/php/loading.php");
		?>
		<div class="flex h-screen flex-col items-center justify-between">
			<?php include("./meal_page_header.php"); ?>
			<div class="flex w-screen min-h-[65rem] p-8 items-center">
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