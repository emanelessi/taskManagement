<x-app-layout>
    <div class="flex-1 overflow-auto">
        <!-- start the alert -->
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <!-- end the alert -->

        <div class="md:flex justify-between">
            <div class="mb-4">
                @can('create tasks')
                <x-primary-button class="addTaskBtn">
                    + Add New Task
                </x-primary-button>
                @endcan
            </div>
            <div class="mb-4 md:w-4/12">
                <form id="searchForm" method="GET" action="{{ route('tasks') }}">
                    <div class="relative w-full">
                        <input type="text" name="search" id="searchInput" placeholder="Search" value="{{ request('search') }}"
                               class="text-sm border border-secondary w-full bg-primary rounded-md"
                               oninput="handleSearchInput()">
                        <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-tertiary rounded-e-lg">
                            <img src="{{ asset('image/icon/search.svg') }}" alt="search" class="w-4 h-4">
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <!-- start the table -->
        <div class="overflow-x-auto shadow-md rounded-lg">
            @php
                $headers = ['Task Title',  'priority', 'Start Date','Completed Date', 'category', 'Status','project',
                  'Assigned To', 'Actions'];
                $rows = [];
                foreach ($tasks as $task) {
                    $rows[] = [
                       auth()->user()->can('view task details', $task)
                            ? '<a href="' . route('tasks.details', $task->id) . '" class="text-blue-600 hover:underline">' . $task->title . '</a>'
                            : '<span class="text-gray-500">' . $task->title . '</span>',
                         $task->priority,
                        $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '-',
                        $task->completed_at ? \Carbon\Carbon::parse($task->completed_at)->format('Y-m-d') : '-',
                      $task->category->name ?? '-',
                        $task->status->name ?? '-',
                        $task->project->name ?? '-',
                        $task->user->name ?? '-',
                        (auth()->user()->can('edit tasks', $task)
                            ? '<a href="#" class="text-tertiary hover:text-tertiary editTask"
                            data-id="' . $task->id . '"
                          data-title="' . $task->title . '"
                            data-description="' . $task->description . '"
                            data-due-date="' . $task->due_date . '"
                            data-priority="' . $task->priority . '"
                          data-category-id="' . optional($task->category)->id . '"
        data-status-id="' . optional($task->status)->id . '"
        data-assigned-to="' . optional($task->user)->id . '"
        data-project-id="' . optional($task->project)->id . '"
                            data-completed-at="' . $task->completed_at . '" >Edit</a>'
                              : '') .
                                (auth()->user()->can('delete tasks', $task)
                            ? '
                         <a href="#" class="text-red-600 hover:text-red-900 ml-4  deleteTask" data-id="' . $task->id . '">Delete</a>'
                            : ''),
                    ];
                }
            @endphp
            <x-static-table :headers="$headers" :rows="$rows"/>
            <!-- end the table -->
            <div class="mt-4">
                {{  $tasks->links() }}
            </div>
            <x-add-task-form :projects="$projects" :categories="$categories" :statuses="$statuses" />

            <x-edit-task-form :task="$task" :projects="$projects" :categories="$categories" :statuses="$statuses" />
            <x-delete-task-form :task="$task" />
        </div>
    </div>

    <script>
        function handleSearchInput() {
            const query = document.getElementById('searchInput').value;
            if (query === '') {
                window.location.href = "{{ route('tasks') }}";
            } else {
                fetch(`/tasks?search=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.table-container').innerHTML = html;
                    });
            }
        }
    </script>

</x-app-layout>
