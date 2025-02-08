<?php include "../../global_views/php/show_password_icons.php"; ?>

<div id="profile-popup"
     class="popup flex flex-col min-w-[40rem] items-center gap-5 fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20 shadow-2xl rounded-lg p-6 py-6 bg-gray-200 overflow-hidden">
    <h1 class="font-bold">
        Profile
    </h1>
	
    <?php include("../../global_views/php/close_popup_svg.php") ?>

    <div id="profile-popup-error-container" class="hidden w-full p-2 font-bold text-white bg-red-500">
        
    </div>

    <div id="profile-popup-success-container" class="hidden w-full p-2 font-bold text-white bg-green-500">

    </div>
        
    <div class="flex flex-col w-full gap-4">
        <div class="flex items-center gap-2">
                <h2 class="text-xl font-bold basis-4/12 text-nowrap">
                    Username:
                </h2>

                <input type="text" 
                        id="profile-popup-username-input" 
                        class="basis-5/12" 
                        name="username_input" 
                        minlength="8"
                        maxlength="32"
                        disabled>

                <button id="profile-popup-edit-username-button" class="flex items-center gap-2 m-auto font-bold text-blue-800 underline">
                    <?php include("./edit_pencil_icon.php"); ?>
                    Edit
                </button>
            
            <div id="profile-popup-edit-username-button-container" class="items-center hidden gap-2">
                <button id="cancel-edit-username-button" class="p-2 px-4 font-bold text-white bg-red-600 rounded-sm hover:bg-red-700">
                    Cancel
                </button>

                <button name="save-edit-username-button" id="save-edit-username-button" class="p-2 px-6 font-bold text-white bg-green-600 rounded-sm hover:bg-red-700">
                    Save
                </button>
            </div>
        </div>

        <div class="flex items-center">
            <h2 class="text-xl font-bold basis-4/12 text-nowrap">
                Email:
            </h2>

            <h3 id="profile-popup-email" class="p-2 ml-0 mr-auto font-normal basis-5/12">
                Email Goes Here
            </h3>
        </div>

        <div class="flex items-center gap-2">
            <h2 class="text-xl font-bold basis-4/12 text-nowrap">
                Phone Number:
            </h2>

            <input type="text"
                   id="profile-popup-phone-number-input" 
                   class="rounded-none basis-5/12"
                   name="phone_number_input" 
                   disabled>

            <button id="profile-popup-edit-phone-number-button" class="flex items-center gap-2 m-auto font-bold text-blue-800 underline">
                <?php include("./edit_pencil_icon.php"); ?>
                Edit
            </button>
        
            <div id="profile-popup-edit-phone-number-button-container" class="items-center hidden gap-2">
                <button id="cancel-edit-phone-number-button" class="p-2 px-4 font-bold text-white bg-red-600 rounded-sm hover:bg-red-700">
                    Cancel
                </button>

                <button id="save-edit-phone-number-button" name="save-edit-phone-number-button" class="p-2 px-6 font-bold text-white bg-green-600 rounded-sm hover:bg-red-700">
                    Save
                </button>
            </div>
        </div>
        
        <form id="update-gender-form" class="flex items-center w-full">
            <h2 class="text-xl font-bold basis-4/12 text-nowrap">
                Gender:
            </h2>

            <div class="flex items-center justify-between basis-5/12">
                <label class="flex items-center cursor-pointer group">
                    <input type="radio" 
                           name="is_male"
                           id="profile-popup-male-radio-input" 
                           class="hidden peer"
                           value="1"/>

                    <span
                        class="relative flex items-center justify-center w-6 h-6 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105">
                        <span
                            class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

                        <svg fill="currentColor"
                             viewBox="0 0 20 20"
                             class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                clip-rule="evenodd"
                                d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                                fill-rule="evenodd">
                            </path>
                        </svg>
                    </span>

                    <span
                        class="ml-3 text-lg font-medium text-gray-700 transition-colors duration-300 group-hover:text-blue-500">
                        Male
                    </span>
                </label>

                <label class="flex items-center cursor-pointer group">
                    <input type="radio"
                            id="profile-popup-female-radio-input"
                            class="hidden peer" 
                            name="is_male" 
                            value="0"/>

                    <span class="relative flex items-center justify-center w-6 h-6 transition-all duration-500 bg-gray-100 border-2 border-gray-400 rounded-full shadow-md peer-checked:border-pink-500 peer-checked:bg-pink-500 peer-hover:scale-105">
                        <span class="absolute inset-0 transition-all duration-500 rounded-md opacity-0 bg-gradient-to-br from-white/30 to-white/10 peer-checked:opacity-100 peer-checked:animate-pulse"></span>

                        <svg
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            class="hidden w-5 h-5 text-white transition-transform duration-500 transform scale-50 peer-checked:block peer-checked:scale-100"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                clip-rule="evenodd"
                                d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </span>

                    <span
                        class="ml-3 text-lg font-medium text-gray-700 transition-colors duration-300 group-hover:text-pink-500">
                        Female
                    </span>
                </label>
            </div>
            
            <div id="profile-popup-edit-gender-button-container" class="items-center hidden gap-2 ml-6">
                <button id="cancel-edit-gender-button" class="p-2 px-4 font-bold text-white bg-red-600 rounded-sm hover:bg-red-700">
                    Cancel
                </button>

                <button id="save-edit-gender-button" name="save-edit-phone-number-button" class="p-2 px-6 font-bold text-white bg-green-600 rounded-sm hover:bg-red-700">
                    Save
                </button>
            </div>
        </form>
    </div>

    <div class="flex flex-wrap items-center w-full gap-6 min-w-fit justify-evenly">
            <button id="open-change-password-popup-button" class="w-48 font-bold text-white bg-orange-600 rounded-lg h-14 hover:bg-orange-700">
                Change Password
            </button>

            <button id="open-delete-account-confirmation-popup-button" class="w-48 font-bold text-white bg-red-600 rounded-lg h-14 hover:bg-red-700">
                Delete Account
            </button>
    </div>
</div>