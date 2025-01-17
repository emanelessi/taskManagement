<form id="addCategoryModal" style="display: none;" method="POST" action="{{ route('categories.store') }}"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    @csrf
    <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 my-14 z-30">
        <h2 class="text-lg font-semibold mb-4">{{ __('add_new_category') }}</h2>

        <div class="mb-4">
            <x-input-label required>{{ __('category_name') }}</x-input-label>
            <x-text-input class="w-full" type="text" name="name" required/>
        </div>

        <div class="mb-4">
            <x-input-label required>{{ __('select_status') }}</x-input-label>
            <select name="status"
                    class="w-full border-black/30 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    required>
                <option value="">{{ __('select_status') }}</option>
                <option value="enable">{{ __('enable') }}</option>
                <option value="disable">{{ __('disable') }}</option>
            </select>
        </div>

        <div class="flex justify-end gap-4">
            <x-danger-button type="button" id="cancelAddCategory">{{ __('cancel') }}</x-danger-button>
            <x-primary-button type="submit">{{ __('add_category') }}</x-primary-button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const addCategoryBtn = document.querySelectorAll('.addCategoryBtn');
        const addCategoryModal = document.querySelector('#addCategoryModal');
        const cancelAddCategory = document.querySelector('#cancelAddCategory');

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
