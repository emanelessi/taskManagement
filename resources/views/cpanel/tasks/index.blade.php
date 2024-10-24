<x-app-layout>
    <div class="flex-1 overflow-auto">
        <!-- start the alert -->
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <!-- end the alert -->

        <div class="md:flex justify-between">
            <div class="mb-4">
                <x-primary-button class="addTaskBtn">
                    + Add New Task
                </x-primary-button>
            </div>
            <div class="mb-4 md:w-4/12">
                <form>
                    <div class="relative w-full">
                        <x-text-input type="text" placeholder="Search "
                                      class="text-sm border border-secondary w-full bg-primary rounded-md "/>
                        <x-primary-button type="submit"
                                          class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-tertiary rounded-e-lg ">
                            <img src="{{ asset('image/icon/search.svg') }}" alt="search" class="w-4 h-4"/>
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <!-- start the table -->
        <div class="overflow-x-auto shadow-md rounded-lg">
            @php
                $headers = ['Task Title',  'priority', 'Start Date','Completed Date', 'category', 'Status','project',
                  'Created By', 'Actions'];
                $rows = [];
                foreach ($tasks as $task) {
                    $rows[] = [
                        ' <a href="' . route('tasks.details', $task->id) . '" class="text-blue-600 hover:underline">' . $task->title . '</a>',
                         $task->priority,
                          \Carbon\Carbon::parse($task->due_date)->format('Y-m-d'),
                        \Carbon\Carbon::parse($task->completed_at)->format('Y-m-d'),
                      $task->category->name ?? '-',
                        $task->status->name ?? '-',
                        $task->project->name ?? '-',
                        $task->user->name ?? '-',
                        '<a href="#" class="text-tertiary hover:text-tertiary editTask"
                            data-id="' . $task->id . '"
                          data-title="' . $task->title . '"
                            data-description="' . $task->description . '"
                            data-due-date="' . $task->due_date . '"
                            data-priority="' . $task->priority . '"
                          data-category-id="' . optional($task->category)->id . '"
        data-status-id="' . optional($task->status)->id . '"
        data-assigned-to="' . optional($task->user)->id . '"
        data-project-id="' . optional($task->project)->id . '"
                            data-completed-at="' . $task->completed_at . '" >Edit</a>
                         <a href="#" class="text-red-600 hover:text-red-900 ml-4  deleteTask" data-id="' . $task->id . '">Delete</a>',
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


</x-app-layout>
