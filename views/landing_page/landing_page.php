<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, initial-scale=1.0">
	<title>Bite Builder | Landing</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<?php include("../styles.php"); ?>
</head>
<body class="light">
	<?php // Hidden Popups.
	include("../overlay.php");
	include("login_popup.php");
	include("signup_popup.php");
	include("forgot_password_popup.php");
	?>
	<div class="flex h-screen flex-col items-center justify-between">
		<?php // Body.
		include("header.php");
		include("body.php");
		include("../footer.php");
		?>
	</div>
	<script src="landing_page.js"></script>
</body>
</html>