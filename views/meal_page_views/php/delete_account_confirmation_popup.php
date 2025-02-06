<div id="delete-account-confirmation-popup"
     class="hidden flex-col min-w-[20rem] min-h-[20rem] items-center justify-between fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 shadow-2xl rounded-lg p-6 py-8 bg-gray-200 overflow-hidden">
    <h1 class="font-bold text-nowrap">
        Delete Account Confirmation
    </h1>
	
    <div id="delete-account-confirmation-popup-error-container" class="hidden w-full p-2 font-bold text-white bg-red-500">
    </div>

		<p class="text-xl font-bold text-red-600">Are you sure you want to delete your account? This action is irreversible!</p>

			<div class="relative w-full">
				<input type="password"
							class="current-password-input"
							placeholder="Enter Your Current Password"
							maxlength="64"
							required>

					<span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer toggle-password-icon">
							<?php echo $show_password_false_icon; ?>
					</span>
			</div>

			<div class="flex flex-wrap items-center justify-center gap-6">
					<button id="close-delete-account-confirmation-popup-button" class="h-12 font-bold text-white bg-green-700 rounded-lg w-36 hover:bg-green-800">
						No
					</button>

					<button id="confirm-delete-account-button" class="h-12 font-bold text-white bg-red-700 rounded-lg w-36 hover:bg-red-800">
						Yes
					</button>
			</div>
</div>