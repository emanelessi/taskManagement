@props(['projects', 'categories', 'statuses'])

<form id="addTaskModal"   style="display: none;" method="POST" action="{{ route('tasks.store') }}"
      class=" fixed inset-0 overflow-auto flex items-center justify-center bg-black bg-opacity-50">
    @csrf
    <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-48  z-30">
        <h2 class="text-lg font-semibold mb-4">Add New Task</h2>
        <input type="hidden" id="category-id-input" name="category_id">
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
                    <option value="{{ $project->id }}" >{{ $project->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <x-input-label>Category Name:</x-input-label>
            <select id="category-select" name="category_id" class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addTaskBtns = document.querySelectorAll('.addTaskBtn');
        const addTaskModal = document.querySelector('#addTaskModal');
        const cancelAddTask = document.querySelector('#cancelAddTask');
        const categorySelect = document.querySelector('#category-select');

        addTaskBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const categoryId = btn.getAttribute('data-category-id');
                if (categoryId) {
                    categorySelect.value = categoryId;
                } else {
                    categorySelect.value = '';
                }
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
