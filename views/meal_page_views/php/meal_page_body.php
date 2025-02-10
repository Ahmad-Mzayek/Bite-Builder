<div class="flex flex-col items-center gap-5 flex-1 p-4 basis-3/4">
	<div class="flex items-center w-full">
		<div class="relative p-6 basis-3/4">
			<input type="text"
						 name="search_input"
				     id="search_input">
			<svg id="search-button"
					 class="absolute inset-0 m-auto mr-10 cursor-pointer"
				   width="32"
				   height="32"
				   xmlns="http://www.w3.org/2000/svg"
				   viewBox="0 0 512 512">
				<path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
			</svg>
		</div>
		
		<button id="filter-button" class="relative p-6 basis-1/4 rounded-xl opacity-95 hover:opacity-100 bg-slate-800">
			<svg class="absolute inset-0 m-auto opacity-100 fill-white"
				   xmlns="http://www.w3.org/2000/svg"
					 width="32"
					 height="32"
					 viewBox="0 0 512 512">
				<path d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
			</svg>
		</button>
	</div>
	
	<div class="flex items-start gap-4 min-h-fit">
		<div class="flex items-center basis-3/4">
			<div class="flex items-center justify-center basis-2/12 group">
				<button id="previous-meal-button" class="relative w-16 h-16 p-10 transition duration-300 rounded-full group-hover:bg-gray-200">
					<svg class="absolute inset-0 w-10 h-10 m-auto"
							 xmlns="http://www.w3.org/2000/svg"
						   viewBox="0 0 320 512">
						<path width="32"
									d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
					</svg>
				</button>
			</div>

			<div class="flex flex-1 items-center justify-center min-w-[25rem]">
				<?php include("./meal_card.php"); ?>
			</div>
		</div>
		
		<div class="flex flex-col items-center justify-between basis-1/4">
			<div class="flex items-center p-4 space-x-6">
				<button id="add-to-shopping-list-button" class="relative p-6 rounded-full bg-slate-800 group">
					<svg class="w-10 h-10 opacity-100 fill-white group-hover:-translate-y-2"
							 xmlns="http://www.w3.org/2000/svg"
						   viewBox="0 0 448 512">
						<path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
					</svg>
				</button> 

				<button id="add-to-favorites-button" class="relative p-6 rounded-full bg-slate-800 group">
					<?php include("./add_to_favorites_button_icons.php"); ?>
				</button>
			</div>
			
			<div class="p-2">
				<h3 id="summarized-meal-description" class="text-lg max-h-[30rem] font-medium overflow-y-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, accusantium quia aperiam voluptatum dolorum non id aspernatur quaerat harum maxime, laborum tempora exercitationem similique beatae incidunt, itaque labore. Sunt ipsam doloribus temporibus doloremque numquam nesciunt ullam quidem non quos? Aliquam quae delectus iure at est ipsam neque, praesentium, sint a dolores culpa exercitationem nihil recusandae repellat tenetur voluptatem, alias accusantium eius quis voluptatum. Fugiat error reprehenderit, nulla non eos fugit at iure sapiente accusantium quasi molestiae vitae. In perferendis a sit illum culpa, tenetur sapiente ipsam consectetur facere.
				</h3>
			</div>
		</div>

		<div class="flex items-center justify-center group self-center">
				<button id="next-meal-button" class="relative w-16 h-16 p-6 transition duration-300 rounded-full group-hover:bg-gray-200">
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
			(1 / 30)
		</span>
	</div>
</div>