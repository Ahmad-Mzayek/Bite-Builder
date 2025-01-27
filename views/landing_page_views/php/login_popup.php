<div id="login-popup"
     class="hidden flex-col w-3/12 min-w-[25rem] min-h-[20rem] items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-xl rounded-lg p-6 bg-gray-200">
    <h1 class="font-bold pb-4">Log In</h1>
    <svg id="close-login-popup-svg"
         class="absolute cursor-pointer right-4 top-3 close-popup transition hover:scale-110"
         xmlns="http://www.w3.org/2000/svg"
         width="32"
         height="32"
         viewBox="0 0 24 24">
        <path fill="currentColor"
              d="m12 13.4l-4.9 4.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7l4.9-4.9l-4.9-4.9q-.275-.275-.275-.7t.275-.7t.7-.275t.7.275l4.9 4.9l4.9-4.9q.275-.275.7-.275t.7.275t.275.7t-.275.7L13.4 12l4.9 4.9q.275.275.275.7t-.275.7t-.7.275t-.7-.275z" />
    </svg>
    <form id="login-form"
          class="flex w-full flex-col items-center space-y-2">
        <div id="signup-success-container"
             class="hidden w-full p-2 bg-green-700 text-white font-bold">
            Signup successful! Please Log In.
        </div>
        <div id="login-error-container"
             class="hidden w-full p-2 bg-red-500 text-white font-bold">
        </div>
        <input type="text"
               name="login_input"
               id="login-input"
               placeholder="Login"
               required
               autocomplete="email"
               maxlength="64">
        <div class="relative w-full cursor-pointer">
            <input type="password"
                   class="password-input"
                   name="password_input"
                   id="login-password-input"
                   placeholder="Password"
                   required
                   autocomplete="current-password"
                   maxlength="64">
            <?php
            include("../../global_views/php/show_password_true_icon.php");
            include("../../global_views/php/show_password_false_icon.php");
            ?>
        </div>
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