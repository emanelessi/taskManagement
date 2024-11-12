<x-app-layout>
    <div class="flex-1 overflow-auto ">
        <!-- start the alert -->
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <!-- end the alert -->

        <div class="md:flex justify-between">
            <div class="mb-4">
                @can('create projects')
                    <x-primary-button id="addProjectBtn">
                        + Add New Project
                    </x-primary-button>
                @endcan
            </div>
            <div class="mb-4 md:w-4/12">
                <form id="searchForm" method="GET" action="{{ route('projects') }}">
                    <div class="relative w-full">
                        <input type="text" name="search" id="searchInput" placeholder="Search"
                               value="{{ request('search') }}"
                               class="text-sm border border-secondary w-full bg-primary rounded-md"
                               oninput="handleSearchInput()">
                        <button type="submit"
                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-tertiary rounded-e-lg">
                            <img src="{{ asset('image/icon/search.svg') }}" alt="search" class="w-4 h-4">
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- start the table -->
        <div class="overflow-x-auto shadow-md rounded-lg">
            @php
                $headers = ['Project Name', 'Status', 'Start Date', 'Deadline', 'Cost', 'Managers', 'Actions'];
                $rows = [];
                foreach ($projects as $project) {
                    $rows[] = [
                        auth()->user()->can('view project details', $project)
                            ? '<a href="' . route('projects.details', $project->id) . '" class="text-blue-600 hover:underline">' . $project->name . '</a>'
                            : '<span class="text-gray-500">' . $project->name . '</span>',
                         optional($project->status)->name ?? "-",
                        $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') :  "-",
                        $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') :  "-",
                        $project->cost ?? "-",
                        implode(', ', $project->managers->pluck('name')->toArray())?? "-",

                        (auth()->user()->can('edit projects', $project)
                            ? '<a href="#" class="text-tertiary hover:text-tertiary edit-project" data-id="' . $project->id . '"
                                data-name="' . $project->name . '"
                                data-status="' . optional($project->status)->id  . '"
                                data-deadline="' . $project->deadline . '"
                                data-start-date="' . $project->start_date . '"
                                data-description="' . $project->description . '"
                                data-cost="' . $project->cost . '"
                                data-project-manager="'.implode(',', $project->managers->pluck('id')->toArray()) .'"
   data-project-members="'. implode(',', $project->teamMembers->pluck('id')->toArray()) .'"
                                >Edit</a>'
                            : '') .
                        (auth()->user()->can('delete projects', $project)
                            ? '<a href="#" class="text-red-600 hover:text-red-900 ml-4 delete-project" data-id="' . $project->id . '">Delete</a>'
                            : ''),
                    ];
                }
            @endphp

            <x-static-table :headers="$headers" :rows="$rows"/>
            <!-- end the table -->

            <div class="mt-4">
                {{  $projects->links() }}
            </div>

            <!-- Edit Project Modal -->
            <form id="editProjectModal" method="POST"
                  action="{{ isset($project) ? route('projects.update', ['project' => $project->id]) : '#' }}"
                  class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('PATCH')
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
                    <h2 class="text-lg font-semibold mb-4">Edit Project</h2>
                    <div class="mb-4">
                        <x-input-label  required >Project Name:</x-input-label>
                        <x-text-input class="w-full" type="text" id="editProjectName" name="name" required></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select name="status" id="editProjectStatus" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select status</option>
                            @foreach($status as $statu)
                                <option value="{{ $statu->id }}" {{ isset($project) && $project->status_id == $statu->id ? 'selected' : '' }}>{{ $statu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Due Date:</x-input-label>
                        <x-text-input class="w-full" type="date" name="deadline" id="editProjectDeadline" ></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Start Date:</x-input-label>
                        <x-text-input class="w-full" type="date" name="start_date" id="editProjectStartDate" ></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Cost:</x-input-label>
                        <x-text-input class="w-full" type="number" name="cost" id="editProjectCost" ></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Description:</x-input-label>
                        <textarea name="description" id="editProjectDescription" class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" ></textarea>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Assign Project Manager:</x-input-label>
                        <select name="project_manager" id="editProjectManager" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                            <option value="">Select Project Manager</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ isset($project->managers) && $project->managers->contains('id', $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- اختيار أعضاء الفريق -->
                    <div class="mb-4">
                        <x-input-label>Assign Team Members:</x-input-label>
                        <select name="team_members[]" id="editProjectMembers" multiple class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Team Members</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ isset($project->teamMembers) && $project->teamMembers->contains('id', $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelEditProject">Cancel</x-danger-button>
                        <x-primary-button>Edit Project</x-primary-button>
                    </div>
                </div>
            </form>
            <!-- End Edit Project Modal -->

            <!-- Delete Project Modal -->
            <form id="deleteProjectModal" method="POST" action="#" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                @csrf
                @method('DELETE')
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12">
                    <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
                    <x-input-label class="text-xl">Are you sure you want to delete <span id="deleteProjectName" class="font-bold"></span>?</x-input-label>
                    <input type="hidden" name="project_id" id="project_id">
                    <div class="flex justify-end gap-2">
                        <x-primary-button type="button" id="cancelDeleteProject">Cancel</x-primary-button>
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </div>
                </div>
            </form>
            <!-- End Delete Project Modal -->

            <!-- Add Project Modal -->
            <form id="addProjectModal" method="POST" action="{{ route('projects.store') }}" class="hidden fixed inset-0 flex  items-center justify-center bg-black bg-opacity-50">
                @csrf
                <div class="bg-white p-6 rounded-lg shadow-lg md:w-5/12 w-8/12 lg:mt-16 md:max-h-[90vh] overflow-y-auto z-30">
                    <h2 class="text-lg font-semibold mb-4">Add New Project</h2>
                    <div class="mb-4">
                        <x-input-label required>Project Name:</x-input-label>
                        <x-text-input class="w-full" type="text" name="name" required></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Status:</x-input-label>
                        <select name="status" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select status</option>
                            @foreach($status as $statu)
                                <option value="{{ $statu->id }}">{{ $statu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Due Date:</x-input-label>
                        <x-text-input class="w-full" type="date" name="deadline" ></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Start Date:</x-input-label>
                        <x-text-input class="w-full" type="date" name="start_date" ></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Cost:</x-input-label>
                        <x-text-input class="w-full" type="number" name="cost" ></x-text-input>
                    </div>
                    <div class="mb-4">
                        <x-input-label>Description:</x-input-label>
                        <textarea name="description" class="w-full p-2 border border-secondary/30 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" ></textarea>
                    </div>
                    <div class="mb-4">
                        <x-input-label required>Assign Project Manager:</x-input-label>
                        <select name="project_manager" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary" required>
                            <option value="">Select Project Manager</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- اختيار أعضاء الفريق -->
                    <div class="mb-4">
                        <x-input-label>Assign Team Members:</x-input-label>
                        <select name="team_members[]" multiple class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-tertiary">
                            <option value="">Select Team Members</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-4">
                        <x-danger-button type="button" id="cancelAddProject">Cancel</x-danger-button>
                        <x-primary-button>Add Project</x-primary-button>
                    </div>
                </div>
            </form>
            <!-- End Add Project Modal -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            <!--start storing models in variables -->
            const addProjectModal = document.getElementById('addProjectModal');
            const editProjectModal = document.getElementById('editProjectModal');
            const deleteProjectModal = document.getElementById('deleteProjectModal');
            <!--end storing models in variables -->

            <!--start open and close the model -->
            document.getElementById('addProjectBtn').addEventListener('click', () => {
                addProjectModal.classList.remove('hidden');
            });

            document.getElementById('cancelAddProject').addEventListener('click', () => {
                addProjectModal.classList.add('hidden');
            });

            document.getElementById('cancelEditProject').addEventListener('click', () => {
                editProjectModal.style.display = 'none';
            });
            <!--end open and close the model -->

            <!--start storing data in the model -->
            document.querySelectorAll('.edit-project').forEach(editButton => {
                editButton.addEventListener('click', function () {
                    const projectId = this.dataset.id;
                    const projectName = this.dataset.name;
                    const projectStatus = this.dataset.status;
                    const projectDeadline = this.dataset.deadline ? new Date(this.dataset.deadline).toISOString().split('T')[0] : '';
                    const projectStartDate = this.dataset.startDate ? new Date(this.dataset.startDate).toISOString().split('T')[0] : '';
                    const projectDescription = this.dataset.description;
                    const projectCost = this.dataset.cost;
                    const projectManagerId = this.getAttribute('data-project-manager');
                    const projectMembers = this.getAttribute('data-project-members').split(',');
                    const filteredMembers = projectMembers.filter(member => member !== projectManagerId);

                    document.querySelector('input[name="name"]').value = projectName;
                    document.querySelector('select[name="status"]').value = projectStatus;
                    document.querySelector('input[name="deadline"]').value = projectDeadline;
                    document.querySelector('input[name="start_date"]').value = projectStartDate;
                    document.querySelector('textarea[name="description"]').value = projectDescription;
                    document.getElementById('editProjectManager').value = projectManagerId;

                    // تعيين Team Members
                    const memberSelect = document.getElementById('editProjectMembers');
                    Array.from(memberSelect.options).forEach(option => {
                        option.selected = filteredMembers.includes(option.value);
                    });
                    document.querySelector('input[name="cost"]').value = projectCost;


                    editProjectModal.setAttribute('action', `{{ route('projects.update', '') }}/${projectId}`);
                    editProjectModal.style.display = 'flex';
                });
            });
            <!--end storing data in the model -->

            <!--start process  in the delete model -->
            document.getElementById('cancelDeleteProject').addEventListener('click', () => {
                deleteProjectModal.style.display = 'none';
            });

            document.querySelectorAll('.delete-project').forEach(deleteButton => {
                deleteButton.addEventListener('click', function () {
                    const projectId = this.dataset.id;
                    document.getElementById('project_id').value = projectId;
                    deleteProjectModal.action = `{{ route('projects.destroy', '') }}/${projectId}`;
                    deleteProjectModal.style.display = 'flex';
                });
            });

        });

        function handleSearchInput() {
            const query = document.getElementById('searchInput').value;
            if (query === '') {
                window.location.href = "{{ route('tasks') }}";
            } else {
                fetch(`/tasks?search=${query}`)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('.table-container').innerHTML = html;
                    });
            }
        }
    </script>

</x-app-layout>
