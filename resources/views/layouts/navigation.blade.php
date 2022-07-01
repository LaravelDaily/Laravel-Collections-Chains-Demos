<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('example1')" :active="request()->routeIs('example1')">
                        1
                    </x-nav-link>
                    <x-nav-link :href="route('example2')" :active="request()->routeIs('example2')">
                        2
                    </x-nav-link>
                    <x-nav-link :href="route('example3')" :active="request()->routeIs('example3')">
                        3
                    </x-nav-link>
                    <x-nav-link :href="route('example4')" :active="request()->routeIs('example4')">
                        4
                    </x-nav-link>
                    <x-nav-link :href="route('example5')" :active="request()->routeIs('example5')">
                        5
                    </x-nav-link>
                    <x-nav-link :href="route('example6')" :active="request()->routeIs('example6')">
                        6
                    </x-nav-link>
                    <x-nav-link :href="route('example7')" :active="request()->routeIs('example7')">
                        7
                    </x-nav-link>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
