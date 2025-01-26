<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0">
	<title>Bite Builder</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<?php include("../global/tailwind.php"); ?>
	<link rel="stylesheet"
		type="text/css"
		href="../global/theme_switch_button.css">
</head>

<body class="light">
	<?php // Overlay.
	include("../global/overlay.php");
	?>

	<?php // Hidden Popups.
	include("./meal_filters_popup.php");
	?>
	<div class="flex h-screen flex-col items-center justify-between">
		<?php // Header.
		include("meal_page_header.php");
		?>
		<div class="flex w-full p-8 items-center"> <!-- Add CSS: LinearLayout with 2 columns, orientation: horizontal  -->
			<?php // Body.
			include("meal_page_body.php");
			include("shopping_list.php");
			?>
		</div>
		<?php // Footer.
		include("../global/footer.php");
		?>
	</div>
	<script src="meal_page.js"></script>
</body>

</html>