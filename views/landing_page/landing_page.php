<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, initial-scale=1.0">
	<title>Bite Builder | Landing</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<?php include("../global/tailwind.php"); ?>
	<link rel="stylesheet"
		  type="text/css"
		  href="../global/theme_switch_button.css">
</head>
<body class="light">
	<?php // Hidden Popups.
	include("../global/overlay.php");
	include("login_popup.php");
	include("signup_popup.php");
	include("forgot_password_popup.php");
	?>
	<div class="flex h-screen flex-col items-center justify-between">
		<?php // Body.
		include("landing_page_header.php");
		include("landing_page_body.php");
		include("../global/footer.php");
		?>
	</div>
	<script defer src="landing_page.js"></script>
</body>
</html>