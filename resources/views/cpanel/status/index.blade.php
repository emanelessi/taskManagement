<x-app-layout>
    <div class="flex-1 overflow-auto">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <div class="md:flex justify-between">
            <div class="mb-4">
                @can('create statuses')
                    <x-primary-button id="addStatusBtn">
                        + Add New Status
                    </x-primary-button>
                @endcan

            </div>
            <div class="mb-4 md:w-4/12">
                <form id="searchForm" method="GET" action="{{ route('status') }}">
                    <div class="relative w-full">
                        <input type="text" name="search" id="searchInput" placeholder="Search"
                               value="{{ request('search') }}"
                               class="text-sm border border-black w-full bg-background rounded-md"
                               oninput="handleSearchInput()">
                        <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-text bg-tertiary rounded-e-lg">
                            <img src="{{ asset('image/icon/search.svg') }}" alt="search" class="w-4 h-4">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto  shadow-md rounded-lg">
            @php
                $headers = ['Status Name', 'Status', 'ADD Date', 'Actions'];
                $rows = [];
                foreach ($statuses as $status) {
                    $rows[] = [
                        $status->name,
                        $status->status,
                        \Carbon\Carbon::parse($status->created_at)->format('Y-m-d'),
                          (auth()->user()->can('edit statuses', $status)
                            ? '<a href="#" class="text-tertiary hover:text-tertiary edit-status" data-id="' . $status->id . '"   data-name="' . $status->name . '"
                            data-status="' . $status->status . '">Edit</a>'
                            : '') .
                            (auth()->user()->can('delete statuses', $status)
                            ? '<a href="#" class="text-red-600 hover:text-red-900 ml-4 delete-status" data-id="' . $status->id . '">Delete</a>'
                            : ''), ];
                }
            @endphp

            <x-static-table :headers="$headers" :rows="$rows"/>
            <div class="mt-4">
                {{  $statuses->links() }}
            </div>
            <form id="editStatusModal"
                  action="{{ isset($status) ? route('status.update', ['status' => $status->id]) : '#' }}"
                  style="display: none;" method="POST"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('PATCH')
                <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-48  z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Status</h2>
                    <div class="mb-4">
                        <x-input-label required>Status Name:</x-input-label>
                        <x-text-input class="w-full " type="text" name="name"
                                      id="editStatusName" value="{{ $status->name ?? '' }}"
                                      required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Status:</x-input-label>
                        <select name="status" id="editStatus"
                                class="w-full border-black    focus:border-indigo-500  focus:ring-indigo-500   rounded-md shadow-sm">
                            <option value="">Select status</option>
                            <option value="enable" {{ isset($status->status) && $status->status == 'enable' ? 'selected' : '' }}>Enable</option>
                            <option value="disable" {{ isset($status->status) && $status->status == 'disable' ? 'selected' : '' }}>Disable</option>
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelEditStatus">Cancel</x-danger-button>
                        <x-primary-button type="submit">Edit Status</x-primary-button>

                    </div>
                </div>
            </form>
            <form id="deleteStatusModal"
                  action="{{ isset($status) ? route('status.destroy', ['status' => $status->id]) : '#' }}"
                  method="POST" style="display: none;"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('DELETE')
                <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete <span class="font-bold"></span>?
                    </x-input-label>

                    <input type="hidden" name="status_id" id="status_id">

                    <div class="flex justify-end gap-2">
                        <x-primary-button type="button" id="cancelDeleteStatus">Cancel</x-primary-button>
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </div>
                </div>
            </form>
            <form id="addStatusModal" method="POST" action="{{ route('status.store') }}"
                  class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-48  z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Status</h2>

                    <div class="mb-4">
                        <x-input-label required> Status Name:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name" required/>
                    </div>

                    <div class="mb-4">
                        <x-input-label required>Status:</x-input-label>
                        <select name="status"
                                class="w-full border-black focus:border-indigo-500  focus:ring-indigo-500   rounded-md shadow-sm"
                                required>
                            <option value="">Select status</option>
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelAddStatus">Cancel</x-danger-button>
                        <x-primary-button type="submit">Add Status</x-primary-button>
                    </div>
                </div>
            </form>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const addStatusModal = document.getElementById('addStatusModal');
            const editStatusModal = document.getElementById('editStatusModal');
            const deleteStatusModal = document.getElementById('deleteStatusModal');

            const addStatusBtn = document.getElementById('addStatusBtn');
            if (addStatusBtn) {
                addStatusBtn.addEventListener('click', () => {
                    addStatusModal.classList.remove('hidden');
                });
            }

            document.getElementById('cancelAddStatus').addEventListener('click', () => {
                addStatusModal.classList.add('hidden');
            });

            document.getElementById('cancelEditStatus').addEventListener('click', () => {
                editStatusModal.style.display = 'none';
            });

            document.querySelectorAll('.edit-status').forEach(editButton => {
                editButton.addEventListener('click', function () {
                    const statusId = this.dataset.id;
                    const statusName = this.dataset.name;
                    const statusStatus = this.dataset.status;

                    document.querySelector('input[name="name"]').value = statusName;
                    document.querySelector('select[name="status"]').value = statusStatus;

                    editStatusModal.setAttribute('action', `{{ route('status.update', '') }}/${statusId}`);
                    editStatusModal.style.display = 'flex';
                });
            });

            document.getElementById('cancelDeleteStatus').addEventListener('click', () => {
                deleteStatusModal.style.display = 'none';
            });

            document.querySelectorAll('.delete-status').forEach(deleteButton => {
                deleteButton.addEventListener('click', function () {
                    const statusId = this.dataset.id;
                    document.getElementById('status_id').value = statusId;
                    deleteStatusModal.action = `{{ route('status.destroy', '') }}/${statusId}`;
                    deleteStatusModal.style.display = 'flex';
                });
            });
        });
        function handleSearchInput() {
            const query = document.getElementById('searchInput').value;
            if (query === '') {
                window.location.href = "{{ route('status') }}";
            } else {
                fetch(`/status?search=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.table-container').innerHTML = html;
                    });
            }
        }
    </script>

</x-app-layout>
