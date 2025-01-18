<x-app-layout>
    <div class="flex-1 overflow-auto p-6">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>

        <div class="bg-component shadow-lg rounded-lg p-8">
            <div class="grid mb-5 gap-6">
                <div class="flex justify-between my-3">
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Task Name:') }}</p>
                        <div class="text-hover  font-medium">{{ $task->title }}</div>
                    </div>
                    <div class="flex space-x-2 px-2 ">
                        @can('delete tasks')
                            <img src="{{ asset('image/icon/delete.svg') }}" alt="delete" width="15" class="deleteTask"
                                 data-id="{{ $task->id }}"/>
                        @endcan
                        @can('edit tasks')
                            <img src="{{ asset('image/icon/edit.svg') }}" alt="edit" width="20" class="editTask"
                                 data-id="{{ $task->id }}" data-title="{{ $task->title }}"
                                 data-description="{{ $task->description }}" data-due-date="{{ $task->due_date }}"
                                 data-priority="{{ $task->priority }}" data-category-id="{{ $task->category_id }}"
                                 data-status-id="{{ $task->status_id }}" data-project-id="{{ $task->project_id }}"
                                 data-completed-at="{{ $task->completed_at }}"/>
                        @endcan

                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-bg-component to-bg-secondary  p-6 rounded-lg mb-6 shadow-inner">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Project Name:') }}</p>
                        <div class="text-hover  font-medium">{{ $task->project->name ?? 'غير متوفر' }}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Status:') }}</p>
                        <div class="text-hover  font-medium">{{ $task->status->name ?? 'غير متوفر' }}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Priority:') }}</p>
                        <div class="text-hover  font-medium">{{ $task->priority }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Completed Date:') }}</p>
                        <div
                            class="text-hover  font-medium">{{ \Carbon\Carbon::parse($task->completed_at)->format('Y-m-d') }}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Deadline:') }}</p>
                        <div
                            class="text-hover  font-medium">{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Assigned To:') }}</p>
                        <div class="text-hover  font-medium">{{ $task->user->name ?? 'غير متوفر' }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                    <div class="flex items-center gap-2">
                        <p class="text-text font-bold text-lg">{{ __('Category:') }}</p>
                        <div class="text-hover  font-medium">{{ $task->category->name ?? 'غير متوفر' }}</div>
                    </div>


                </div>
            </div>

            <div class="mb-6">
                <p class="text-text font-bold text-lg">{{ __('Description:') }}</p>
                <div class="text-hover  leading-relaxed break-words">{{ $task->description }}</div>
            </div>

            <div class="mb-6">
                <h3 class="text-text font-bold text-lg mb-4">{{ __('Attachments:') }}</h3>
                <div class="overflow-x-auto">
                    <div class="flex gap-4 min-w-max">
                        @if ($attachment->isEmpty())
                            <div class="text-hover ">{{ __('No Attachments available.') }}</div>
                        @else                        @foreach($task->attachments as $attachment)
                            <div class="relative group">
                                <div class="cursor-pointer">
                                    @if(in_array(pathinfo($attachment->file_path, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg', 'gif']))
                                        <img src="{{ asset('storage/' . $attachment->file_path) }}" alt="Attachment"
                                             class="w-32 h-32   rounded-lg transform transition-all duration-300 group-hover:scale-110"
                                             onclick="openImageModal('{{ asset('storage/' . $attachment->file_path) }}')">
                                    @elseif(in_array(pathinfo($attachment->file_path, PATHINFO_EXTENSION), ['pdf']))
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank"
                                           class="w-32 h-32 bg-gray-200 flex items-center justify-center text-center rounded-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                                 height="24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"></path>
                                                <path d="M14 2v6h6"></path>
                                            </svg>
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank"
                                           class="w-32 h-32 bg-gray-200 flex items-center justify-center text-center rounded-lg">
                                            <p class="text-sm text-gray-700">{{ __('Download File') }}</p>
                                        </a>
                                    @endif
                                </div>
                                @can("delete attachments")
                                    <button onclick="openAttachmentDeleteModal({{ $attachment->id }})"
                                            class="absolute top-2 right-2 text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                @endcan
                            </div>
                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
            <div id="imageModal"
                 class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-xl w-full px-4">
                    <img id="modalImage" src="" alt="Full-size Image" class="w-full h-auto rounded-lg">
                    <button onclick="closeImageModal()"
                            class="absolute top-4 right-4 text-white bg-red-600 hover:bg-red-700 p-2 px-4 rounded-full">
                        X
                    </button>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-text font-bold text-lg mb-2">{{ __('Comments:') }}</h3>
                @foreach ($comments as $comment)
                    <div
                        class="grid grid-cols-2 lg:grid-cols-2 gap-6  p-4 mb-4 border leading-relaxed break-words border-gray-300 rounded-lg bg-gray-50 shadow">
                        <div>
                            <div class="text-hover  font-medium">{{ $comment->comment }}</div>
                            <div class="text-gray-500 text-sm mt-1">{{ __('Posted') }}
                                {{ __('by:') }}  {{ $comment->user->name ?? 'Unknown User' }}
                                {{ __('on') }} {{ $comment->created_at->format('Y-m-d H:i') }}</div>
                            <div class="text-gray-500 text-sm mt-1">
                                {{ __('Updated At: ') }} {{ $comment->updated_at->format('Y-m-d H:i') }}

                            </div>
                        </div>
                        <div class="flex gap-4 mt-2 justify-end">
                            @can('edit comments')
                                <button onclick="openEditModal({{ $comment->id }}, '{{ $comment->comment }}')"
                                        class="text-hover hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.232 5.232a3 3 0 014.243 4.243L7.5 21H3v-4.5L15.232 5.232z"/>
                                    </svg>
                                </button>
                            @endcan

                            @can('delete comments')
                                <button onclick="openDeleteModal({{ $comment->id }})"
                                        class="text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @endcan

                        </div>
                    </div>
                @endforeach
                @if ($comments->isEmpty())
                    <div class="text-gray-500">{{ __('No comments available.') }}</div>
                @endif
            </div>
            @can('create comments')
                <div class="mb-6">
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="mb-4">
                            <x-input-label for="comment" class="block text-text font-bold mb-2">{{ __('Add a Comment:') }}
                            </x-input-label>
                            <textarea name="comment" id="comment" rows="4"
                                      class="w-full px-3 py-2 text-black border border-gray-300 rounded-lg"
                                      required></textarea>
                        </div>
                        <div class="flex justify-end  gap-4">
                            <x-primary-button type="submit">{{ __('Submit Comment') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            @endcan

            <div class="flex justify-end mt-6 gap-4">
                <a href="{{ url('/tasks') }}">
                    <x-primary-button >{{ __('Back') }}</x-primary-button>
                </a>
            </div>

            <x-edit-task-form :task="$task" :projects="$project" :categories="$category" :statuses="$status"/>
                <x-delete-task-form :task="$task"/>
                <div id="editCommentModal"
                     class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Edit Comment') }}</h2>
                        <form id="editCommentForm" method="POST">
                            @csrf
                            @method('PUT')
                            <textarea id="editCommentText" name="comment" rows="4"
                                      class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                            <div class="flex justify-end mt-4 gap-4">
                                <x-danger-button type="button" onclick="closeEditModal()">{{ __('Cancel') }}</x-danger-button>
                                <x-primary-button type="submit">{{ __('Save Changes') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="deleteCommentModal"
                     class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Delete Comment') }}</h2>
                        <p>{{ __('Are you sure you want to delete this comment?') }}</p>
                        <div class="flex justify-end mt-4 gap-4">
                            <x-danger-button type="button" onclick="closeDeleteModal()">{{ __('Cancel') }}</x-danger-button>
                            <form id="deleteCommentForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit">{{ __('Delete') }}</x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="deleteAttachmentModal"
                     class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Delete Attachment') }} </h2>
                        <p>{{ __('Are you sure you want to delete this attachment ?') }}</p>
                        <div class="flex justify-end mt-4 gap-4">
                            <x-danger-button type="button" onclick="closeAttachmentDeleteModal()">{{ __('Cancel') }}
                            </x-danger-button>
                            <form id="deleteAttachmentForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-primary-button type="submit">{{ __('Delete') }}</x-primary-button>
                            </form>
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

        function openAttachmentDeleteModal(attachmentId) {
            console.log("test")
            document.getElementById('deleteAttachmentModal').classList.remove('hidden');
            document.getElementById('deleteAttachmentForm').action = `/attachments/${attachmentId}`;
        }

        function closeAttachmentDeleteModal() {
            document.getElementById('deleteAttachmentModal').classList.add('hidden');
        }

        function openImageModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modal.classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </Script>
</x-app-layout>
