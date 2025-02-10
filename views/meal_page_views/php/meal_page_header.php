<!-- <header class="fixed flex items-center justify-between w-screen px-8 z-[5] top-0"> -->

<header class="flex w-screen items-center justify-between px-8 z-[11]">
    <div class="flex items-center justify-center w-[7rem]">
		<img id="logo-image" class="w-full h-full object-cover" src="../../../resources/images/logo_dark.png" alt="Logo">
	</div>
    
    <nav class="relative flex flex-wrap items-center justify-end flex-1 space-x-12 basis-4/12 md:flex-nowrap lg:basis-2/12">
        <div id="hamburger-menu" class="relative self-end w-8 h-12 cursor-pointer">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul id="dropdown-menu-list" class="absolute flex flex-col -right-[40px] -top-[150px] gap-4 w-[13rem] -z-10 bg-slate-700 p-4 opacity-0 transition-all">
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