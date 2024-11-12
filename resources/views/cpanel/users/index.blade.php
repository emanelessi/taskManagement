<x-app-layout>
    <div class="flex-1 overflow-auto">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <div class="md:flex justify-between">
            <div class="mb-4">
                @can('create users')
                    <x-primary-button id="addUserBtn">
                        + Add New User
                    </x-primary-button>
                @endcan
            </div>
            <div class="mb-4 md:w-4/12">
                <form id="searchForm" method="GET" action="{{ route('users') }}">
                    <div class="relative w-full">
                        <input type="text" name="search" id="searchInput" placeholder="Search"
                               value="{{ request('search') }}"
                               oninput="handleSearchInput()"
                               class="text-sm border border-secondary w-full bg-primary rounded-md">
                        <button type="submit" id="searchButton"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-tertiary rounded-e-lg">
                            <img src="{{ asset('image/icon/search.svg') }}" alt="search" class="w-4 h-4">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto shadow-md rounded-lg">

            @php
                $headers = ['User Name', 'Email', 'Role', 'ADD Date', 'Actions'];
                $rows = [];
                foreach ($users as $user) {
                    $rows[] = [
                        $user->name,
                        $user->email,
                       $user->roles->isNotEmpty() ? $user->roles->first()->name : '-',
                        \Carbon\Carbon::parse($user->created_at)->format('Y-m-d'),
                        (auth()->user()->can('edit users', $user)
                            ? '<a href="#" class="text-tertiary hover:text-tertiary edit-user" data-id="' . $user->id . '" data-name="' . $user->name . '" data-email="' . $user->email . '" data-role-id="' . ($user->roles->isNotEmpty() ? $user->roles->first()->id : '')  . '">Edit</a>'
                            : '') .
                        (auth()->user()->can('delete users', $user)
                            ? '<a href="#" class="text-red-600 hover:text-red-900 ml-4 delete-user" data-id="' . $user->id . '">Delete</a>'
                            : ''),
                    ];
                }
            @endphp
            <x-static-table :headers="$headers" :rows="$rows"/>

            <div class="mt-4">
                {{ $users->links() }}
            </div>

            <form id="editUserModal"
                  action="{{ isset($user) ? route('users.update', ['user' => $user->id]) : '#' }}"
                  style="display: none;" method="POST"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('PATCH')
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12   z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit User</h2>
                    <div class="mb-4">
                        <x-input-label required>User Name:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name"
                                      id="editUserName" value="{{ $user->name ?? '' }}"
                                      required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Email:</x-input-label>
                        <x-text-input class="w-full" type="email" name="email"
                                      id="editEmail" value="{{ $user->email ?? '' }}"
                                      required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Password:</x-input-label>
                        <x-text-input class="w-full" class="w-full" type="password" name="password" id="editPassword"
                        />
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Role:</x-input-label>
                        <select name="roles[]" id="editRole" id="editRole" required
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        >
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}" {{ (isset($user) && $user->roles->contains($role->id)) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelEditUser">Cancel</x-danger-button>
                        <x-primary-button type="submit">Edit User</x-primary-button>
                    </div>
                </div>
            </form>

            <form id="deleteUserModal"
                  action="{{ isset($user) ? route('users.destroy', ['user' => $user->id]) : '#' }}"
                  method="POST" style="display: none;"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('DELETE')
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete <span class="font-bold"></span>?
                    </x-input-label>
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="flex justify-end gap-2">
                        <x-primary-button type="button" id="cancelDeleteUser">Cancel</x-primary-button>
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </div>
                </div>
            </form>

            <!-- Modal for Add User -->
            <form id="addUserModal" method="POST" action="{{ route('users.store') }}"
                  class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New User</h2>
                    <div class="mb-4">
                        <x-input-label required>User Name:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name" required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Email:</x-input-label>
                        <x-text-input class="w-full" type="email" name="email" required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Password:</x-input-label>
                        <x-text-input class="w-full" type="password" name="password" required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Role:</x-input-label>
                        <select name="roles[]" id="addUserRoles" required
                                class="w-full border-black/30 dark:border-black/70 dark:bg-black/90 dark:text-black/30 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        >
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelAddUser">Cancel</x-danger-button>
                        <x-primary-button type="submit">Add User</x-primary-button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addUserModal = document.getElementById('addUserModal');
            const editUserModal = document.getElementById('editUserModal');
            const deleteUserModal = document.getElementById('deleteUserModal');

            const addUserBtn = document.getElementById('addUserBtn');
            if (addUserBtn) {
                addUserBtn.addEventListener('click', () => {
                    addUserModal.classList.remove('hidden');
                });
            }

            document.getElementById('cancelAddUser').addEventListener('click', () => {
                addUserModal.classList.add('hidden');
            });

            document.getElementById('cancelEditUser').addEventListener('click', () => {
                editUserModal.style.display = 'none';
            });

            document.querySelectorAll('.edit-user').forEach(editButton => {
                editButton.addEventListener('click', function () {
                    const userId = this.dataset.id;
                    const userName = this.dataset.name;
                    const userEmail = this.dataset.email;
                    const userRoleId = this.dataset.roleId;

                    document.getElementById('editUserName').value = userName;
                    document.getElementById('editEmail').value = userEmail;
                    const roleSelect = document.getElementById('editRole');
                    roleSelect.value = userRoleId || "";


                    // هنا يجب جلب الأدوار الخاصة بالمستخدم، يمكنك استخدام AJAX أو تضمينها مسبقاً إذا كان لديك
                    editUserModal.setAttribute('action', `{{ route('users.update', '') }}/${userId}`);
                    editUserModal.style.display = 'flex';
                });
            });

            document.getElementById('cancelDeleteUser').addEventListener('click', () => {
                deleteUserModal.style.display = 'none';
            });

            document.querySelectorAll('.delete-user').forEach(deleteButton => {
                deleteButton.addEventListener('click', function () {
                    const userId = this.dataset.id;
                    document.getElementById('user_id').value = userId;
                    deleteUserModal.action = `{{ route('users.destroy', '') }}/${userId}`;
                    deleteUserModal.style.display = 'flex';
                });
            });
        });

        function handleSearchInput() {
            const query = document.getElementById('searchInput').value;
            if (query === '') {
                window.location.href = "{{ route('users') }}";
            } else {
                fetch(`/users?search=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.table-container').innerHTML = html;
                    });
            }
        }


    </script>
</x-app-layout>
