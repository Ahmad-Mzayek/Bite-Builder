<?php include "../../global_views/php/show_password_icons.php"; ?>

<div id="signup-popup"
    class="popup hidden flex-col min-w-[30rem] min-h-[20rem] items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-2xl rounded-lg p-6">
    <h1 class="pb-4 font-bold">
        Sign Up
    </h1>
    
    <?php include("../../global_views/php/close_popup_svg.php"); ?>
    
    <form id="signup-form" class="flex flex-col items-center w-full space-y-3">
        <div id="signup-error-container" class="hidden w-full p-2 font-bold text-white bg-red-700">

        </div>

        <input type="text"
               id="signup-username-input"
               name="username_input"
               placeholder="Username"
               autocomplete="username"
               minlength="8"
               required
               maxlength="32">

        <input type="email"
               id="signup-email-input"
               name="email_address_input"
               placeholder="Email Address"
               autocomplete="email"
               minlength="1"
               maxlength="64"
               required>

        <div class="relative w-full cursor-pointer">
            <input type="password"
                   id="signup-password-input"
                   name="password_input"
                   placeholder="Password"
                   minlength="8"
                   maxlength="64"
                   required>

            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer toggle-password-icon">
                <?php echo $show_password_false_icon; ?>
            </span>
        </div>

        <div class="relative w-full cursor-pointer">
            <input type="password"
                   id="signup-confirm-password-input"
                   name="confirm_password_input"
                   placeholder="Confirm Password"
                   maxlength="64"
                   required>

            <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer toggle-password-icon">
                <?php echo $show_password_false_icon; ?>
            </span>
        </div>

        <input type="submit" 
               class="p-2 px-8 font-semibold rounded-md"            
               value="SIGNUP">
    </form>
    
    <h3>
        Already Have An Account?
        <button id="show-login-button" class="pt-4 text-base font-medium text-blue-600 underline transition md:text-lg lg:text-xl hover:text-blue-800">
            Log In
        </button>
    </h3>
</div>