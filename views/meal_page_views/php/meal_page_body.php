<div id="meal-page-body" class="flex flex-col items-center flex-1 gap-5 pr-4 basis-7/12">
	<div class="flex items-center w-full">               
		<form id="search-input-form" class="relative px-4 basis-10/12">
			<input type="text"
						 id="meal-search-input"
						 name="search_input" 
						 class="rounded-full"
						 placeholder="Search" >

			<?php include("./clear_search_input_icon.php"); ?>			 

			<button type="submit" id="search-button-submit" class="w-8 h-8 absolute inset-0 m-auto mr-10 cursor-pointer">
				<svg id="w-8 h-8 search-icon"
						class="fill-white"
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 512 512" >
					<path class="fill-black" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
				</svg>
			</button>

		</form>
		
		<button id="filter-button" class="relative p-6 ml-auto basis-2/12 rounded-xl opacity-95 hover:opacity-100">
			<svg class="absolute inset-0 m-auto opacity-100 fill-white w-7"
				   xmlns="http://www.w3.org/2000/svg"
					 viewBox="0 0 512 512">
				<path d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
			</svg>
		</button>
	</div>
	
	<div class="flex items-center w-full gap-2">
		<div class="flex self-center pl-2 group">
			<button id="previous-meal-button" class="relative w-12 h-12 transition duration-300 rounded-full">
				<svg class="absolute inset-0 w-10 h-10 m-auto"
					   xmlns="http://www.w3.org/2000/svg"
						 viewBox="0 0 320 512">
					<path width="32"
								d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
				</svg>
			</button>
		</div>

		<div class="flex w-full h-full gap-2">
			<div class="flex justify-center grow shrink-0 max-w-[25vw] h-full self-stretch">
				<?php include("./meal_card.php"); ?>
			</div>
			
			<div class="flex flex-col self-start flex-1 w-full h-full">
				<div class="relative flex items-center justify-between w-full gap-4 px-3 pb-2 bg-gray-600">
					<h3 id="meal-category" class="text-xl text-center">
						
					</h3>

					<div class="flex p-2 space-x-6">
							<button id="add-to-shopping-list-button" class="relative rounded-full w-14 h-14 group disabled:opacity-15 disabled:pointer-events-none">
								<?php include("./add_to_shopping_list_button_icons.php"); ?>
							</button> 
			
							<button id="add-to-favorites-button" class="relative rounded-full w-14 h-14 group disabled:opacity-15 disabled:pointer-events-none">
								<?php include("./add_to_favorites_button_icons.php"); ?>
							</button>
					</div>
				</div>

				<div class="flex justify-between w-full h-full gap-2 pt-1">
					<div class="flex flex-col justify-between h-full gap-2 px-2 pb-0 grow">
						<div class="overflow-y-auto">
							<h1 id="meal-name" class="max-h-[230px]">

							</h1>
						</div>

						<div class="flex items-end grow">
							<button id="open-meal-details-popup-button" class="w-full p-2 text-base font-medium transition rounded-sm md:text-lg lg:text-xl disabled:opacity-10">
								View Details
							</button>
						</div>

					</div>

					<div class="flex flex-col items-center justify-around h-full gap-1 pl-2 border-l-4">
						<button class="flex flex-col items-center justify-center w-full h-24 px-2 cursor-default rounded-xl group">
							<?php include("./number_of_calories_icon.php"); ?>
							
							<span id="total-calories-span">

							</span>
						</button> 
		
						<button class="flex flex-col items-center justify-center w-full h-24 gap-2 px-2 cursor-default rounded-xl group">
							<?php include("./preparation_duration_icon.php"); ?>

							<span id="total-minutes-span">

							</span>
						</button> 
		
						<button class="flex flex-col items-center justify-center w-full h-24 gap-2 px-2 cursor-default rounded-xl group">
							<?php include("./number_of_servings_icon.php"); ?>

							<span id="total-portions-span">

							</span>
						</button> 
					</div>
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