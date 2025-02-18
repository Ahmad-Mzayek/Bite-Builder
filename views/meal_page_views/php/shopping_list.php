	<div id="shopping-list" class="flex flex-col flex-1 max-h-[65vh] lg:w-3/4 basis-4/12 overflow-y-scroll">
		<div class="p-1 relative">
			<h1 class="pb-3 text-center">
				Shopping List
			</h1>

			<?php include("./clear_shopping_list_icon.php"); ?>
		</div>

		<div id="shopping-list-grid-container" class="grid grid-cols-4 p-0 place-items-start justify-items-center grow text-nowrap">
			<h3>Ingredient Name</h3>

			<h3 class="col-span-2">Ingredient Quantity</h3>

			<h3>Ingredient Unit</h3>
		</div>
	</div>
	
