<header class="fixed flex items-center justify-between w-screen px-8 z-[5] top-0 h-20">
	<div class="flex items-center justify-center h-full">
		<img id="logo-image" class="object-cover w-full h-full" src="../../../resources/images/logo_dark.png" alt="Logo">
	</div>

	<div class="flex flex-wrap items-center space-x-12 md:flex-nowrap ">
		<button id="login-signup-button"
                class="p-3 px-6 font-semibold transition rounded-3xl hover:scale-95">
			Log In / Sign Up
		</button>

		<?php include("../../global_views/php/theme_switch_button.php"); ?>
	</div>
</header>