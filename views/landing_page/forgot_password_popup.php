<div id="forgot-password-popup"
	 class="hidden flex-col items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 shadow-xl rounded-lg p-6 bg-gray-200">
	<h1 class="font-bold text-lg md:text-xl lg:text-3xl pb-4">
		Reset Password
	</h1>
	<h3 class="w-full pb-6 self-start">
		Enter your email to receive a password reset link.
	</h3>
	<svg id="close-forgot-password-popup-svg"
		 class="absolute cursor-pointer right-4 top-3 close-popup transition hover:scale-110"
		 xmlns="http://www.w3.org/2000/svg"
		 width="32"
		 height="32"
		 viewBox="0 0 24 24">
		<path fill="currentColor"
			  d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z" />
	</svg>
	<form action=""
		  method="post"
		  class="flex w-full flex-col items-center justify-between">
		<input type="email"
			   name="password_reset_email"
			   placeholder="Email"
			   required
			   autocomplete="email">
		<input class="self-end p-2 mt-8"
			   type="submit"
			   value="SUBMIT">
	</form>
</div>