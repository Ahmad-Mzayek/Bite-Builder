<div id="preferences-popup" class="fixed z-30 hidden p-4 py-3 -translate-x-1/2 -translate-y-1/2 shadow-2xl popup top-1/2 left-1/2 rounded-3xl min-h-[50%] h-[98vh]">
	<form id="preferences-form"
				class="grid overflow-y-auto items-start grid-cols-[1fr_minmax(450px,_2fr)_1fr] text-center w-full">
		<h1>Categories</h1>

		<h1>Filters</h1>

		<h1>Sort By</h1>

		<div id="categories-container">

		</div>

		<div id="filters-container" class="border-x-4">
			<div class="flex space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="checkbox" 
								 name="is_favorites_checked"
								 value="1" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Favorites
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="checked_filters[]" value="is_halal" id="halal" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Halal
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="checked_filters[]" value="is_organic" id="organic" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Organic
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="checkbox"
								 name="checked_filters[]" 
								 value="is_vegan" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Vegan
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="checkbox" 
								 name="checked_filters[]"
								 value="is_vegetarian" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Vegetarian
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="checked_filters[]" value="is_sugar_free" id="sugar-free" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Sugar-Free
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="checked_filters[]" value="is_dairy_free" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Dairy-Free
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="checkbox"
								 name="checked_filters[]"
								 value="is_low_carb" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Low-Carb
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="checkbox"
								 name="checked_filters[]" 
								 value="is_low_calorie" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Low-Calorie
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
							   type="checkbox"
								 name="checked_filters[]" 
								 value="is_low_sodium" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Low-Sodium
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="checked_filters[]" value="is_high_protein" id="high-protein" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						High-Protein
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="checked_filters[]" value="is_keto_friendly" id="keto-friendly" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Keto-Friendly
					</span>
				</label>
			</div>


			<div class="filter-range-container">
					<input type="number" 
								 class="bg-gray-200" 
								 name="min_nb_calories_per_portion" 
								 max="9999"
								 placeholder="Min" >

				<span
					class="ml-3 font-semibold text-l">
					Number of Calories Per Portion
				</span>

					<input type="number" 
								 class="bg-gray-200"
								 name="max_nb_calories_per_portion" 
								 max="9999" 
								 placeholder="Max" >
			</div>

			<div class="filter-range-container">
					<input type="number" 
								 class="bg-gray-200"
								 max="9999"
								 name="min_preparation_duration_minutes"
								 placeholder="Min" >

				<span
					class="ml-3 font-semibold text-l">
					Preparation Duration (Minutes)
				</span>

					<input type="number"
								 class="bg-gray-200" 
								 max="999999"
								 name="max_preparation_duration_minutes" 
								 placeholder="Max" >
			</div>
		</div>

		<div id="sort-and-order-container">
			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="radio" 
								 name="sort_by"
								 value="meal_name"
								 checked />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Name
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer"
					 			 type="radio" 
								 name="sort_by" 
								 value="nb_portions" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Number of Portions
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer"
								 type="radio" 
								 name="sort_by"
								 value="nb_calories_per_portion"  />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Number of Calories Per Portion
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="radio" 
								 name="sort_by"
								 value="preparation_duration_minutes" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Preparation Duration
					</span>
				</label>
			</div>

			<div>
				<h1 class="w-full text-center">
					Order
				</h1>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer"
								 type="radio"
								 name="order" 
								 value="ASC"
								 checked />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Ascending
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" 
								 type="radio"
								 name="order"
								 value="DESC" />

					<span
						class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 transition-colors duration-300 group-hover:text-blue-500">
						Descending
					</span>
				</label>
			</div>
		</div>

		<div class="flex self-center mt-[2rem] items-center justify-between col-start-2">
			<button
				id="close-preferences-popup-button"
				class="px-10 py-4 text-xl font-bold tracking-wide transition-all bg-red-600 hover:bg-red-700 rounded-xl">
				Cancel
			</button>

			<input id="submit-preferences-form-button"
				type="submit"
				name="submit_preferences_form"
				value="Apply">
		</div>
	</form>
</div>