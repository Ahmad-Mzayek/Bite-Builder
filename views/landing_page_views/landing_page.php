<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			  content="width=device-width, initial-scale=1.0">
		<title>Bite Builder | Landing</title>
		<script src="https://cdn.tailwindcss.com"></script>
		<?php include("../global_views/tailwind.php"); ?>
		<link rel="stylesheet"
			  type="text/css"
			  href="../global_views/theme_switch_button.css">
	</head>
	<body class="dark">
		<?php // Hidden Popups.
		include("../global_views/overlay.php");
		include("login_popup.php");
		include("signup_popup.php");
		include("../global_views/reset_password_popup.php");
		?>
		<div class="flex h-screen flex-col items-center justify-between">
			<?php // Body.
			include("landing_page_header.php");
			include("landing_page_body.php");
			include("../global_views/footer.php");
			?>
		</div>
		<script src="landing_page.js"></script>
	</body>
</html>