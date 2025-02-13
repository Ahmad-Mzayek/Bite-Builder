<header class="flex w-screen items-center justify-between px-8 z-[11] h-20">
    <div class="flex items-center justify-center h-full">
		<img id="logo-image" class="object-cover w-full h-full" src="../../../resources/images/logo_dark.png" alt="Logo">
	</div>
    
    <nav class="relative flex space-x-12">
        <div id="hamburger-menu" class="relative w-8 h-12 cursor-pointer">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul id="dropdown-menu-list" class="absolute flex flex-col -right-[32px] -top-[350px] gap-4 w-[13rem] -z-10 p-4 opacity-0 transition-all rounded-md ">
            <li>
                <span>
                    Profile
                </span>

                <?php include("./profile_icon.php"); ?>
            </li>

            <li>
                <span>
                    Theme
                </span>

                <?php include("../../global_views/php/theme_switch_button.php"); ?>
            </li>

            <li>
                <?php include("./logout_button.php"); ?>
            </li>
        </ul>
    </nav>
</header>