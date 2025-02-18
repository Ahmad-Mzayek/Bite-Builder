<?php include "../../global_views/php/show_password_icons.php"; ?>

<div id="login-popup"
     class="popup hidden flex-col min-w-[30rem] min-h-[20rem] items-center fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-xl rounded-lg p-6">
    <h1 class="pb-4 font-bold">Log In</h1>

    <?php include("../../global_views/php/close_popup_svg.php"); ?>

    <form id="login-form" class="flex flex-col items-center w-full space-y-3">
        <div id="signup-success-container"
             class="hidden w-full p-2 font-bold text-white bg-green-500">
            Signup successful! Please Log In.
        </div>

        <div id="login-error-container"
             class="hidden w-full p-2 font-bold text-white bg-red-700">
        </div>

        <input type="text"
               name="login_input"
               id="login-input"
               placeholder="Login"
               autocomplete="email"
               minlength="1"
               maxlength="64"
               required>

        <div class="relative w-full cursor-pointer">
            <input type="password"
                   name="password_input"
                   id="login-password-input"
                   placeholder="Password"
                   minlength="1"
                   maxlength="64"
                   required>

            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer toggle-password-icon">
                <?php echo $show_password_false_icon; ?>
            </span>
        </div>

        <input type="submit"
               class="p-2 px-8 font-semibold rounded-md"
               value="LOGIN">
    </form>

    <h3>
        Don't Have An Account?
        <button id="show-signup-button"
                class="pt-4 text-base font-medium text-blue-600 underline transition md:text-lg lg:text-xl hover:text-blue-800">
            Sign Up
        </button>
    </h3>
    
    <button id="reset-password-button"
            class="pt-2 text-base font-medium text-blue-600 underline transition md:text-lg lg:text-xl hover:text-blue-800">
        Forgot Password?
    </button>
</div>