<header class="flex w-screen items-center justify-between p-6 px-12 bg-slate-600 z-[11]">
    <h1 class="flex-1 basis-8/12 text-white font-bold text-nowrap">
        Bite Builder Logo
    </h1>
    <nav class="relative flex flex-1 basis-4/12 flex-wrap md:flex-nowrap lg:basis-2/12 items-center justify-end space-x-12">
        <div id="hamburger-menu" class="relative w-8 h-12 cursor-pointer self-end">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul id="dropdown-menu-list" class="absolute flex flex-col -right-[50px] -top-[150px] gap-4 w-[13rem] -z-10 bg-slate-700 p-4 opacity-0 transition-all">
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