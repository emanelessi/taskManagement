<x-app-layout>
    <div class="flex-1 overflow-auto">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>

        <div class="md:flex justify-between">
            <div class="mb-4">
                @can('create categories')
                    <x-primary-button class="addCategoryBtn">
                        {{ __('+ Add New Category') }}
                    </x-primary-button>
                @endcan
            </div>

            <div class="mb-4 md:w-4/12">
                <form id="searchForm" method="GET" action="{{ route('categories') }}">
                    <div class="relative w-full">
                        <input type="text" name="search" id="searchInput" placeholder="{{ __('Search') }}"
                               value="{{ request('search') }}"
                               class="text-sm border border-black w-full  bg-background rounded-md"
                               oninput="handleSearchInput()">
                        <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-text bg-button rounded-e-lg">
                            <img src="{{ asset('image/icon/search.svg') }}" alt="{{ __('search') }}" class="w-4 h-4">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto  shadow-md rounded-lg">
            @php
                $headers = [__('Category Name'), __('Status'), __('ADD Date'), __('Actions')];
                $rows = [];
                foreach ($categories as $category) {
                    $rows[] = [
                        $category->name,
                        $category->status,
                        \Carbon\Carbon::parse($category->created_at)->format('Y-m-d'),
                         (auth()->user()->can('edit categories', $category)
                            ? '<a href="#" class="text-hover   edit-category" data-id="' . $category->id . '"   data-name="' . $category->name . '"
                            data-status="' . $category->status . '"
                         >' . __('Edit') . '</a>'
                            : '') .
                         (auth()->user()->can('delete categories', $category)
                            ? '<a href="#" class="text-red-600 hover:text-red-900 mx-4 delete-category" data-id="' . $category->id . '">' . __('Delete') . '</a>'
                            : ''),
                    ];
                }
            @endphp

            <x-static-table :headers="$headers" :rows="$rows"/>
            <div class="mt-4">
                {{  $categories->links() }}
            </div>
            <form id="editCategoryModal"
                  action="{{ isset($category) ? route('categories.update', ['category' => $category->id]) : '#' }}"
                  style="display: none;" method="POST"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('PATCH')
                <div class="bg-background p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16  z-30">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Edit Category') }}</h2>
                    <div class="mb-4">
                        <x-input-label required>{{ __('Category Name:') }}</x-input-label>
                        <x-text-input class="w-full" type="text" name="name"
                                      id="editCategoryName" value="{{ $category->name ?? '' }}"
                                      required/>
                    </div>

                    <div class="mb-4">
                        <x-input-label required>{{ __('Status:') }}</x-input-label>
                        <select name="status" id="editCategoryStatus"
                                class="w-full border-black  focus:border-indigo-500  focus:ring-indigo-500   rounded-md shadow-sm"
                                required>
                            <option value="">{{ __('Select status') }}</option>
                            <option value="enable" {{ isset($category->status) && $category->status == 'enable' ? 'selected' : '' }}>{{ __('Enable') }}</option>
                            <option value="disable" {{ isset($category->status) && $category->status == 'disable' ? 'selected' : '' }}>{{ __('Disable') }}</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelEditCategory">{{ __('Cancel') }}</x-danger-button>
                        <x-primary-button type="submit">{{ __('Edit Category') }}</x-primary-button>
                    </div>
                </div>
            </form>

            <form id="deleteCategoryModal"
                  action="{{ isset($category) ? route('categories.destroy', ['category' => $category->id]) : '#' }}"
                  method="POST" style="display: none;"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('DELETE')

                <div class="bg-background p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Confirm Deletion') }}</h2>
                    <x-input-label class="text-xl">{{ __('Are you sure you want to delete') }} <span id="deleteCategoryName" class="font-bold"></span>?</x-input-label>
                    <input type="hidden" name="category_id" id="category_id">

                    <div class="flex justify-end gap-2">
                        <x-primary-button type="button" id="cancelDeleteCategory">{{ __('Cancel') }}</x-primary-button>
                        <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                    </div>
                </div>
            </form>

            <x-add-category-form/>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editCategoryModal = document.getElementById('editCategoryModal');
            const deleteCategoryModal = document.getElementById('deleteCategoryModal');


            document.getElementById('cancelEditCategory').addEventListener('click', () => {
                editCategoryModal.style.display = 'none';
            });

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

        });

        function handleSearchInput() {
            const query = document.getElementById('searchInput').value;
            if (query === '') {
                window.location.href = "{{ route('categories') }}";
            } else {
                fetch(`/categories?search=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.table-container').innerHTML = html;
                    });
            }
        }
    </script>

</x-app-layout>
