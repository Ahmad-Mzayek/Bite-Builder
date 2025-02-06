<php? #include("../../global_views/php/show_password_icons.php"); ?>

<div id="change-password-popup" class="hidden flex-col w-4/12 min-w-[20rem] min-h-[27rem] items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 shadow-2xl rounded-lg p-6 py-8 bg-gray-200 overflow-hidden">
    <h1 class="font-bold text-nowrap">
        Change Your Password
    </h1>

    <div id="change-password-popup-error-container" class="hidden w-full p-2 font-bold text-white bg-red-500">

    </div>

    <div id="change-password-popup-success-container" class="hidden w-full p-2 font-bold text-white bg-green-500">
        Password Changed Successfully!
    </div>

    <form class="flex flex-col gap-10 w-full">
        <div class="flex flex-col gap-3 w-full">
            <div class="relative w-full">
                <input type="password"
                       name="current_password_input"
                       placeholder="Enter Your Current Password"
                       maxlength="64"
                       required>

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

        <div class="flex items-center justify-center space-x-12 w-full">
            <button id="close-change-password-popup-button" class="bg-green-700 text-white font-bold w-36 h-12 rounded-lg hover:bg-green-800">
                Cancel
            </button>

            <button id="confirm-change-password-button" type="submit" class="bg-red-700 text-white font-bold w-36 h-12 rounded-lg hover:bg-red-800">
                Change
            </button>
        </div>
    </form>
</div>