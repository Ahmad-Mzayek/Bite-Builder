<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bite Builder | Landing</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<style type="text/tailwindcss">
		@layer base {
      .content-auto {
        content-visibility: auto;
      }

	  body {
		background-color: var(--primary);
	  }

	  .light {
		--primary: #ffffff;
	  }

	  .dark {
		--primary: #000000;
	  }

	  h1 {
		@apply font-extrabold text-xl md:text-2xl lg:text-3xl
	  }
	  
	  h2 {
		@apply font-bold text-lg md:text-xl lg:text-2xl
	  }

	  h3 {
		@apply font-medium text-base md:text-lg lg:text-xl
	  }

	  button {
		@apply text-sm cursor-pointer md:text-base lg:text-lg text-nowrap
	  }

	  input[type="text"],
	  input[type="password"],
	  input[type="email"] {
		@apply p-2 w-full rounded-xl appearance-none border-2 text-lg md:text-xl lg:text-xl
	  }

	  input[type="submit"] {
		@apply bg-blue-800 text-white px-6 py-4 text-nowrap transition hover:bg-blue-900 cursor-pointer rounded-lg text-lg md:text-xl lg:text-xl tracking-[.1rem]
	  }
    }
  </style>
</head>

<body class="light">
	<div id="overlay" class="fixed inset-0 bg-gray-500 bg-opacity-70 hidden z-10">
	</div>

	<div id="signup-popup" class="hidden flex-col w-1/4 items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-xl rounded-lg p-6 bg-gray-200">
		<h1 class="font-bold  pb-4">
			Sign Up
		</h1>

		<svg id="close-signup-popup-svg" class="absolute cursor-pointer right-4 top-3 transition hover:scale-110" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
			<path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z" />
		</svg>

		<form action="" method="post" class="flex w-full h-80 flex-col items-center justify-between">
			<input type="text" name="name" placeholder="Name" required autocomplete="name">
			<input type="email" name="email" placeholder="Email" required autocomplete="email">
			<input type="password" name="password" placeholder="Password" required>
			<input type="password" name="confirm_password" placeholder="Confirm Password" required>

			<input type="submit" value="SIGNUP">
		</form>

		<h3>
			Already Have An Account? <button id="show-login-button" class="underline pt-4 font-medium text-base md:text-lg lg:text-xl text-blue-600 transition hover:text-blue-800">Log In</button>
		</h3>
	</div>

	<div id="login-popup" class="hidden flex-col w-1/4 items-center justify-between fixed  top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-xl rounded-lg p-6 bg-gray-200">
		<h1 class="font-bold pb-4">
			Log In
		</h1>

		<svg id="close-login-popup-svg" class="absolute cursor-pointer right-4 top-3 close-popup transition hover:scale-110" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
			<path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z" />
		</svg>

		<form action="" method="post" class="flex w-full h-48 flex-col items-center justify-between">

			<input type="email" name="email" placeholder="Email" required autocomplete="email">
			<input type="password" name="password" placeholder="Password" required autocomplete="current-password">

			<input type="submit" value="LOGIN">
		</form>

		<h3>
			Don't Have An Account?
			<button id="show-signup-button" class="underline pt-4 font-medium text-base md:text-lg lg:text-xl text-blue-600 transition hover:text-blue-800">Sign Up</button>
		</h3>

		<button id="reset-password-button" class="underline pt-4 font-medium text-base md:text-lg lg:text-xl text-blue-600 transition hover:text-blue-800">Forgot Your Password?</button>
	</div>

	<div id="reset-password-popup" class="hidden flex-col items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 shadow-xl rounded-lg p-6 bg-gray-200">
		<h1 class="font-bold text-lg md:text-xl lg:text-3xl pb-4">
			Reset Password
		</h1>

		<h3 class="w-full pb-6 self-start">
			Enter your email to receive a password reset link.
		</h3>

		<svg id="close-reset-password-popup-svg" class="absolute cursor-pointer right-4 top-3 close-popup transition hover:scale-110" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
			<path fill="currentColor" d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z" />
		</svg>

		<form action="" method="post" class="flex w-full flex-col items-center justify-between">

			<input type="email" name="password_reset_email" placeholder="Email" required autocomplete="email">

			<input class="self-end p-2 mt-8" type="submit" value="SUBMIT">
		</form>
	</div>

	<div class="flex h-screen flex-col items-center justify-between">

		<header class="flex w-full items-center justify-between p-6 bg-slate-600">
			<h1 class="text-white font-bold">
				Bite Builder Logo
			</h1>

			<div class="flex w-1/4 items-center justify-around ">
				<button id="login-signup-button" class="text-white font-semibold bg-slate-900 p-6 px-12 rounded-lg transition hover:bg-slate-950">
					Log In / Sign Up
				</button>

				<button id="theme-switch-button">
					<div class="flex items-center justify-center w-[48px] h-[48px]">
						<img id="theme-icon" class="transition w-full h-full" src="../../assets/dark-icon.png" alt="Dark Mode">
					</div>
				</button>
			</div>

		</header>

		<h1>
			Welcome to Bite Builder!
		</h1>



		<footer class="flex *:text-white flex-col w-full items-center justify-between p-8 pr-12 bg-slate-600">
			<h1 class="pb-6 lg:text-5xl">
				Developers
			</h1>

			<!-- <hr class="w-full border-[2px]"> -->

			<div class="flex pt-2 pb-2 items-center justify-around w-full">
				<h2>
					LinkedIn
				</h2>

				<h2>
					GitHub
				</h2>

				<h2>
					Email
				</h2>
			</div>

			<div class="flex items-center pt-4 justify-around w-full">
				<div class="flex flex-col items-center justify-around w-full [&>*]:transition ml-4">
					<a class="hover:underline" target="_blank" href="https://www.linkedin.com/in/ahmad-mzayek-97817330b">Ahmad Mzayek</a>
					<a class="hover:underline" target="_blank" href="https://www.linkedin.com/in/carla-kinaan-4ba434333/">Carla Kinaan</a>
					<a class="hover:underline" target="_blank" href="https://www.linkedin.com/in/amir-bou-ghanem">Amir Bou Ghanem</a>
				</div>

				<div class="flex flex-col border-l-2 border-r-2 items-center justify-around w-full ml-4">
					<a class="hover:underline" target="_blank" href="https://www.github.com/Ahmad-Mzayek">Ahmad Mzayek</a>
					<a class="hover:underline" target="_blank" href="https://github.com/CarlaKinaan">Carla Kinaan</a>
					<a class="hover:underline" target="_blank" href="https://www.github.com/amirbg2004">Amir Bou Ghanem</a>
				</div>

				<div class="flex flex-col items-center justify-around w-full">
					<a class="hover:underline" target="_blank" href="mailto:ahmadmzayek.cs@gmail.com">Ahmad Mzayek</a>
					<a class="hover:underline" target="_blank" href="mailto:carla.gms209@gmail.com">Carla Kinaan</a>
					<a class="hover:underline" target="_blank" href="mailto:amirbg43@hotmail.com">Amir Bou Ghanem</a>
				</div>
			</div>
		</footer>
	</div>

	<script src="./landing_page.js"></script>
</body>

</html>