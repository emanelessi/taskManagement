<x-app-layout>
    <div class="flex-1 overflow-auto" x-data="{  showAddProject: false }">
        <div class="md:flex justify-between">
            <div class="mb-4">
                <button @click="showAddProject = true" class="bg-tertiary text-white px-4 py-2 rounded shadow ">
                    + Add New Project
                </button>
            </div>

            <div class="mb-4 md:w-4/12">
                <form>
                    <div class="relative w-full">
                        <input type="text" placeholder="Search "
                               class="text-sm p-3  border border-secondary w-full bg-primary rounded-md "/>
                        <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-tertiary rounded-e-lg ">
                            <img src="../image/icon/search.svg" alt="search" class="w-4 h-4"/>
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="overflow-x-auto bg-white shadow-md rounded-lg"
             x-data="{ showEditProject: false, showDeleteProject: false}">
            <table class="min-w-full bg-white">
                <thead class="bg-secondary/20 border-b border-quaternary/30">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
                        Project Name
                    </th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
                        Due Date
                    </th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
                        Cost
                    </th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-quaternary/30">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black/80">Project A</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">2024-09-30</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">Alice, Bob</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-tertiary hover:text-tertiary"
                           @click="showEditProject = true">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4" @click="showDeleteProject = true">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black/80">Project B</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">2024-10-15</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">Charlie, Dana</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-tertiary hover:text-tertiary"
                           @click="showEditProject = true">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4" @click="showDeleteProject = true">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black/80">Project A</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full  bg-red-100 text-red-800">Completed</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">2024-09-30</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">Alice, Bob</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-tertiary hover:text-tertiary"
                           @click="showEditProject = true">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4" @click="showDeleteProject = true">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-black/80">Project B</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">2024-10-15</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-black/80">Charlie, Dana</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-tertiary hover:text-tertiary"
                           @click="showEditProject = true">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-900 ml-4" @click="showDeleteProject = true">Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div x-show="showEditProject" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12  w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Project</h2>
                    <div class="mb-4">
                        <label class="block text-black/70">Project Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Status:</label>
                        <select x-model="newProject.status"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select status</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Due Date:</label>
                        <input type="date" x-model="newProject.dueDate"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>

                    <div class="flex justify-end">
                        <button @click="showEditProject = false" class="bg-black text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="addProject" class="bg-tertiary text-white px-4 py-2 rounded">Add Project
                        </button>
                    </div>
                </div>

            </div>

            <div x-show="showDeleteProject"
                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <p class="mb-4">Are you sure you want to delete
                        <span class="font-bold" x-text="selectedProject.name"></span>?</p>
                    <div class="flex justify-end">
                        <button @click="showDeleteProject = false"
                                class="bg-tertiary text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="confirmDelete" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </div>
                </div>
            </div>
            <div x-show="showAddProject" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Project</h2>
                    <div class="mb-4">
                        <label class="block text-black/70">Project Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Status:</label>
                        <select x-model="newProject.status"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select status</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Due Date:</label>
                        <input type="date" x-model="newProject.dueDate"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>

                    <div class="flex justify-end">
                        <button @click="showAddProject = false" class="bg-black text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="addProject" class="bg-tertiary text-white px-4 py-2 rounded">Add Project
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
