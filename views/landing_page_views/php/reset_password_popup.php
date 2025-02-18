<div id="forgot-password-popup" class="fixed z-50 flex-col items-center justify-between hidden p-6 -translate-x-1/2 -translate-y-1/2 rounded-lg shadow-xl popup top-1/2 left-1/2">
	<h1 class="pb-4 text-lg font-bold md:text-xl lg:text-3xl">
		Reset Password
	</h1>

	<h3 class="self-start w-full pb-6">
		Enter your email to receive a password reset link.
	</h3>

	<?php include("../../global_views/php/close_popup_svg.php") ?>

	<form action=""
		    method="post"
		    class="flex flex-col items-center justify-between w-full">
		<input type="email"
			     name="password_reset_email"
			     placeholder="Email"
					 autocomplete="email"
			     maxlength="64"
			     required>

		<input class="self-end p-4 px-8 mt-8 font-semibold rounded-md"
			     type="submit"
			     value="SUBMIT">
	</form>
</div>