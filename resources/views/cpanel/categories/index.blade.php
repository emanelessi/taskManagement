<x-app-layout>
    <div class="flex-1 overflow-auto">
        <!-- start the alert -->
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <!-- end the alert -->

        <div class="md:flex justify-between">
            <div class="mb-4">
                <x-primary-button class="addCategoryBtn">
                    + Add New Category
                </x-primary-button>
            </div>

            <div class="mb-4 md:w-4/12">
                <form>
                    <div class="relative w-full">
                        <x-text-input type="text" placeholder="Search"
                                      class="text-sm border border-secondary w-full bg-primary rounded-md "/>
                        <x-primary-button type="submit"
                                          class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-tertiary rounded-e-lg ">
                            <img src="{{ asset('image/icon/search.svg ') }}" alt="search" class="w-4 h-4"/>
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- start the table -->
        <div class="overflow-x-auto  shadow-md rounded-lg">
            @php
                $headers = ['Category Name', 'Status', 'ADD Date', 'Actions'];
                $rows = [];
                foreach ($categories as $category) {
                    $rows[] = [
                        $category->name,
                        $category->status,
                        \Carbon\Carbon::parse($category->created_at)->format('Y-m-d'),
                        '<a href="#" class="text-tertiary hover:text-tertiary edit-category" data-id="' . $category->id . '"   data-name="' . $category->name . '"
                            data-status="' . $category->status . '"
                         >Edit</a>
                         <a href="#" class="text-red-600 hover:text-red-900 ml-4 delete-category" data-id="' . $category->id . '">Delete</a>',
                    ];
                }
            @endphp

            <x-static-table :headers="$headers" :rows="$rows"/>
            <!-- end the table -->
            <div class="mt-4">
                {{  $categories->links() }}
            </div>
            <!-- start the edit modal -->
            <form id="editCategoryModal"
                  action="{{ isset($category) ? route('categories.update', ['category' => $category->id]) : '#' }}"
                  style="display: none;" method="POST"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('PATCH')
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-48  z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Category</h2>
                    <div class="mb-4">
                        <x-input-label>Category Name:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name"
                                      id="editCategoryName" value="{{ $category->name ?? '' }}"
                                      required/>
                    </div>

                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select name="status" id="editCategoryStatus"
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                            <option value="">Select status</option>
                            <option value="enable" {{ $category->status == 'enable' ? 'selected' : '' }}>Enable</option>
                            <option value="disable" {{ $category->status == 'disable' ? 'selected' : '' }}>Disable
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelEditCategory">Cancel</x-danger-button>
                        <x-primary-button type="submit">Edit Category</x-primary-button>
                    </div>
                </div>
            </form>
            <!-- end the edit modal -->

            <!-- start the delete modal -->
            <form id="deleteCategoryModal"
                  action="{{ isset($category) ? route('categories.destroy', ['category' => $category->id]) : '#' }}"
                  method="POST" style="display: none;"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('DELETE')

                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  my-14 z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete<span id="deleteCategoryName"
                                                                                        class="font-bold"></span>?
                    </x-input-label>
                    <input type="hidden" name="category_id" id="category_id">

                    <div class="flex justify-end gap-2">
                        <x-primary-button type="button" id="cancelDeleteCategory">Cancel</x-primary-button>
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </div>
                </div>
            </form>
            <!-- end the delete modal -->

            <!-- start the add modal -->
            <x-add-category-form/>
            <!-- end the add modal -->

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <!--start storing models in variables -->
            const editCategoryModal = document.getElementById('editCategoryModal');
            const deleteCategoryModal = document.getElementById('deleteCategoryModal');
            <!--end storing models in variables -->


            document.getElementById('cancelEditCategory').addEventListener('click', () => {
                editCategoryModal.style.display = 'none';
            });
            <!--end open and close the model -->

            <!--start storing data in the model -->
            document.querySelectorAll('.edit-category').forEach(editButton => {
                editButton.addEventListener('click', function () {
                    const categoryId = this.dataset.id;
                    const categoryName = this.dataset.name;
                    const categoryStatus = this.dataset.status;

                    document.querySelector('input[name="name"]').value = categoryName;
                    document.querySelector('select[name="status"]').value = categoryStatus;


                    editCategoryModal.setAttribute('action', `{{ route('categories.update', '') }}/${categoryId}`);
                    editCategoryModal.style.display = 'flex';
                });
            });
            <!--end storing data in the model -->

            <!--start process  in the delete model -->
            document.getElementById('cancelDeleteCategory').addEventListener('click', () => {
                deleteCategoryModal.style.display = 'none';
            });

            document.querySelectorAll('.delete-category').forEach(deleteButton => {
                deleteButton.addEventListener('click', function () {
                    const categoryId = this.dataset.id;
                    document.getElementById('category_id').value = categoryId;
                    deleteCategoryModal.action = `{{ route('categories.destroy', '') }}/${categoryId}`;
                    deleteCategoryModal.style.display = 'flex';
                });
            });
            <!--end process  in the delete model -->

        });

    </script>

</x-app-layout>
