
    <!-- Sidebar starts -->
    <!-- Remove class [ hidden ] and replace [ sm:flex ] with [ flex ] -->
    <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
    <div style="min-height: 100vh" class="w-52 fixed top-0 left-0 bg-gray-800 shadow md:h-full flex-col justify-between hidden sm:flex ">
        <div class="px-0">
            <div class="w-full flex items-center justify-center mt-3 gap-3">
              <!-- 144 30 -->
              <img class="inline-block w-9" src="{{ asset('images/informatics-logo.png') }}" alt="">
              <div class="text-end">
                <h3 class="block font-semibold leading-4 text-xl text-slate-200">Informatics </h3>
                <h3 class="block font-semibold text-slate-200">College</h3>
              </div>
            </div>
            <ul class="mt-10 ">
                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="px-10 py-3  w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                      <img class="w-4" src="{{ asset('images/dashboard-logo.png') }}" alt="">
                      <span class="text-sm ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('user.index') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('user.index') }}" class="px-10 py-3 w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                        <img class="w-4" src="{{ asset('images/users-logo.png') }}" alt="">
                        <span class="text-sm ml-2">User</span>
                    </a>
                </li>
                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('admin.item.index') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('admin.item.index') }}" class="px-10 py-3 w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                        <img class="w-4" src="{{ asset('images/list-logo.png') }}" alt="">
                        <span class="text-sm ml-2">Items</span>
                    </a>
                </li>
              




                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('option.index') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('option.index') }}" class="px-10 py-3 w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                        <img class="w-4" src="{{ asset('images/settings-logo.png') }}" alt="">
                        <span class="text-sm ml-2">Settings</span>
                    </a>
                </li>


            </ul>

        </div>
        <div class="border-t border-gray-700 ">
            <ul class="w-full text-center text-gray-300 py-1">
                @Copyright
            </ul>
        </div>
    </div>
    <div class="w-52 z-40 absolute bg-gray-800 shadow md:h-screen flex-col justify-between sm:hidden transition duration-150 ease-in-out" id="mobile-nav">
        <button aria-label="toggle sidebar" id="openSideBar" class="h-10 w-10 bg-gray-800 absolute right-0 mt-16 -mr-10 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 rounded focus:ring-gray-800" onclick="sidebarHandler(true)">
            <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFFFFF" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <circle cx="6" cy="10" r="2" />
                <line x1="6" y1="4" x2="6" y2="8" />
                <line x1="6" y1="12" x2="6" y2="20" />
                <circle cx="12" cy="16" r="2" />
                <line x1="12" y1="4" x2="12" y2="14" />
                <line x1="12" y1="18" x2="12" y2="20" />
                <circle cx="18" cy="7" r="2" />
                <line x1="18" y1="4" x2="18" y2="5" />
                <line x1="18" y1="9" x2="18" y2="20" />
            </svg>
        </button>
        <button aria-label="Close sidebar" id="closeSideBar" class="hidden h-10 w-10 bg-gray-800 absolute right-0 mt-16 -mr-10 flex items-center shadow rounded-tr rounded-br justify-center cursor-pointer text-white" onclick="sidebarHandler(false)">
            <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
        <div class="">
            <div class="w-full flex items-center justify-center mt-3 gap-3">
              <!-- 144 30 -->
              <img class="inline-block w-9" src="{{ asset('images/informatics-logo.png') }}" alt="">
              <div class="text-end">
                <h3 class="block font-semibold leading-4 text-xl text-slate-200">Informatics </h3>
                <h3 class="block font-semibold text-slate-200">College</h3>
              </div>
            </div>
            <ul class="mt-12">
                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="px-10 py-3  w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                      <img class="w-4" src="{{ asset('images/dashboard-logo.png') }}" alt="">
                      <span class="text-sm ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('user.index') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('user.index') }}" class="px-10 py-3 w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                        <img class="w-4" src="{{ asset('images/users-logo.png') }}" alt="">
                        <span class="text-sm ml-2">User</span>
                    </a>
                </li>
                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('admin.item.index') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('admin.item.index') }}" class="px-10 py-3 w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                        <img class="w-4" src="{{ asset('images/list-logo.png') }}" alt="">
                        <span class="text-sm ml-2">Items</span>
                    </a>
                </li>
              




                <li class="flex w-full justify-between text-gray-400 hover:text-gray-100 cursor-pointer items-center hover:bg-gray-700 {{ Route::is('option.index') ? 'bg-gray-700' : '' }}">
                    <a href="{{ route('option.index') }}" class="px-10 py-3 w-full flex items-center focus:outline-none focus:ring-1 focus:ring-indigo-700">
                        <img class="w-4" src="{{ asset('images/settings-logo.png') }}" alt="">
                        <span class="text-sm ml-2">Settings</span>
                    </a>
                </li>
            </ul>
            <div class="flex justify-center mt-48 mb-4 w-full">

            </div>
        </div>
        <div class="border-t border-gray-700 ">
            <ul class="w-full text-center text-gray-300 py-1">
                @Copyright
            </ul>
        </div>
    </div>

<script>
    var sideBar = document.getElementById("mobile-nav");
    var openSidebar = document.getElementById("openSideBar");
    var closeSidebar = document.getElementById("closeSideBar");
    sideBar.style.transform = "translateX(-208px)";

    function sidebarHandler(flag) {
        if (flag) {
            sideBar.style.transform = "translateX(0px)";
            openSidebar.classList.add("hidden");
            closeSidebar.classList.remove("hidden");
        } else {
            sideBar.style.transform = "translateX(-208px)";
            closeSidebar.classList.add("hidden");
            openSidebar.classList.remove("hidden");
        }
    }
</script>

