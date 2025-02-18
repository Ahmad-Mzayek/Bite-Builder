<php? #include("../../global_views/php/show_password_icons.php"); ?>

<div id="change-password-popup" class="popup-secondary hidden flex-col min-w-[35rem] items-center fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 shadow-2xl rounded-lg p-6 overflow-hidden gap-6">
    <h1 class="font-bold text-nowrap">
        Change Your Password
    </h1>

    <div id="change-password-popup-error-container" class="hidden w-full p-2 font-bold text-white bg-red-700">

    </div>

    <div id="change-password-popup-success-container" class="hidden w-full p-2 font-bold text-white bg-green-500">
        Password Changed Successfully!
    </div>

    <form id="change-password-form" class="flex flex-col w-full gap-8">
        <div class="flex flex-col w-full gap-3">
            <div class="relative w-full">
                <input type="password"
                       name="current_password_input"
                       placeholder="Current Password"
                       maxlength="64" >

                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer toggle-password-icon">
                    <?php echo $show_password_false_icon; ?>
                </span>
            </div>

            <div class="relative w-full">
                <input type="password"
                       id="new-password-input"
                       name="new_password_input"
                       placeholder="New Password"
                       minlength="8"
                       maxlength="64"
                       required>

                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer toggle-password-icon">
                    <?php echo $show_password_false_icon; ?>
                </span>
            </div>

            <div class="relative w-full">
                <input type="password"
                       name="confirm_new_password_input"
                       placeholder="Confirm Password"
                       maxlength="64"
                       required>

                <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer toggle-password-icon">
                    <?php echo $show_password_false_icon; ?>
                </span>
            </div>
        </div>

        <div class="flex items-center justify-center w-full space-x-12">
            <button type="button" id="close-change-password-popup-button" class="h-12 font-bold text-white bg-red-700 rounded-lg w-36 hover:bg-red-800">
                Cancel
            </button>

            <input type="submit" 
                   class="h-12 font-bold text-white bg-green-700 rounded-lg w-36 hover:bg-green-800"
                   value="Change" >
        </div>
    </form>
</div>