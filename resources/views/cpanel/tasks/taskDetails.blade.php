<x-app-layout>
    <div class="flex-1 overflow-auto p-6">
        <!-- Alerts -->
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <div class="grid mb-5 gap-6">
                <!-- Task Name -->

                <div class="flex justify-between my-3">
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Task Name:</p>
                        <div class="text-gray-800 font-medium">{{ $task->title }}</div>
                    </div>
                    <div class="flex space-x-2 px-2 ">
                        <img src="{{ asset('image/icon/delete.svg') }}" alt="delete" width="15" class="deleteTask"
                             data-id="{{ $task->id }}"/>
                        <img src="{{ asset('image/icon/edit.svg') }}" alt="edit" width="20" class="editTask"
                             data-id="{{ $task->id }}" data-title="{{ $task->title }}"
                             data-description="{{ $task->description }}" data-due-date="{{ $task->due_date }}"
                             data-priority="{{ $task->priority }}" data-category-id="{{ $task->category_id }}"
                             data-status-id="{{ $task->status_id }}" data-project-id="{{ $task->project_id }}"
                             data-completed-at="{{ $task->completed_at }}"/>
                    </div>
                </div>
            </div>
            <!-- Section with Background -->
            <div class="bg-gradient-to-r from-quaternary/30 to-tertiary/10 p-6 rounded-lg mb-6 shadow-inner">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Project -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Project:</p>
                        <div class="text-gray-800 font-medium">{{ $task->project->name ?? 'غير متوفر' }}</div>
                    </div>
                    <!-- Status -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Status:</p>
                        <div class="text-gray-800 font-medium">{{ $task->status->name ?? 'غير متوفر' }}</div>
                    </div>
                    <!-- Priority -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Priority:</p>
                        <div class="text-gray-800 font-medium">{{ $task->priority }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                    <!-- Completed Date -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Completed Date:</p>
                        <div
                            class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($task->completed_at)->format('Y-m-d') }}</div>
                    </div>
                    <!-- Deadline -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Deadline:</p>
                        <div
                            class="text-gray-800 font-medium">{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</div>
                    </div>
                    <!-- Assigned To -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Assigned To:</p>
                        <div class="text-gray-800 font-medium">{{ $task->user->name ?? 'غير متوفر' }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                    <!-- Category -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Category:</p>
                        <div class="text-gray-800 font-medium">{{ $task->category->name ?? 'غير متوفر' }}</div>
                    </div>


                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <p class="text-tertiary font-bold text-lg">Description:</p>
                <div class="text-gray-800 leading-relaxed break-words">{{ $task->description }}</div>
            </div>


            <!-- Comments Section -->
            <div class="mb-6">
                <h3 class="text-tertiary font-bold text-lg mb-2">Comments:</h3>
                @foreach ($comments as $comment)
                    <div
                        class="grid grid-cols-2 lg:grid-cols-2 gap-6  p-4 mb-4 border leading-relaxed break-words border-gray-300 rounded-lg bg-gray-50 shadow">
                        <div>
                            <div class="text-gray-800 font-medium">{{ $comment->comment }}</div>
                            <div class="text-gray-500 text-sm mt-1">Posted
                                by: {{ $comment->user->name ?? 'Unknown User' }}
                                on {{ $comment->created_at->format('Y-m-d H:i') }}</div>
                            <div class="text-gray-500 text-sm mt-1">
                                Updated At: {{ $comment->updated_at->format('Y-m-d H:i') }}

                            </div>
                        </div>
                        <!-- Buttons for Edit and Delete -->
                        <div class="flex gap-4 mt-2 justify-end">
                            <!-- Edit Button SVG -->
                            <button onclick="openEditModal({{ $comment->id }}, '{{ $comment->comment }}')"
                                    class="text-blue-600 hover:text-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.232 5.232a3 3 0 014.243 4.243L7.5 21H3v-4.5L15.232 5.232z"/>
                                </svg>
                            </button>

                            <!-- Delete Button SVG -->
                            <button onclick="openDeleteModal({{ $comment->id }})"
                                    class="text-red-600 hover:text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
                @if ($comments->isEmpty())
                    <div class="text-gray-500">No comments available.</div>
                @endif
            </div>
            <div class="mb-6">
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <div class="mb-4">
                        <label for="comment" class="block text-tertiary font-bold mb-2">Add a Comment:</label>
                        <textarea name="comment" id="comment" rows="4"
                                  class="w-full px-3 py-2 text-black border border-gray-300 rounded-lg"
                                  required></textarea>
                    </div>
                    <div class="flex justify-end  gap-4">
                        <x-primary-button type="submit">Submit Comment</x-primary-button>
                    </div>
                </form>
            </div>
            <!-- Back Button -->
            <div class="flex justify-end mt-6 gap-4">
                <!-- Edit Button -->
                <x-primary-button href="#" class="editTask"
                                  data-id="{{ $task->id }}"
                                  data-title="{{ $task->title }}"
                                  data-description="{{ $task->description }}"
                                  data-due-date="{{ $task->due_date }}"
                                  data-priority="{{ $task->priority }}"
                                  data-category-id="{{ $task->category_id }}"
                                  data-status-id="{{ $task->status_id }}"
                                  data-project-id="{{ $task->project_id }}"
                                  data-completed-at="{{ $task->completed_at }} ">
                    Edit Task
                </x-primary-button>
                <a href="{{ url('/tasks') }}">
                    <x-primary-button>Back</x-primary-button>
                </a>

                <x-edit-task-form :task="$task" :projects="$project" :categories="$category" :statuses="$status"/>
                <x-delete-task-form :task="$task"/>

                <!-- Edit Comment Modal -->
                <div id="editCommentModal"
                     class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4">Edit Comment</h2>
                        <form id="editCommentForm" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea id="editCommentText" name="comment" rows="4"
                                      class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                            <div class="flex justify-end mt-4 gap-4">
                                <x-danger-button type="button" onclick="closeEditModal()">Cancel</x-danger-button>
                                <x-primary-button type="submit">Save Changes</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Delete Comment Modal -->
                <div id="deleteCommentModal"
                     class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4">Delete Comment</h2>
                        <p>Are you sure you want to delete this comment?</p>
                        <div class="flex justify-end mt-4 gap-4">
                            <x-danger-button type="button" onclick="closeDeleteModal()">Cancel</x-danger-button>
                            <form id="deleteCommentForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit">Delete</x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <Script>
        function openEditModal(commentId, commentText) {
            document.getElementById('editCommentModal').classList.remove('hidden');
            document.getElementById('editCommentText').value = commentText;
            document.getElementById('editCommentForm').action = `/comments/${commentId}`;
        }

        function closeEditModal() {
            document.getElementById('editCommentModal').classList.add('hidden');
        }

        function openDeleteModal(commentId) {
            document.getElementById('deleteCommentModal').classList.remove('hidden');
            document.getElementById('deleteCommentForm').action = `/comments/${commentId}`;
        }

        function closeDeleteModal() {
            document.getElementById('deleteCommentModal').classList.add('hidden');
        }

    </Script>
</x-app-layout>
