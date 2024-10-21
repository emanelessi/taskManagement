<x-app-layout>
    <div class="flex-col  w-full  overflow-auto scrollbar-thin">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>

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
                        <div class="flex space-x-2 px-2 addTopicBtn">
                            <img src="{{ asset('image/icon/add.svg') }}" alt="add"/>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class=" p-3 rounded-lg shadow mb-2 addTaskBtn">
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
            <form id="addTaskModal" style="display: none;" method="POST" action="{{ route('tasks.store') }}"
                  class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  mt-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Task</h2>
                    <div class="mb-4">
                        <x-input-label>Task Name:</x-input-label>
                        <x-text-input class="w-full " type="text" name="title" required></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Project Name:</x-input-label>
                        <select name="project_id"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" required>{{ $project->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Category Name:</x-input-label>
                        <select name="category_id"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" required>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select name="status_id"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" required>{{ $status->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>priority:</x-input-label>
                        <select name="priority"
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                            <option value="">Select priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Due Date:</x-input-label>
                        <x-text-input class="w-full " type="date" name="due_date" required></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>completed Date:</x-input-label>
                        <x-text-input class="w-full " type="date" name="completed_at"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Description:</x-input-label>
                        <textarea type="text" name="description"
                                  class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"></textarea>
                    </div>
                    <div class="mb-4">
                        <x-input-label>image:</x-input-label>
                        <x-text-input
                            class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"
                            type="file" name="file_path"></x-text-input>
                    </div>
                    <div class="flex justify-end  gap-4">
                        <x-danger-button type="button" id="cancelAddTask">Cancel</x-danger-button>
                        <x-primary-button>Add Task</x-primary-button>
                    </div>
                </div>
            </form>

            <form id="editTaskModal" style="display: none;" method="POST"
                  action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : '#' }}"
                  class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('PATCH')

                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-48  z-30">
                    <h2 class="text-lg font-semibold my-4">Edit Task</h2>
                    <div class="mb-4">
                        <x-input-label>Task Name:</x-input-label>
                        <x-text-input class="w-full " type="text" name="title" value="{{ $task->title ?? '' }}"
                                      required></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Project Name:</x-input-label>
                        <select name="project_id"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Project</option>
                            @foreach($projects as $project)
                                <option
                                    value="{{ $project->id }}" {{ isset($task) && $task->project_id == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Category Name:</x-input-label>
                        <select name="category_id"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}" {{ isset($task) && $task->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select name="status_id"
                                class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Status</option>
                            @foreach($statuses as $status)
                                <option
                                    value="{{ $status->id }}" {{ isset($task) && $task->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>priority:</x-input-label>
                        <select name="priority"
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                            <option value="Low" {{ isset($task) && $task->priority == 'Low' ? 'selected' : '' }}>Low
                            </option>
                            <option value="Medium" {{ isset($task) && $task->priority == 'Medium' ? 'selected' : '' }}>
                                Medium
                            </option>
                            <option value="High" {{ isset($task) && $task->priority == 'High' ? 'selected' : '' }}>
                                High
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Due Date:</x-input-label>
                        <x-text-input class="w-full" type="date" name="due_date" value="{{ $task->due_date ?? '' }}"
                                      required></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>completed Date:</x-input-label>
                        <x-text-input class="w-full" type="date" name="completed_at"
                                      value="{{ $task->completed_at ?? '' }}"></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Description:</x-input-label>
                        <textarea name="description"
                                  class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">{{ $task->description ?? '' }}</textarea>
                    </div>
                    <div class="mb-4">
                        <x-input-label>image:</x-input-label>
                        <x-text-input
                            class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"
                            type="file" name="file_path"></x-text-input>
                    </div>
                    <div class="flex justify-end  gap-4">
                        <x-danger-button type="button" id="cancelEditTask">Cancel</x-danger-button>
                        <x-primary-button>Edit Task</x-primary-button>
                    </div>
                </div>
            </form>
            <form id="deleteTaskModal" style="display: none;"
                  action="{{ isset($task) ? route('tasks.destroy', ['task' => $task->id]) : '#' }}"
                  method="POST" style="display: none;"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('DELETE')
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete <span class="font-bold"></span>?
                    </x-input-label>
                    <input type="hidden" id="task_id" name="task_id"/>

                    <div class="flex justify-end  gap-4">
                        <x-primary-button type="button" id="cancelDeleteTask">Cancel</x-primary-button>
                        <x-danger-button>Delete</x-danger-button>
                    </div>
                </div>
            </form>
            <form id="addCategoryModal" style="display: none;" method="POST" action="{{ route('categories.store') }}"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Category</h2>

                    <div class="mb-4">
                        <x-input-label>Category Name:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name" required/>
                    </div>

                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select name="status"
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                            <option value="">Select status</option>
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelAddCategory">Cancel</x-danger-button>
                        <x-primary-button type="submit">Add Category</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <!--start storing models in variables -->
            const addTopicBtns = document.querySelectorAll('.addTopicBtn');
            const addCategoryModal = document.querySelector('#addCategoryModal');
            const cancelAddCategory = document.querySelector('#cancelAddCategory');

            // const deleteTasks = document.querySelectorAll('.deleteTask');
            document.getElementById('cancelDeleteTask').addEventListener('click', () => {
                deleteTaskModal.style.display = 'none';
            });

            document.querySelectorAll('.deleteTask').forEach(deleteButton => {
                deleteButton.addEventListener('click', function () {
                    const taskId = this.getAttribute('data-id');

                    document.getElementById('task_id').value = taskId;
                    deleteTaskModal.action = `{{ route('tasks.destroy', '') }}/${taskId}`;
                    deleteTaskModal.style.display = 'flex';
                });
            });
            // const deleteTaskModal = document.querySelector('#deleteTaskModal');
            const cancelDeleteTask = document.querySelector('#cancelDeleteTask');

            const addTaskBtn = document.querySelectorAll('.addTaskBtn');
            const addTaskModal = document.querySelector('#addTaskModal');
            const cancelAddTask = document.querySelector('#cancelAddTask');

            // const editTasks = document.querySelectorAll('.editTask');
            document.querySelectorAll('.editTask').forEach(editButton => {
                editButton.addEventListener('click', function () {
                    const taskId = this.getAttribute('data-id');
                    const taskTitle = this.getAttribute('data-title');
                    const taskDescription = this.getAttribute('data-description');
                    const taskDueDate = this.getAttribute('data-due-date');
                    const taskPriority = this.getAttribute('data-priority');
                    const taskCategoryId = this.getAttribute('data-category-id');
                    const taskStatusId = this.getAttribute('data-status-id');
                    const taskProjectId = this.getAttribute('data-project-id');
                    const taskCompletedAt = this.getAttribute('data-completed-at');

                    document.querySelector('#editTaskModal [name="title"]').value = taskTitle;
                    document.querySelector('#editTaskModal [name="description"]').value = taskDescription;
                    document.querySelector('#editTaskModal [name="due_date"]').value = taskDueDate;
                    document.querySelector('#editTaskModal [name="priority"]').value = taskPriority;
                    document.querySelector('#editTaskModal [name="category_id"]').value = taskCategoryId;
                    document.querySelector('#editTaskModal [name="status_id"]').value = taskStatusId;
                    document.querySelector('#editTaskModal [name="project_id"]').value = taskProjectId;
                    document.querySelector('#editTaskModal [name="completed_at"]').value = taskCompletedAt;


                    editTaskModal.setAttribute('action', `{{ route('tasks.update', '') }}/${taskId}`);
                    editTaskModal.style.display = 'flex';
                });
            });
            // const editTaskModal = document.querySelector('#editTaskModal');
            const cancelEditTask = document.querySelector('#cancelEditTask');

            // فتح وإغلاق المودال لإضافة موضوع
            addTopicBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (addCategoryModal) {
                        addCategoryModal.style.display = 'flex';
                    }
                });
            });

            if (cancelAddCategory) {
                cancelAddCategory.addEventListener('click', () => {
                    if (addCategoryModal) {
                        addCategoryModal.style.display = 'none';
                    }
                });
            }

            // فتح وإغلاق المودال لإضافة مهمة
            addTaskBtn.forEach(btn => {
                btn.addEventListener('click', () => {
                    if (addTaskModal) {
                        addTaskModal.style.display = 'flex';
                    }
                });
            });

            if (cancelAddTask) {
                cancelAddTask.addEventListener('click', () => {
                    if (addTaskModal) {
                        addTaskModal.style.display = 'none';
                    }
                });
            }

            // فتح وإغلاق المودال لحذف مهمة
            // deleteTasks.forEach(btn => {
            //     btn.addEventListener('click', () => {
            //         if (deleteTaskModal) {
            //             deleteTaskModal.style.display = 'flex';
            //         }
            //     });
            // });

            if (cancelDeleteTask) {
                cancelDeleteTask.addEventListener('click', () => {
                    if (deleteTaskModal) {
                        deleteTaskModal.style.display = 'none';
                    }
                });
            }

            // فتح وإغلاق المودال لتعديل مهمة
            // editTasks.forEach(btn => {
            //     btn.addEventListener('click', () => {
            //         if (editTaskModal) {
            //             editTaskModal.style.display = 'flex';
            //         }
            //     });
            // });

            if (cancelEditTask) {
                cancelEditTask.addEventListener('click', () => {
                    if (editTaskModal) {
                        editTaskModal.style.display = 'none';
                    }
                });
            }
        });

    </script>
</x-app-layout>
