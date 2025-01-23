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
	<?php
	include("../global/overlay.php");
    include("meal_page_header.php");
	?>
	<div> <!-- Add CSS: LinearLayout with 2 columns, orientation: horizontal  -->
		<?php
		include("meal_page_body.php");	// CSS: layout_weight = 3.
		include("shopping_list.php");	// CSS: layout_weight = 1.
		?>
	</div>
	<?php
    include("../global/footer.php");
    ?>
	<script src="meal_page.js"></script>
</body>
</html>