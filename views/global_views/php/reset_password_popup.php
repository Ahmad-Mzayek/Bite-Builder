<div id="forgot-password-popup"
	 class="fixed z-50 flex-col items-center justify-between hidden p-6 -translate-x-1/2 -translate-y-1/2 bg-gray-200 rounded-lg shadow-xl top-1/2 left-1/2">
	<h1 class="pb-4 text-lg font-bold md:text-xl lg:text-3xl">
		Reset Password
	</h1>
	<h3 class="self-start w-full pb-6">
		Enter your email to receive a password reset link.
	</h3>
	<svg id="close-forgot-password-popup-svg"
		 class="absolute transition cursor-pointer right-4 top-3 close-popup hover:scale-110"
		 xmlns="http://www.w3.org/2000/svg"
		 width="32"
		 height="32"
		 viewBox="0 0 24 24">
		<path fill="currentColor"
			  d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z" />
	</svg>
	<form action=""
		  method="post"
		  class="flex flex-col items-center justify-between w-full">
		<input type="email"
			   name="password_reset_email"
			   placeholder="Email"
			   required
			   autocomplete="email"
			   maxlength="64">
		<input class="self-end p-2 mt-8"
			   type="submit"
			   value="SUBMIT">
	</form>
</div>