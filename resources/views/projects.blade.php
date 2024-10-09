<x-app-layout>
    <div class="flex-1 overflow-auto" x-data="{  showAddProject: false }">
        <div class="md:flex justify-between">
            <div class="mb-4">
                <x-primary-button @click="showAddProject = true">
                    + Add New Project
                </x-primary-button>
            </div>
            <div class="mb-4 md:w-4/12">
                <form>
                    <div class="relative w-full">
                        <x-text-input type="text" placeholder="Search "
                                      class="text-sm border border-secondary w-full bg-primary rounded-md "/>
                        <x-primary-button type="submit"
                                          class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-tertiary rounded-e-lg ">
                            <img src="{{ asset('image/icon/search.svg ') }}" alt="search" class="w-4 h-4"/>
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg"
             x-data="{ showEditProject: false, showDeleteProject: false}">
            @php
                $headers = ['Project Name', 'Status', 'Start Date','deadline', 'Cost',
                  'Created By', 'Actions'];
                $rows = [];
                foreach ($projects as $project) {
                    $rows[] = [
                        ' <a href="' . route('projects.details', $project->id) . '" class="text-blue-600 hover:underline">' . $project->name . '</a>',
                        $project->status->name ?? null,
                        \Carbon\Carbon::parse($project->start_date)->format('Y-m-d'),
                        \Carbon\Carbon::parse($project->deadline)->format('Y-m-d'),
                        $project->cost,
                        $project->user->name,
                        '<a href="#" class="text-tertiary hover:text-tertiary"  @click="showEditProject = true">Edit</a>
                         <a href="#" class="text-red-600 hover:text-red-900 ml-4" @click="showDeleteProject = true">Delete</a>
                          ',
                    ];
                }
            @endphp
            <x-static-table :headers="$headers" :rows="$rows"/>
            <div x-show="showEditProject" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12  w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Project</h2>
                    <div class="mb-4">
                        <x-input-label>Project Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select x-model="newProject.status"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select status</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Overdue">Overdue</option>
                            <option value="cancelled">cancelled</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Due Date:</x-input-label>
                        <x-text-input class="w-full " type="date"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Cost:</x-input-label>
                        <x-text-input class="w-full " type="number"></x-text-input>
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-danger-button @click="showEditProject = false">Cancel</x-danger-button>
                        <x-primary-button @click="addProject">addProject</x-primary-button>
                    </div>
                </div>
            </div>
            <div x-show="showDeleteProject"
                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete <span class="font-bold"
                                                                                         x-text="selectedCategory.name"></span>?
                    </x-input-label>
                    <div class="flex justify-end gap-2">
                        <x-primary-button @click="showDeleteProject = false">Cancel</x-primary-button>
                        <x-danger-button @click="confirmDelete">Delete</x-danger-button>
                    </div>
                </div>
            </div>
            <div x-show="showAddProject" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Project</h2>
                    <div class="mb-4">
                        <x-input-label>Project Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
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
                        <x-input-label>Due Date:</x-input-label>
                        <x-text-input class="w-full " type="date"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Cost:</x-input-label>
                        <x-text-input class="w-full " type="number"></x-text-input>
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-danger-button @click="showAddProject = false">Cancel</x-danger-button>
                        <x-primary-button @click="addProject">Add Project</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
