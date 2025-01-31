<div class="flex flex-col items-center justify-between flex-1 basis-3/4 p-4">
	<div class="flex items-center w-full">
		<div class="flex-1 basis-3/4 relative p-6">
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
		<button id="filter-button"
			class="flex-1 basis-1/4 relative p-6 rounded-xl opacity-95 hover:opacity-100 bg-slate-800">
			<svg class="absolute inset-0 m-auto fill-white opacity-100"
				xmlns="http://www.w3.org/2000/svg"
				width="32"
				height="32"
				viewBox="0 0 512 512">
				<path d="M3.9 54.9C10.5 40.9 24.5 32 40 32l432 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9 320 448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
			</svg>
		</button>
	</div>
	<div class="flex items-center justify-between h-[50rem] p-2">
		<div class="flex items-center flex-1 h-full basis-3/4">
			<div class="flex items-center justify-center basis-1/12 group">
				<button id="previous-meal-button"
					class="relative p-6 w-16 h-16 rounded-full transition duration-300 group-hover:bg-gray-200">
					<svg class="absolute inset-0 m-auto w-10 h-10"
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 320 512">
						<path width="32"
							d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
					</svg>
				</button>
			</div>

			<div class="flex flex-1 items-center justify-center w-full h-full basis-10/12">
				<?php include("./meal_card.php"); ?>
			</div>

			<div class=" flex items-center justify-center basis-1/12 group">
				<button id="next-meal-button"
					class="relative p-6 w-16 h-16 rounded-full transition duration-300 group-hover:bg-gray-200">
					<svg class="absolute inset-0 m-auto w-10 h-10"
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 320 512">
						<path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
					</svg>
				</button>
			</div>
		</div>
		<div class="flex flex-1 flex-col items-center basis-1/4 h-full shrink-0">
			<div class="flex items-center justify-end w-full space-x-6 p-4">
				<button id="add-to-shopping-list-button"
					class="relative p-6 rounded-full bg-slate-800 group">
					<svg class="fill-white opacity-100 w-10 h-10 group-hover:-translate-y-2"
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 448 512">
						<path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
					</svg>
				</button>
				<button id="add-to-favorites-button"
					class="relative p-6 rounded-full bg-slate-800 group">
					<svg class="fill-white opacity-100 w-10 h-10 group-hover:-translate-y-2"
						xmlns="http://www.w3.org/2000/svg"
						fill="#333333"
						viewBox="0 0 576 512">
						<path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z" />
					</svg>
				</button>
			</div>
			<div class="flex items-center justify-center h-full p-2 overflow-scroll">
				<h3 id="summarized-meal-description" class="font-medium text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil, accusantium quia aperiam voluptatum dolorum non id aspernatur quaerat harum maxime, laborum tempora exercitationem similique beatae incidunt, itaque labore. Sunt ipsam doloribus temporibus doloremque numquam nesciunt ullam quidem non quos? Aliquam quae delectus iure at est ipsam neque, praesentium, sint a dolores culpa exercitationem nihil recusandae repellat tenetur voluptatem, alias accusantium eius quis voluptatum. Fugiat error reprehenderit, nulla non eos fugit at iure sapiente accusantium quasi molestiae vitae. In perferendis a sit illum culpa, tenetur sapiente ipsam consectetur facere.</h3>
			</div>

		</div>
	</div>

	<div id="total-nb-meals-container" class="flex items-center justify-center w-full text-2xl font-bold">
		<span id="total-meals-span">
			(1 / 30)
		</span>
	</div>
</div>