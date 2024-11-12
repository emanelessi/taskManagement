<form id="addCategoryModal" style="display: none;" method="POST" action="{{ route('categories.store') }}"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    @csrf
    <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 my-14 z-30">
        <h2 class="text-lg font-semibold mb-4">Add New Category</h2>

        <div class="mb-4">
            <x-input-label required>Category Name:</x-input-label>
            <x-text-input class="w-full" type="text" name="name" required/>
        </div>

        <div class="mb-4">
            <x-input-label required>Status:</x-input-label>
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



<script>
    document.addEventListener('DOMContentLoaded', () => {
        <!--start storing models in variables -->
        const addCategoryBtn = document.querySelectorAll('.addCategoryBtn');
        const addCategoryModal = document.querySelector('#addCategoryModal');
        const cancelAddCategory = document.querySelector('#cancelAddCategory');

        // فتح وإغلاق المودال لإضافة موضوع
        addCategoryBtn.forEach(btn => {
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


    });

</script>
