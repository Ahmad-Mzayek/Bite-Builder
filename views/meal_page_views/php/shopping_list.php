	<div id="shopping-list" class="flex flex-col flex-1 max-h-[80vh] basis-4/12 overflow-y-scroll">
		<div class="p-1 relative">
			<?php include("./clear_shopping_list_icon.php"); ?>

			<h1 class="pb-3 text-center">
				Shopping List
			</h1>
		</div>

		<div id="shopping-list-grid-container" class="grid grid-cols-4 p-0 border-2 place-items-start justify-items-center h-full grow border-white-950 text-nowrap overflow-y-auto">
			<h3>Ingredient Name</h3>

			<h3 class="col-span-2">Ingredient Quantity</h3>

			<h3>Ingredient Unit</h3>
		</div>
	</div>
	
