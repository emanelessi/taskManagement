<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="md:block hidden bg-white text-tertiary p-4 w-64 fixed h-full transform transition-transform md:relative md:translate-x-0">
    <div class="text-xl font-bold mb-8 block md:hidden">Task Management</div>

    <nav x-data="{ open: false, activeTab: '{{ Route::currentRouteName() }}' }" class="m-2">
        <ul>
            <!-- Dashboard Link -->
            <x-nav-link class="flex items-center" @click="activeTab = 'dashboard'">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-2 py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'dashboard' ? 'bg-tertiary text-white' : 'bg-white text-tertiary hover:bg-tertiary hover:text-white'">
                    <div class="rounded-lg w-8 h-8 flex justify-center bg-tertiary">
                        <img src="{{ asset('image/icon/home.svg ') }} " alt="home" width="15"/>
                    </div>
                    Dashboard
                </a>
            </x-nav-link>

            <!-- Tasks Dropdown -->
            <li class="flex flex-col items-start  py-2 mt-4" x-data="{ open: false }">
                <div class="flex items-center cursor-pointer " @click="open = !open"
                     :class="activeTab === 'tasks' || activeTab === 'categories'  || activeTab === 'status'   ? 'bg-tertiary text-white w-full rounded-md' : 'bg-white text-tertiary w-full rounded-md hover:bg-tertiary hover:text-white'">
                    <a href="{{ route('tasks') }}" class="flex items-center gap-2   py-2 px-4 relative z-10"
                    >
                        <div class="rounded-lg w-8 h-8 flex justify-center bg-tertiary">
                            <img src="{{ asset('image/icon/tasks.svg ') }} " alt="tasks" width="15"/>
                        </div>
                        Tasks
                    </a>
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 mx-8 transition-transform" fill="#000000"
                         stroke="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                <a href="{{ route('projects') }}"
                   class="flex items-center gap-2  py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'projects' ? 'bg-tertiary text-white' : 'bg-white text-blue-500 hover:bg-tertiary hover:text-white'">
                    <div class="rounded-lg w-8 h-8 flex justify-center bg-tertiary">
                        <img src="{{ asset('image/icon/projects.svg ') }} " alt="projects" width="15"/>
                    </div>
                    Projects
                </a>
            </x-nav-link>

            <!-- Reports Link -->
            <x-nav-link class="flex items-center" @click="activeTab = 'reports'">
                <a href="{{ route('reports') }}"
                   class="flex items-center gap-2  py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'reports' ? 'bg-tertiary text-white' : 'bg-white text-blue-500 hover:bg-tertiary hover:text-white'">
                    <div class="rounded-lg w-8 h-8 flex justify-center bg-tertiary">
                        <img src="{{ asset('image/icon/reports.svg ') }} " alt="reports" width="15"/>
                    </div>
                    Reports
                </a>
            </x-nav-link>

            <!-- Settings Link -->
            <x-nav-link class="flex items-center gap-2" @click="activeTab = 'profile.edit'">
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-2  py-2 px-4 rounded transition-colors relative z-10"
                   :class="activeTab === 'profile.edit' ? 'bg-tertiary text-white' : 'bg-white text-blue-500 hover:bg-tertiary hover:text-white'">
                    <div class="rounded-lg w-8 h-8 flex justify-center bg-tertiary">
                        <img src="{{ asset('image/icon/settings.svg ') }} " alt="settings" width="15"/>
                    </div>
                    Settings
                </a>
            </x-nav-link>
        </ul>
    </nav>
</aside>
