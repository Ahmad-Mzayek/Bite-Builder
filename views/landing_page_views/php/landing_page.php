<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<meta name="viewport"
		content="width=device-width, initial-scale=1.0">

	<title>Bite Builder | Landing</title>

	<script src="https://cdn.tailwindcss.com"></script>

	<?php include("../../global_views/php/tailwind.php"); ?>

	<link rel="shortcut icon" 
					type="image/x-icon"
					href="../../../resources/images/bite_builder_favicon.png">

	<link rel="stylesheet"
				type="text/css"
				href="../../global_views/css/theme_switch_button.css">
				
		<link rel="stylesheet" href="../../global_views/css/theme.css">
</head>

<body class="dark grid grid-rows-[auto_1fr_auto]">
	<?php
	include("../../global_views/php/cursor.php");
	include("../../global_views/php/overlay.php");
	include("./login_popup.php");
	include("./signup_popup.php");
	include("./reset_password_popup.php");
	include("../../global_views/php/loading.php");
	?>

	<?php
		include("./landing_page_header.php");
	?>

	<?php
		include("./landing_page_body.php");
	?>

	<?php 
		include("../../global_views/php/footer.php"); 
	?>
	
	<?php include("./landing_page_scripts.php"); ?>
</body>

</html>