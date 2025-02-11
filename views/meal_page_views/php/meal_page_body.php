<div id="meal-page-body" class="flex flex-col items-center gap-5 pr-2 basis-9/12">
	<div class="flex items-center w-full">               
		<div class="relative p-6 basis-8/12">
			<input type="text" name="search_input">

			<svg id="search-icon"
					 class="absolute inset-0 m-auto mr-10 cursor-pointer"
				   width="32"
				   height="32"
				   xmlns="http://www.w3.org/2000/svg"
				   viewBox="0 0 512 512">
				<path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
			</svg>
		</div>
		
		<button id="filter-button" class="relative p-6 basis-4/12 rounded-xl opacity-95 hover:opacity-100">
			<svg class="absolute inset-0 m-auto opacity-100 fill-white"
				   xmlns="http://www.w3.org/2000/svg"
					 width="32"
					 height="32"
					 viewBox="0 0 512 512">
				<path d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
			</svg>
		</button>
	</div>
	
	<div class="flex items-center gap-3">
		<div class="flex self-center group pl-2">
			<button id="previous-meal-button" class="relative w-12 h-12 duration-300 rounded-full transition">
				<svg class="absolute inset-0 w-10 h-10 m-auto"
							xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 320 512">
					<path width="32"
								d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
				</svg>
			</button>
		</div>

		<div class="flex items-center justify-center basis-6/12 min-w-[20rem] pr-2 border-r-8">
			<?php include("./meal_card.php"); ?>
		</div>
		
		<div class="flex flex-col items-center self-start gap-6 basis-5/12 grow">
			<div class="flex items-center justify-between gap-4 w-full">
				<h2 id="meal-name" class="text-center">
					Meal Name Goes Here
				</h2>

				<div class="flex space-x-6">
						<button id="add-to-shopping-list-button" class="relative p-6 rounded-full group">
							<?php include("./add_to_shopping_list_button_icons.php"); ?>
						</button> 
		
						<button id="add-to-favorites-button" class="relative p-6 rounded-full group">
							<?php include("./add_to_favorites_button_icons.php"); ?>
						</button>
				</div>
			</div>

			<div class="flex h-[35rem] gap-5">
				<div class="flex flex-col justify-between gap-2 h-full p-2">
					<h3 id="meal-description" class="overflow-y-auto text-lg font-medium">

					</h3>
					
					<button class="p-4 text-base font-medium text-white transition bg-green-500 rounded-sm md:text-lg lg:text-xl">
						View Details
					</button>
				</div>

				<div class="flex flex-col items-center justify-around">
					<button class="flex flex-col items-center justify-center w-full h-24 px-2 rounded-xl group cursor-default">
						<?php include("./number_of_calories_icon.php"); ?>
						
						<span id="total-calories-span">

						</span>
					</button> 
	
					<button class="flex flex-col items-center justify-center w-full h-24 gap-2 px-2 rounded-xl group cursor-default">
						<?php include("./preparation_duration_icon.php"); ?>

						<span id="total-minutes-span">

						</span>
					</button> 
	
					<button class="flex flex-col items-center justify-center w-full h-24 gap-2 px-2 rounded-xl group cursor-default">
						<?php include("./number_of_servings_icon.php"); ?>

						<span id="total-portions-span">

						</span>
					</button> 
				</div>
			</div>
		</div>

		<div class="flex items-center self-center justify-center group">
				<button id="next-meal-button" class="relative w-12 h-12 p-2 transition duration-300 rounded-full">
					<svg class="absolute inset-0 w-10 h-10 m-auto"
							xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 320 512">
						<path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
					</svg>
				</button>
		</div>
	</div>

	<div id="total-nb-meals-container" class="flex items-center justify-center w-full text-2xl font-bold">
		<span id="total-meals-span">
			
		</span>
	</div>
</div>