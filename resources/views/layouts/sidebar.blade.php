<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="md:block hidden bg-white text-tertiary p-4 w-64 fixed h-full transform transition-transform md:relative md:translate-x-0">
    <div class="text-xl font-bold mb-8 block md:hidden">Task Management</div>

    <nav x-data="{ open: false, activeTab: '{{ Route::currentRouteName() }}' }" class="m-2">
        <ul>
            <!-- Dashboard Link -->
            <x-nav-link class="flex items-center" @click="activeTab = 'dashboard'">
                <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'dashboard' ? 'bg-tertiary text-white' : 'bg-white text-tertiary hover:bg-tertiary hover:text-white'">
                    Dashboard
                </a>
            </x-nav-link>

            <!-- Tasks Dropdown -->
            <li class="flex flex-col items-start  py-2 mt-4" x-data="{ open: false }">
                <div class="flex items-center cursor-pointer" @click="open = !open">
                    <a href="{{ route('tasks') }}" class="block py-2 px-4 rounded transition-colors relative z-10"
                       :class="activeTab === 'tasks' ? 'bg-tertiary text-white' : 'bg-white text-tertiary hover:bg-tertiary hover:text-white'">
                        Tasks
                    </a>
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div class="px-8 mx-2" x-show="open" x-transition>
                    <div class="text-sm text-gray-500 my-3">
                        <a href="{{ route('categories') }}" class="hover:text-tertiary font-medium transition-colors">Categories</a>
                    </div>
                    <div class="text-sm text-gray-500 my-3">
                        <a href="{{ route('status') }}"
                           class="hover:text-tertiary font-medium transition-colors">Status</a>
                    </div>
                </div>
            </li>

            <!-- Projects Link -->
            <x-nav-link class="flex items-center" @click="activeTab = 'projects'">
                <a href="{{ route('projects') }}" class="block py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'projects' ? 'bg-tertiary text-white' : 'bg-white text-blue-500 hover:bg-tertiary hover:text-white'">
                    Projects
                </a>
            </x-nav-link>

            <!-- Reports Link -->
            <x-nav-link class="flex items-center" @click="activeTab = 'reports'">
                <a href="{{ route('reports') }}" class="block py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'reports' ? 'bg-tertiary text-white' : 'bg-white text-blue-500 hover:bg-tertiary hover:text-white'">
                    Reports
                </a>
            </x-nav-link>

            <!-- Settings Link -->
            <x-nav-link class="flex items-center gap-2" @click="activeTab = 'profile.edit'">
                <a href="{{ route('profile.edit') }}" class="block py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'profile.edit' ? 'bg-tertiary text-white' : 'bg-white text-blue-500 hover:bg-tertiary hover:text-white'">
                    Settings
                </a>
            </x-nav-link>
        </ul>
    </nav>
</aside>
