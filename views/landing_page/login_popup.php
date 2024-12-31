<div id="login-popup"
     class="hidden flex-col w-1/4 items-center justify-between fixed  top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-xl rounded-lg p-6 bg-gray-200">
    <h1 class="font-bold pb-4">
        Log In
    </h1>
    <svg id="close-login-popup-svg"
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
          class="flex w-full h-48 flex-col items-center justify-between">
        <input type="email"
               name="email"
               placeholder="Email"
               required
               autocomplete="email">
        <input type="password"
               name="password"
               placeholder="Password"
               required
               autocomplete="current-password">
        <input type="submit"
               value="LOGIN">
    </form>
    <h3>
        Don't Have An Account?
        <button id="show-signup-button"
                class="underline pt-4 font-medium text-base md:text-lg lg:text-xl text-blue-600 transition hover:text-blue-800">
                Sign Up
        </button>
    </h3>
    <button id="reset-password-button"
            class="underline pt-4 font-medium text-base md:text-lg lg:text-xl text-blue-600 transition hover:text-blue-800">
            Forgot Password?
    </button>
</div>