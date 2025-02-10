<header class="fixed flex items-center justify-between w-screen px-8 z-[5] top-0">
	<div class="flex items-center justify-center w-[7rem]">
		<img id="logo-image" class="w-full h-full object-cover" src="../../../resources/images/logo_dark.png" alt="Logo">
	</div>

	<div class="flex flex-wrap items-center space-x-12 md:flex-nowrap lg:basis-2/12">
		<button id="login-signup-button"
                class="p-6 font-semibold transition rounded-3xl hover:scale-95">
			Log In / Sign Up
		</button>

		<?php include("../../global_views/php/theme_switch_button.php"); ?>
	</div>
</header>