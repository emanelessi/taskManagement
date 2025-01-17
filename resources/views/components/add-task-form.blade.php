@props(['projects', 'categories', 'statuses'])

<form id="addTaskModal" enctype="multipart/form-data" style="display: none;" method="POST" action="{{ route('tasks.store') }}"
      class="fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
    @csrf
    <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
        <h2 class="text-lg font-semibold mb-4">Add New Task</h2>

        <div class="mb-4">
            <x-input-label required>Task Name:</x-input-label>
            <x-text-input class="w-full" type="text" name="title" required></x-text-input>
        </div>

        <div class="mb-4">
            <x-input-label required>Project Name:</x-input-label>
            <select name="project_id" id="project-select"
                    class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                <option value="">Select Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <x-input-label required>Category Name:</x-input-label>
            <select id="category-select" name="category_id"
                    class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <x-input-label required>Status:</x-input-label>
            <select name="status_id"
                    class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                <option value="">Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <x-input-label required>Priority:</x-input-label>
            <select name="priority" required
                    class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" >
                <option value="">Select Priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="mb-4">
            <x-input-label required>Due Date:</x-input-label>
            <x-text-input class="w-full" type="date" name="due_date" required></x-text-input>
        </div>

        <div class="mb-4">
            <x-input-label>Completed Date:</x-input-label>
            <x-text-input class="w-full" type="date" name="completed_at"></x-text-input>
        </div>

        <div class="mb-4">
            <x-input-label>Description:</x-input-label>
            <textarea type="text" name="description"
                      class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary"></textarea>
        </div>

        <div class="mb-4">
            <x-input-label>Image: </x-input-label>
            <x-text-input class="w-full p-2 border px-3 py-2 mt-2 text-sm border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary file:rounded-full   file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none "
                          type="file" name="attachments[]" id="attachments" multiple></x-text-input>
        </div>

        <div class="flex justify-end gap-4">
            <x-danger-button type="button" id="cancelAddTask">Cancel</x-danger-button>
            <x-primary-button>Add Task</x-primary-button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addTaskBtns = document.querySelectorAll('.addTaskBtn');
        const addTaskModal = document.querySelector('#addTaskModal');
        const cancelAddTask = document.querySelector('#cancelAddTask');
        const projectSelect = document.querySelector('#project-select');
        const categorySelect = document.querySelector('#category-select');

        addTaskBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const projectId = btn.getAttribute('data-project-id');
                const categoryId = btn.getAttribute('data-category-id');

                projectSelect.value = projectId || '';
                categorySelect.value = categoryId || '';
                addTaskModal.style.display = 'flex';
            });
        });

        if (cancelAddTask) {
            cancelAddTask.addEventListener('click', () => {
                addTaskModal.style.display = 'none';
            });
        }
    });
</script>

