@props(['projects', 'categories', 'statuses'])

<form id="deleteTaskModal" style="display: none;"
      action="{{ isset($task) ? route('tasks.destroy', ['task' => $task->id]) : '#' }}"
      method="POST" style="display: none;"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    @csrf
    @method('DELETE')
    <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
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


<script>
    document.addEventListener('DOMContentLoaded', () => {


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
        const cancelDeleteTask = document.querySelector('#cancelDeleteTask');
        if (cancelDeleteTask) {
            cancelDeleteTask.addEventListener('click', () => {
                if (deleteTaskModal) {
                    deleteTaskModal.style.display = 'none';
                }
            });
        }

    });

</script>
