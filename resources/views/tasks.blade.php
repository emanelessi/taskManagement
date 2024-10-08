<x-app-layout>
    <div class="flex-col  w-full  overflow-auto scrollbar-thin">

        <!--        <div class="md:flex  my-4 space-x-4">-->
        <!--            <input type="text" id="taskName" placeholder="Add Task"-->
        <!--                   class="text-sm p-3 border border-secondary  bg-primary rounded-md ">-->
        <!--            <input type="date" id="dueDate" class="text-sm p-3 border border-secondary bg-primary rounded-md ">-->
        <!--            <button @click="addTask" class="bg-tertiary text-white p-2 rounded">Add Task</button>-->
        <!--        </div>-->

        <div class="md:flex  my-4 w-full" x-data="{ sidebarOpen: false, profileMenuOpen: false, showAddTask: false, showEditTask: false, showDeleteTask: false, showAddCategory: false }">
            <div class="md:flex justify-between w-full space-x-4">
                <div class="md:w-1/4 w-full ">
                    <div class="flex justify-between bg-white p-4 rounded-lg">
                        <div class="flex space-x-2 px-2 ">
                            <h2 class="text-md font-bold">Backlog</h2>
                            <h2 class="text-md font-bold text-tertiary">5</h2>
                        </div>

                        <div class="flex space-x-2 px-2 ">
                            <img src="{{ asset('image/icon/dots.svg') }}" alt="dots" width="20"/>
                            <!--                            <img src="../image/icon/add.svg" alt="add" @click="showAddCategory = true" />-->

                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white p-3 rounded-lg shadow mb-2">
                            <div class="flex justify-between my-3">
                                <h3 class="font-semibold bg-tertiary/30 w-5/12 flex items-center justify-center rounded-lg">
                                    Design</h3>
                                <div class="flex space-x-2 px-2 ">
                                    <img src="../image/icon/delete.svg" alt="delete" width="15" @click="showDeleteTask = true"/>
                                    <img src="../image/icon/edit.svg" alt="edit" width="20" @click="showEditTask = true"/>
                                </div>
                            </div>
                            <img src="../image/icon/taskImage.svg"
                                 class="w-11/12 flex justify-center items-center rounded-lg mx-auto"/>
                            <p class="font-bold m-4">Create styleguide foundation</p>
                            <p class="m-4">Create content for peceland AppCreate content for peceland AppCreate content
                                for peceland
                                AppCreate content for peceland App</p>
                        </div>
                        <div class="mt-2">
                            <div class=" p-3 rounded-lg shadow mb-2">
                                <svg @click="showAddTask = true" width="250" height=" 15"
                                     class="flex justify-center items-center mx-auto"
                                     viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                                          fill="#232360"/>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/4 w-full  ">
                    <div class="flex justify-between bg-white p-4 rounded-lg">
                        <div class="flex space-x-2 px-2 ">
                            <h2 class="text-md font-bold">To Do</h2>
                            <h2 class="text-md font-bold text-tertiary">20</h2>
                        </div>

                        <div class="flex space-x-2 px-2 ">
                            <img src="../image/icon/dots.svg" alt="dots" width="20"/>
                            <!--                            <img src="../image/icon/add.svg" alt="add"/>-->

                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white p-3 rounded-lg shadow mb-2">
                            <div class="flex justify-between my-3">
                                <h3 class="font-semibold bg-tertiary/30 w-5/12 flex items-center justify-center rounded-lg">
                                    Research</h3>
                                <div class="flex space-x-2 px-2 ">
                                    <img src="../image/icon/delete.svg" alt="delete" width="15" @click="showDeleteTask = true"/>
                                    <img src="../image/icon/edit.svg" alt="edit" width="20" @click="showEditTask = true"/>
                                </div>
                            </div>
                            <!--                            <img src="../image/icon/taskImage.svg" class="w-11/12 flex justify-center items-center rounded-lg mx-auto" />-->
                            <p class="font-bold m-4">Create styleguide foundation</p>
                            <p class="m-4">Create content for peceland AppCreate content for peceland AppCreate content
                                for peceland
                                AppCreate content for peceland App</p>
                        </div>
                        <div class="mt-2">
                            <div class=" p-3 rounded-lg shadow mb-2">
                                <svg @click="showAddTask = true" width="250" height=" 15"
                                     class="flex justify-center items-center mx-auto"
                                     viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                                          fill="#232360"/>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/4 w-full ">
                    <div class="flex justify-between bg-white p-4 rounded-lg">
                        <div class="flex space-x-2 px-2 ">
                            <h2 class="text-md font-bold">Backlog</h2>
                            <h2 class="text-md font-bold text-tertiary">5</h2>
                        </div>

                        <div class="flex space-x-2 px-2 ">
                            <img src="../image/icon/dots.svg" alt="dots" width="20"/>
                            <!--                            <img src="../image/icon/add.svg" alt="add"/>-->

                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white p-3 rounded-lg shadow mb-2">
                            <div class="flex justify-between my-3">
                                <h3 class="font-semibold bg-tertiary/30 w-5/12 flex items-center justify-center rounded-lg">
                                    Design</h3>
                                <div class="flex space-x-2 px-2 ">
                                    <img src="../image/icon/delete.svg" alt="delete" width="15" @click="showDeleteTask = true"/>
                                    <img src="../image/icon/edit.svg" alt="edit" width="20" @click="showEditTask = true"/>
                                </div>
                            </div>
                            <img src="../image/icon/taskImage.svg"
                                 class="w-11/12 flex justify-center items-center rounded-lg mx-auto"/>
                            <p class="font-bold m-4">Create styleguide foundation</p>
                            <p class="m-4">Create content for peceland AppCreate content for peceland AppCreate content
                                for peceland
                                AppCreate content for peceland App</p>
                        </div>
                        <div class="mt-2">
                            <div class=" p-3 rounded-lg shadow mb-2">
                                <svg @click="showAddTask = true" width="250" height=" 15"
                                     class="flex justify-center items-center mx-auto"
                                     viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                                          fill="#232360"/>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/4 w-full  ">
                    <div class="flex justify-between bg-white p-4 rounded-lg">
                        <div class="flex space-x-2 px-2 ">
                            <h2 class="text-md font-bold">To Do</h2>
                            <h2 class="text-md font-bold text-tertiary">20</h2>
                        </div>

                        <div class="flex space-x-2 px-2 ">
                            <img src="../image/icon/dots.svg" alt="dots" width="20"/>
                            <!--                            <img src="../image/icon/add.svg" alt="add"/>-->

                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="bg-white p-3 rounded-lg shadow mb-2">
                            <div class="flex justify-between my-3">
                                <h3 class="font-semibold bg-tertiary/30 w-5/12 flex items-center justify-center rounded-lg">
                                    Research</h3>
                                <div class="flex space-x-2 px-2 ">
                                    <img src="../image/icon/delete.svg" alt="delete" width="15" @click="showDeleteTask = true"/>
                                    <img src="../image/icon/edit.svg" alt="edit" width="20" @click="showEditTask = true"/>
                                </div>
                            </div>
                            <!--                            <img src="../image/icon/taskImage.svg" class="w-11/12 flex justify-center items-center rounded-lg mx-auto" />-->
                            <p class="font-bold m-4">Create styleguide foundation</p>
                            <p class="m-4">Create content for peceland AppCreate content for peceland AppCreate content
                                for peceland
                                AppCreate content for peceland App</p>
                        </div>
                        <div class="mt-2">
                            <div class=" p-3 rounded-lg shadow mb-2">
                                <svg @click="showAddTask = true" width="250" height=" 15"
                                     class="flex justify-center items-center mx-auto"
                                     viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                                          fill="#232360"/>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/4 w-full ">
                    <div class="flex justify-between bg-white p-4 rounded-lg">
                        <div class="flex space-x-2 px-2 ">
                            <h2 class="text-md font-bold">ADD MORE TOPIC</h2>
                        </div>

                        <div class="flex space-x-2 px-2 ">
                            <!--                            <img src="../image/icon/dots.svg" alt="dots" width="20"/>-->
                            <img src="../image/icon/add.svg" alt="add" @click="showAddCategory = true" />

                        </div>
                    </div>
                    <div class="mt-2">
                        <div class=" p-3 rounded-lg shadow mb-2">
                            <svg @click="showAddTask = true" width="250" height="15"
                                 class="flex justify-center items-center mx-auto"
                                 viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                                      fill="#232360"/>
                            </svg>

                        </div>
                    </div>
                </div>

            </div>
            <div x-show="showAddTask"
                 class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  mt-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Task</h2>
                    <div class="mb-4">
                        <label class="block text-black/70">Task Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Project Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Category Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Status:</label>
                        <select x-model="newProject.status"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select status</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Due Date:</label>
                        <input type="date" x-model="newProject.dueDate"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Description:</label>
                        <textarea type="text" x-model="newProject.team"
                                  class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">image:</label>
                        <input type="file" x-model="newProject.image"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"/>
                    </div>
                    <div class="flex justify-end">
                        <button @click="showAddTask = false" class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="addProject" class="bg-tertiary text-white px-4 py-2 rounded">Add Task
                        </button>
                    </div>
                </div>
            </div>
            <div x-show="showEditTask"
                 class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12   mt-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Task</h2>
                    <div class="mb-4">
                        <label class="block text-black/70">Task Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Project Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Category Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Status:</label>
                        <select x-model="newProject.status"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select status</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Due Date:</label>
                        <input type="date" x-model="newProject.dueDate"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Description:</label>
                        <textarea type="text" x-model="newProject.team"
                                  class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">image:</label>
                        <input type="file" x-model="newProject.image"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"/>
                    </div>
                    <div class="flex justify-end">
                        <button @click="showEditTask = false" class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="addProject" class="bg-tertiary text-white px-4 py-2 rounded">Edit Task
                        </button>
                    </div>
                </div>
            </div>
            <div x-show="showDeleteTask" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <p class="mb-4">Are you sure you want to delete <span class="font-bold" x-text="selectedProject.name"></span>?</p>
                    <div class="flex justify-end">
                        <button @click="showDeleteTask = false" class="bg-tertiary text-white px-4 py-2 rounded mr-2">Cancel</button>
                        <button @click="confirmDelete" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                    </div>
                </div>
            </div>

            <div x-show="showAddCategory"
                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Category</h2>
                    <div class="mb-4">
                        <label class="block text-black/70">Category Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="mb-4">
                        <label class="block text-black/70">Project Name:</label>
                        <input type="text" x-model="newProject.name"
                               class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                    </div>
                    <div class="flex justify-end">
                        <button @click="showAddCategory = false" class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                            Cancel
                        </button>
                        <button @click="addProject" class="bg-tertiary text-white px-4 py-2 rounded">Add Category
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
