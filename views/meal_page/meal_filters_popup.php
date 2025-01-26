<!-- Sort By:   Name - Number of Portions - Number of Calories Per Portion - Preparation Duration -->
<!-- Sort Options: Ascending - Descending -->
<!-- Filters: Booleans, Checkboxes, same as Database, all checked by default -->
<!-- Filters: Meal Categories, Checkboxes, same as Database (meal_category Table), all checked by default -->
<!-- Give the user the option to view only meals added to favorites -->
<!-- Design to be discussed on campus  -->

<div id="meal-filters-popup"
	class="hidden flex-col w-10/12 min-w-[40rem] items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-xl rounded-3xl pr-24 py-12 bg-amber-400 overflow-hidden">

	<form id="meal-filters-form" class="grid relative grid-cols-3 gap-2 text-center place-items-center grid-flow-row w-full min-h-[35rem]">
		<span class="absolute top-0 left-[35%] border-2 border-white h-[30rem]">
		</span>

		<span class="absolute top-0 right-[35%] border-2 border-white h-[30rem]">
		</span>

		<h1>Categories</h1>

		<h1>Filters</h1>

		<h1>Sort By</h1>

		<div id="categories-container" class="space-y-4">
			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Salads" id="salads" />
					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Salads
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Desserts" id="desserts" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Desserts
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Beverages" id="beverages" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Beverages
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Breakfasts" id="breakfasts" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Breakfasts
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Appetizers" id="appetizers" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Appetizers
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="soups_and_stews" id="soups-and-stews" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Soups & Stews
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Main Courses" id="main-courses" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Main Courses
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Bread & Pastries" id="bread-and-pastries" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Bread & Pastries
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Sauces & Condiments" id="sauces-and-condiments" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Sauces & Condiments
					</span>
				</label>
			</div>
		</div>

		<div class="filter-container space-y-4">
			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_halal" id="halal" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Halal
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_organic" id="organic" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Organic
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_sugar_free" id="sugar-free" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Sugar-Free
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_low_sodium" id="low-sodium" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Low-Sodium
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_low_calorie" id="low-calorie" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Low-Calorie
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_high_protein" id="high-protein" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						High-Protein
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_keto_friendly" id="keto-friendly" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Keto-Friendly
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="group flex items-center cursor-pointer">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_low_carb" id="low-carb" />

					<span
						class="relative w-8 h-8 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span
							class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"></span>

						<svg
							fill="currentColor"
							viewBox="0 0 20 20"
							class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
							xmlns="http://www.w3.org/2000/svg">
							<path
								clip-rule="evenodd"
								d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
								fill-rule="evenodd"></path>
						</svg>
					</span>

					<span
						class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
						Low-Carb
					</span>
				</label>
			</div>

			<div class="filter-range-container flex items-center w-1/4">
				<div>
					<input type="number" maxlength="4" class="decoration" name="min_nb_calories_per_portion" id="min_nb_calories_per_portion" placeholder="Min">
				</div>

				<span
					class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
					Number of Calories Per Portion
				</span>

				<div>
					<input type="number" maxlength="4" name="max_nb_calories_per_portion" id="max_nb_calories_per_portion" placeholder="Max">
				</div>
			</div>

			<div class="filter-range-container flex items-center w-1/4">
				<div>
					<input type="number" maxlength="4" class="decoration" name="min_preparation_duration_minutes" id="min_preparation_duration_minutes" placeholder="Min">
				</div>

				<span
					class="ml-3 text-gray-700 group-hover:text-blue-500 font-medium transition-colors duration-300">
					Preparation Duration (Minutes)
				</span>

				<div>
					<input type="number" maxlength="4" name="max_preparation_duration_minutes" id="max_preparation_duration_minutes" placeholder="Max">
				</div>
			</div>
		</div>

		<div class="filter-container space-y-4">
			<div>
				<div>
					<input type="radio" name="sort_by" value="Name" id="name" checked>
				</div>

				<label for="name">Name</label>
			</div>

			<div>
				<div>
					<input type="radio" name="sort_by" value="Number Of Portions" id="number-of-portions">
				</div>

				<label for="number-of-portions">Number of Portions</label>
			</div>

			<div>
				<div>
					<input type="radio" name="sort_by" value="Number Of Calories Per Portion" id="number-of-calories-per-portion">
				</div>

				<label for="number-of-calories-per-portion">Number of Calories Per Portion</label>
			</div>

			<div>
				<div>
					<input type="radio" name="sort_by" value="Preparation Duration" id="preparation-duration">
				</div>

				<label for="preparation-duration">Preparation Duration</label>
			</div>

			<div>
				<h1 class="w-full text-center">
					Order
				</h1>
			</div>

			<div>
				<div>
					<input type="radio" name="order_by" value="Ascending" id="ascending" checked>
				</div>

				<label for="ascending">Ascending</label>
			</div>

			<div>
				<div>
					<input type="radio" name="order_by" value="Descending" id="descending">
				</div>

				<label for="descending">Descending</label>
			</div>
		</div>

		<div class="w-full col-start-2 flex items-center justify-around">
			<button id="close-filters-popup-button" class="px-6 py-4 text-bold bg-zinc-600 rounded-xl">
				Cancel
			</button>

			<input id="submit-meal-filters-form-button" type="submit" name="submit_filters_form" value="Apply">
		</div>
	</form>
</div>