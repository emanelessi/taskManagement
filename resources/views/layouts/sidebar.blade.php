<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="md:block hidden bg-sky-light text-gray-900 shadow-lg p-4 w-64 fixed h-full transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0">
    <div class="text-2xl font-semibold mb-8 block md:hidden text-center text-gray-800">Task Management</div>

    <nav x-data="{ open: false, activeTab: '{{ Route::currentRouteName() }}' }" class="m-2">
        <ul>
            <!-- Dashboard Link -->
            @can('view dashboard')
                <x-nav-link class="flex items-center" @click="activeTab = 'dashboard'">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 py-3 px-5 rounded-md transition-all duration-200 ease-in-out relative z-10"
                       :class="activeTab === 'dashboard' ? 'bg-tertiary text-white shadow-md' : 'text-gray-800 hover:bg-tertiary hover:text-white hover:shadow-lg'">
                        <div class="rounded-lg w-8 h-8 flex justify-center items-center bg-tertiary shadow-md">
                            <img src="{{ asset('image/icon/home.svg') }}" alt="home" width="15"/>
                        </div>
                        <span>Dashboard</span>
                    </a>
                </x-nav-link>
            @endcan

            <!-- Tasks Dropdown -->
            @can('manage tasks')
                <li class="flex flex-col items-start py-2 mt-4" x-data="{ open: false }">
                    <div class="flex items-center cursor-pointer" @click="open = !open"
                         :class="activeTab === 'tasks' || activeTab === 'categories' || activeTab === 'status'||activeTab === 'tasks.details'  ? 'bg-tertiary text-white w-full rounded-md shadow-md' : 'text-gray-800 hover:w-full hover:rounded-md hover:bg-tertiary hover:text-white hover:shadow-md'">
                        <a href="{{ route('tasks') }}" class="flex items-center gap-3 py-3 px-5">
                            <div class="rounded-lg w-8 h-8 flex justify-center items-center bg-tertiary shadow-md">
                                <img src="{{ asset('image/icon/tasks.svg') }}" alt="tasks" width="15"/>
                            </div>
                            <span>Tasks</span>
                        </a>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 ml-auto mx-4 transition-transform"
                             fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="px-8 mx-2" x-show="open" x-transition>
                        <div class="text-sm text-gray-600 my-3">
                            @can('manage categories')
                                <a href="{{ route('categories') }}"
                                   class="hover:text-tertiary font-medium">Categories</a>
                            @endcan
                        </div>
                        <div class="text-sm text-gray-600 my-3">
                            @can('manage status')
                                <a href="{{ route('status') }}" class="hover:text-tertiary font-medium">Status</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcan

            <!-- Projects Link -->
            @can('manage projects')
                <x-nav-link class="flex items-center" @click="activeTab = 'projects'">
                    <a href="{{ route('projects') }}"
                       class="flex items-center gap-3 py-3 px-5 rounded-md transition-all duration-200 ease-in-out relative z-10"
                       :class="activeTab === 'projects' ||activeTab === 'projects.details'  ||activeTab === 'projects.tasks' ? 'bg-tertiary text-white shadow-md' : 'text-gray-800 hover:bg-tertiary hover:text-white hover:shadow-lg'">
                        <div class="rounded-lg w-8 h-8 flex justify-center items-center bg-tertiary shadow-md">
                            <img src="{{ asset('image/icon/projects.svg') }}" alt="projects" width="15"/>
                        </div>
                        <span>Projects</span>
                    </a>
                </x-nav-link>
            @endcan

            <!-- Reports Dropdown -->
            @can('view reports')
                <li class="flex flex-col items-start py-2 mt-4" x-data="{ open: false }">
                    <div class="flex items-center cursor-pointer" @click="open = !open"
                         :class="activeTab === 'Reports' || activeTab === 'project.report' || activeTab === 'task.report' ? 'bg-tertiary text-white w-full rounded-md shadow-md' : 'text-gray-800 hover:w-full hover:rounded-md hover:bg-tertiary hover:text-white hover:shadow-md'">
                        <a href="#" class="flex items-center gap-3 py-3 px-5">
                            <div class="rounded-lg w-8 h-8 flex justify-center items-center bg-tertiary shadow-md">
                                <img src="{{ asset('image/icon/reports.svg') }}" alt="reports" width="15"/>
                            </div>
                            <span>Reports</span>
                        </a>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 ml-auto mr-4 transition-transform"
                             fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="px-8 mx-2" x-show="open" x-transition>
                        <div class="text-sm text-gray-600 my-3">
                            @can('view project report')
                                <a href="{{ route('project.report') }}" class="hover:text-tertiary font-medium">Project
                                    Report</a>
                            @endcan
                        </div>
                        <div class="text-sm text-gray-600 my-3">
                            @can('view task report')
                                <a href="{{ route('task.report') }}" class="hover:text-tertiary font-medium">Task
                                    Report</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endcan

            <!-- Settings Link -->
            @can('manage settings')
                <x-nav-link class="flex items-center" @click="activeTab = 'profile.edit'">
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 py-3 px-5 rounded-md transition-all duration-200 ease-in-out relative z-10"
                       :class="activeTab === 'profile.edit' ? 'bg-tertiary text-white shadow-md' : 'text-gray-800 hover:bg-tertiary hover:text-white hover:shadow-lg'">
                        <div class="rounded-lg w-8 h-8 flex justify-center items-center bg-tertiary shadow-md">
                            <img src="{{ asset('image/icon/settings.svg') }}" alt="settings" width="15"/>
                        </div>
                        <span>Settings</span>
                    </a>
                </x-nav-link>
            @endcan

        </ul>
    </nav>
</aside>
