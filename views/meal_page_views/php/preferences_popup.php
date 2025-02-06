<div id="preferences-popup"
	class="popup hidden flex-col w-[90%] items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 shadow-xl rounded-3xl py-6 bg-slate-100 overflow-hidden">
	<form id="preferences-form"
				class="grid relative grid-cols-3 gap-10 items-start text-start place-items-center grid-flow-row w-full">
		<span class="absolute top-[20rem] left-[30%] -translate-x-1/2 -translate-y-1/2 border-2 border-gray-700 h-[33rem]"></span>
		<span class="absolute top-[20rem] right-[30%] -translate-x-1/2 -translate-y-1/2 ml-10 border-2 border-gray-700 h-[33rem]"></span>
		<h1>Categories</h1>

		<h1>Filters</h1>

		<h1>Sort By</h1>

		<div id="categories-container"
			   class="space-y-4">
			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer"
								 type="checkbox"
						     name="meal_categories[]"
						     value="Salads"
						id="salads" />

					<span class="relative flex items-center justify-center w-8 h-8 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-md shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
						<span class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse">

						</span>

						<svg fill="currentColor"
							   viewBox="0 0 20 20"
							   class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
							   xmlns="http://www.w3.org/2000/svg">
							<path clip-rule="evenodd"
										d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
										fill-rule="evenodd">
							</path>
						</svg>
					</span>

					<span class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Salads
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Desserts" id="desserts" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Desserts
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Beverages" id="beverages" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Beverages
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Breakfasts" id="breakfasts" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Breakfasts
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Appetizers" id="appetizers" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Appetizers
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="soups_and_stews" id="soups-and-stews" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Soups & Stews
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Main Courses" id="main-courses" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Main Courses
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Bread & Pastries" id="bread-and-pastries" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Bread & Pastries
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_categories[]" value="Sauces & Condiments" id="sauces-and-condiments" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Sauces & Condiments
					</span>
				</label>
			</div>
		</div>

		<div id="filters-container" class="space-y-4">
			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_halal" id="halal" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Halal
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_organic" id="organic" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Organic
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_sugar_free" id="sugar-free" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Sugar-Free
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_low_sodium" id="low-sodium" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Low-Sodium
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_low_calorie" id="low-calorie" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Low-Calorie
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_high_protein" id="high-protein" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						High-Protein
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_keto_friendly" id="keto-friendly" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Keto-Friendly
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="meal_filters[]" value="is_low_carb" id="low-carb" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Low-Carb
					</span>
				</label>
			</div>



			<div class="filter-range-container">
				<div>
					<input type="number" maxlength="4" class="bg-gray-200" name="min_nb_calories_per_portion" id="min_nb_calories_per_portion" placeholder="Min">
				</div>

				<span
					class="ml-3 text-xl font-bold text-gray-700">
					Number of Calories Per Portion
				</span>

				<div>
					<input type="number" maxlength="4" class="bg-gray-200" name="max_nb_calories_per_portion" id="max_nb_calories_per_portion" placeholder="Max">
				</div>
			</div>

			<div class="filter-range-container">
				<div>
					<input type="number" maxlength="4" class="bg-gray-200" name="min_preparation_duration_minutes" id="min_preparation_duration_minutes" placeholder="Min">
				</div>

				<span
					class="ml-3 text-xl font-bold text-gray-700">
					Preparation Duration (Minutes)
				</span>

				<div>
					<input type="number" maxlength="4" class="bg-gray-200" name="max_preparation_duration_minutes" id="max_preparation_duration_minutes" placeholder="Max">
				</div>
			</div>
		</div>

		<div id="sort-and-order-container">
			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="radio" name="sort_by" value="Name" id="name" checked />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Name
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="radio" name="sort_by" value="Number Of Portions" id="number-of-portions" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Number of Portions
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="radio" name="sort_by" value="Number Of Calories Per Portion" id="number-of-calories-per-portion" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Number of Calories Per Portion
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="radio" name="sort_by" value="Preparation Duration" id="preparation-duration" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
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
					<input class="hidden peer" type="radio" name="order_by" value="Ascending" id="ascending" checked />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Ascending
					</span>
				</label>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="radio" name="order_by" value="Descending" id="descending" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Descending
					</span>
				</label>
			</div>

			<div>
				<h1 class="w-full text-center">
					Favorites
				</h1>
			</div>

			<div class="flex items-center space-x-3">
				<label class="flex items-center cursor-pointer group">
					<input class="hidden peer" type="checkbox" name="is_favorites_selected" value="true" id="is-favorites-selected" />

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
						class="ml-3 font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
						Show Favorite Meals Only
					</span>
				</label>
			</div>
		</div>

		<div class="flex self-center mt-[3rem] items-center justify-between w-7/12 col-start-2">
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