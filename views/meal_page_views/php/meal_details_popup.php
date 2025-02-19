<div id="meal-details-popup"
     class="popup hidden flex-col items-center max-h-[98vh] gap-4 fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-2xl rounded-xl p-6 py-6 overflow-x-hidden overflow-y-auto">
		<h1 class="font-bold">
				Meal Details
		</h1>
	
    <?php include("../../global_views/php/close_popup_svg.php") ?>

		<div id="meal-details-popup-image-container" class="flex items-center justify-center w-3/4">
				<img id="meal-details-image"
						 src="../../../resources/images/default_meal_image.png"
						 class="object-cover"
					   alt="Meal Image">
		</div>

		<h1 id="meal-details-popup-meal-name" class="text-center font-bold">
				Meal Name Goes Here
		</h1>

		<p id="meal-description" class="text-lg w-full">

		</p>

		<h1>
			Meal Ingredients
		</h1>

		<div id="meal-ingredients-list-container" class="flex flex-col items-start w-full gap-2">

		</div>
</div>