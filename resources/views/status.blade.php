<x-app-layout>
    <div class="flex-1 overflow-auto" x-data="{  showAddStatus: false }">
        <div class="md:flex justify-between">
            <div class="mb-4">
                <x-primary-button @click="showAddStatus = true">
                    + Add New Status
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
             x-data="{ showEditStatus: false, showDeleteStatus: false}">


            @php
                $headers = ['Status Name', 'Status', 'ADD Date', 'Actions'];
                $rows = [];
                foreach ($statuses as $status) {
                    $rows[] = [
                        $status->name,
                        $status->status,
                        \Carbon\Carbon::parse($status->created_at)->format('Y-m-d'),
                        '<a href="#" class="text-tertiary hover:text-tertiary"  @click="showEditStatus = true">Edit</a>
                         <a href="#" class="text-red-600 hover:text-red-900 ml-4" @click="showDeleteStatus = true">Delete</a>
                          ',
                    ];
                }
            @endphp

            <x-static-table :headers="$headers" :rows="$rows"/>

            <div x-show="showEditStatus" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12  w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Status</h2>
                    <div class="mb-4">
                        <x-input-label>Status Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select x-model="newProject.status"
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
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

                    <div class="flex justify-end gap-4">
                        <x-danger-button @click="showEditStatus = false">Cancel</x-danger-button>
                        <x-primary-button @click="editStatus">Edit Category</x-primary-button>

                    </div>
                </div>
            </div>
            <div x-show="showDeleteStatus"
                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete <span class="font-bold"
                                                                                         x-text="selectedCategory.name"></span>?
                    </x-input-label>

                    <div class="flex justify-end gap-2">
                        <x-primary-button @click="showDeleteStatus = false">Cancel</x-primary-button>
                        <x-danger-button @click="confirmDelete">Delete</x-danger-button>
                    </div>
                </div>
            </div>
            <div x-show="showAddStatus" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Status</h2>
                    <div class="mb-4">
                        <x-input-label>Status Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select x-model="newProject.status"
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
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

                    <div class="flex justify-end gap-4">
                        <x-danger-button @click="showAddStatus = false">Cancel</x-danger-button>
                        <x-primary-button @click="addStatus">Add Status</x-primary-button>

                    </div>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
