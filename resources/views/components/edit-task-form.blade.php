@props(['projects','task', 'categories', 'statuses'])

<form id="editTaskModal" style="display: none;" method="POST" enctype="multipart/form-data"
      action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : '#' }}"
      class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
    @csrf
    @method('PATCH')

    <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
        <h2 class="text-lg font-semibold my-4">{{ __('Edit Task') }}</h2>
        <div class="mb-4">
            <x-input-label>{{ __('Task Name:') }}</x-input-label>
            <x-text-input class="w-full " type="text" name="title" value="{{ $task->title ?? '' }}"
                          required></x-text-input>
        </div>
        <div class="mb-4">
            <x-input-label required>{{ __('Project Name:') }}</x-input-label>
            <select name="project_id"
                    class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                <option value="">{{ __('Select Project') }}</option>
                @foreach($projects as $project)
                    <option
                        value="{{ $project->id }}" {{ isset($task) && $task->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <x-input-label required>{{ __('Category Name:') }}</x-input-label>
            <select name="category_id"
                    class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                <option value="">{{ __('Select Category') }}</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}" {{ isset($task) && $task->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <x-input-label required>{{ __('Status:') }}</x-input-label>
            <select name="status_id"
                    class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                <option value="">{{ __('Select Status') }}</option>
                @foreach($statuses as $status)
                    <option
                        value="{{ $status->id }}" {{ isset($task) && $task->status_id == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <x-input-label required>{{ __('Priority:') }}</x-input-label>
            <select name="priority" required
                    class="w-full border-black/30  focus:border-indigo-500   focus:ring-indigo-500   rounded-md shadow-sm"
            >
                <option value="Low" {{ isset($task) && $task->priority == 'Low' ? 'selected' : '' }}>{{ __('Low') }}</option>
                <option value="Medium" {{ isset($task) && $task->priority == 'Medium' ? 'selected' : '' }}>
                    {{ __('Medium') }}
                </option>
                <option value="High" {{ isset($task) && $task->priority == 'High' ? 'selected' : '' }}>
                    {{ __('High') }}
                </option>
            </select>
        </div>
        <div class="mb-4">
            <x-input-label required>{{ __('Due Date:') }}</x-input-label>
            <x-text-input class="w-full" type="date" name="due_date" value=" {{ isset($task->due_date) ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}"
                          required></x-text-input>
        </div>
        <div class="mb-4">
            <x-input-label>{{ __('Completed Date:') }}</x-input-label>
            <x-text-input class="w-full" type="date" name="completed_at"
                          value="{{ isset($task->completed_at) ? \Carbon\Carbon::parse($task->completed_at)->format('Y-m-d') : '' }}"></x-text-input>
        </div>
        <div class="mb-4">
            <x-input-label>{{ __('Description:') }}</x-input-label>
            <textarea name="description"
                      class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">{{ $task->description ?? '' }}</textarea>
        </div>
        <div class="mb-4">
            <x-input-label>{{ __('Image:') }}</x-input-label>
            <x-text-input class="w-full p-2 border px-3 py-2 mt-2 text-sm border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary file:rounded-full   file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none "
                          type="file" name="attachments[]" id="attachments" multiple></x-text-input>
        </div>
        <div class="flex justify-end  gap-4">
            <x-danger-button type="button" id="cancelEditTask">{{ __('Cancel') }}</x-danger-button>
            <x-primary-button>{{ __('Edit Task') }}</x-primary-button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelectorAll('.editTask').forEach(editButton => {
            editButton.addEventListener('click', function () {
                const taskId = this.getAttribute('data-id');
                const taskTitle = this.getAttribute('data-title');
                const taskDescription = this.getAttribute('data-description');
                const taskPriority = this.getAttribute('data-priority');
                const taskCategoryId = this.getAttribute('data-category-id');
                const taskStatusId = this.getAttribute('data-status-id');
                const taskProjectId = this.getAttribute('data-project-id');
                const dueDateValue = this.getAttribute('data-due-date');
                const taskDueDate = dueDateValue ? new Date(dueDateValue).toLocaleDateString('en-CA') : '';

                // Validate and convert 'data-completed-at'
                const completedAtValue = this.getAttribute('data-completed-at');
                const taskCompletedAt = completedAtValue ? new Date(completedAtValue).toLocaleDateString('en-CA') : '';

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

        const cancelEditTask = document.querySelector('#cancelEditTask');
        if (cancelEditTask) {
            cancelEditTask.addEventListener('click', () => {
                if (editTaskModal) {
                    editTaskModal.style.display = 'none';
                }
            });
        }
    });
</script>
