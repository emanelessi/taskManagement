<x-app-layout>
    <div class="flex-1 overflow-auto">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <div class="md:flex justify-between">
            <div class="mb-4">
                @can('create users')
                    <x-primary-button id="addUserBtn">
                        {{ __('Add New User') }}
                    </x-primary-button>
                @endcan
            </div>
            <div class="mb-4 md:w-4/12">
                <form id="searchForm" method="GET" action="{{ route('users') }}">
                    <div class="relative w-full">
                        <input type="text" name="search" id="searchInput" placeholder="{{ __('Search Placeholder') }}"
                               value="{{ request('search') }}"
                               oninput="handleSearchInput()"
                               class="text-sm border border-black w-full bg-background rounded-md">
                        <button type="submit" id="searchButton"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-text bg-tertiary rounded-e-lg">
                            <img src="{{ asset('image/icon/search.svg') }}" alt="search" class="w-4 h-4">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto shadow-md rounded-lg">
            @php
                $headers = [__('user name'), __('email'), __('role'), __('ADD Date'), __('actions')];
                $rows = [];
                foreach ($users as $user) {
                    $rows[] = [
                        $user->name,
                        $user->email,
                        $user->roles->isNotEmpty() ? $user->roles->first()->name : '-',
                        \Carbon\Carbon::parse($user->created_at)->format('Y-m-d'),
                        (auth()->user()->can('edit users', $user)
                            ? '<a href="#" class="text-hover edit-user" data-id="' . $user->id . '" data-name="' . $user->name . '" data-email="' . $user->email . '" data-role-id="' . ($user->roles->isNotEmpty() ? $user->roles->first()->id : '')  . '">' . __('edit') . '</a>'
                            : '') .
                        (auth()->user()->can('delete users', $user)
                            ? '<a href="#" class="text-red-600 hover:text-red-900 mx-4 delete-user" data-id="' . $user->id . '">' . __('delete') . '</a>'
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
                <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12   z-30">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Edit User') }}</h2>
                    <div class="mb-4">
                        <x-input-label required>{{ __('user_name') }}:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name"
                                      id="editUserName" value="{{ $user->name ?? '' }}"
                                      required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>{{ __('email') }}:</x-input-label>
                        <x-text-input class="w-full" type="email" name="email"
                                      id="editEmail" value="{{ $user->email ?? '' }}"
                                      required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label>{{ __('password') }}:</x-input-label>
                        <x-text-input class="w-full" type="password" name="password" id="editPassword"/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>{{ __('role') }}:</x-input-label>
                        <select name="roles[]" id="editRole" required
                                class="w-full border-black focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">{{ __('Select Role') }}</option>
                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}" {{ (isset($user) && $user->roles->contains($role->id)) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelEditUser">{{ __('cancel') }}</x-danger-button>
                        <x-primary-button type="submit">{{ __('Edit User') }}</x-primary-button>
                    </div>
                </div>
            </form>

            <form id="deleteUserModal"
                  action="{{ isset($user) ? route('users.destroy', ['user' => $user->id]) : '#' }}"
                  method="POST" style="display: none;"
                  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('DELETE')
                <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Confirm Deletion') }}</h2>
                    <x-input-label class="text-xl">{{ __('Confirm Deletion Message') }} <span class="font-bold"></span>?</x-input-label>
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="flex justify-end gap-2">
                        <x-primary-button type="button" id="cancelDeleteUser">{{ __('cancel') }}</x-primary-button>
                        <x-danger-button type="submit">{{ __('delete') }}</x-danger-button>
                    </div>
                </div>
            </form>

            <form id="addUserModal" method="POST" action="{{ route('users.store') }}"
                  class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                <div class="bg-component p-6 rounded-lg shadow-lg md:w-5/12 w-8/12  z-30">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Add New User') }}</h2>
                    <div class="mb-4">
                        <x-input-label required>{{ __('User Name') }}:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name" required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>{{ __('email') }}:</x-input-label>
                        <x-text-input class="w-full" type="email" name="email" required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>{{ __('password') }}:</x-input-label>
                        <x-text-input class="w-full" type="password" name="password" required/>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>{{ __('role') }}:</x-input-label>
                        <select name="roles[]" id="addUserRoles" required
                                class="w-full border-black focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelAddUser">{{ __('cancel') }}</x-danger-button>
                        <x-primary-button type="submit">{{ __('Add User') }}</x-primary-button>
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
