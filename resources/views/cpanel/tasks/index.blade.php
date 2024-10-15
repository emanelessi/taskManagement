<x-app-layout>
    <div class="flex-col  w-full  overflow-auto scrollbar-thin">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <!--        <div class="md:flex  my-4 space-x-4">-->
        <!--            <input type="text" id="taskName" placeholder="Add Task"-->
        <!--                   class="text-sm p-3 border border-secondary  bg-primary rounded-md ">-->
        <!--            <input type="date" id="dueDate" class="text-sm p-3 border border-secondary bg-primary rounded-md ">-->
        <!--            <button  class="bg-tertiary text-white p-2 rounded">Add Task</button>-->
        <!--        </div>-->
{{--        @foreach($tasks as $task)--}}
{{--            <p class="font-semibold text-tertiary">{{ $task->project->name ?? 'Project Name' }}</p>--}}

{{--        @endforeach--}}

        <div class="md:flex  my-4 w-full">
            <div id="task-board" class="md:flex justify-between w-full space-x-4">

                <x-task-board :backlogCount="0" :toDoCount="0" :tasks="$tasks ?? []"/>
                <div class="lg:w-2/4 w-full ">
                    <div class="flex justify-between bg-white p-4 rounded-lg">
                        <div class="flex space-x-2 px-2 ">
                            <h2 class="text-md font-bold">ADD MORE TOPIC</h2>
                        </div>
                        <div class="flex space-x-2 px-2 ">
                            <img src="../image/icon/add.svg" alt="add"/>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class=" p-3 rounded-lg shadow mb-2">
                            <svg width="250" height="15"
                                 class="flex justify-center items-center mx-auto"
                                 viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                                    fill="#232360"/>
                            </svg>

                        </div>
                    </div>
                </div>
            </div>
            <div id="addTaskModal" style="display: none;"
                 class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  mt-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Task</h2>
                    <div class="mb-4">
                        <x-input-label>Task Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Project Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Category Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select
                            class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
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
                        <x-input-label>Description:</x-input-label>
                        <textarea type="text"
                                  class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-input-label>image:</x-input-label>
                        <x-text-input class="w-full " type="file"></x-text-input>
                    </div>
                    <div class="flex justify-end">
                        <x-danger-button>Cancel</x-danger-button>
                        <x-primary-button>Add Task</x-primary-button>
                    </div>
                </div>
            </div>
            <div id="editTaskModal" style="display: none;"
                 class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12   mt-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Task</h2>
                    <div class="mb-4">
                        <x-input-label>Task Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Project Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Category Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select
                            class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
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
                        <x-input-label>Description:</x-input-label>
                        <textarea type="text"
                                  class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-input-label>image:</x-input-label>
                        <x-text-input class="w-full " type="file"></x-text-input>
                    </div>
                    <div class="flex justify-end">
                        <x-danger-button>Cancel</x-danger-button>
                        <x-primary-button>Edit Task</x-primary-button>
                    </div>
                </div>
            </div>
            <div id="deleteTaskModal" style="display: none;"
                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete <span class="font-bold"></span>?
                    </x-input-label>
                    <div class="flex justify-end">
                        <x-primary-button>Cancel</x-primary-button>
                        <x-danger-button>Delete</x-danger-button>
                    </div>
                </div>
            </div>
            <div id="addCategoryModal" style="display: none;"
                 class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Category</h2>
                    <div class="mb-4">
                        <x-input-label>Category Name:</x-input-label>
                        <x-text-input class="w-full " type="text"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select
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
                        <x-danger-button>Cancel</x-danger-button>
                        <x-primary-button>Add Category</x-primary-button>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <!--start storing models in variables -->
            const addTaskModal = document.getElementById('addTaskModal');
            const editTaskModal = document.getElementById('editTaskModal');
            const deleteTaskModal = document.getElementById('deleteTaskModal');
            const addCategoryModal = document.getElementById('addCategoryModal');
            <!--end storing models in variables -->

            {{--<!--start open and close the model -->--}}
            {{--document.getElementById('addCategoryBtn').addEventListener('click', () => {--}}
            {{--    addCategoryModal.classList.remove('hidden');--}}
            {{--});--}}

            {{--document.getElementById('cancelAddCategory').addEventListener('click', () => {--}}
            {{--    addCategoryModal.classList.add('hidden');--}}
            {{--});--}}

            {{--document.getElementById('cancelEditCategory').addEventListener('click', () => {--}}
            {{--    editCategoryModal.style.display = 'none';--}}
            {{--});--}}
            {{--<!--end open and close the model -->--}}

            {{--<!--start storing data in the model -->--}}
            {{--document.querySelectorAll('.edit-category').forEach(editButton => {--}}
            {{--    editButton.addEventListener('click', function () {--}}
            {{--        const categoryId = this.dataset.id;--}}
            {{--        const categoryName = this.dataset.name;--}}
            {{--        const categoryStatus = this.dataset.status;--}}

            {{--        document.querySelector('input[name="name"]').value = categoryName;--}}
            {{--        document.querySelector('select[name="status"]').value = categoryStatus;--}}


            {{--        editCategoryModal.setAttribute('action', `{{ route('categories.update', '') }}/${categoryId}`);--}}
            {{--        editCategoryModal.style.display = 'flex';--}}
            {{--    });--}}
            {{--});--}}
            {{--<!--end storing data in the model -->--}}

            {{--<!--start process  in the delete model -->--}}
            {{--document.getElementById('cancelDeleteCategory').addEventListener('click', () => {--}}
            {{--    deleteCategoryModal.style.display = 'none';--}}
            {{--});--}}

            {{--document.querySelectorAll('.delete-category').forEach(deleteButton => {--}}
            {{--    deleteButton.addEventListener('click', function () {--}}
            {{--        const categoryId = this.dataset.id;--}}
            {{--        document.getElementById('category_id').value = categoryId;--}}
            {{--        deleteCategoryModal.action = `{{ route('categories.destroy', '') }}/${categoryId}`;--}}
            {{--        deleteCategoryModal.style.display = 'flex';--}}
            {{--    });--}}
            {{--});--}}
            {{--<!--end process  in the delete model -->--}}

        });

    </script>
</x-app-layout>
