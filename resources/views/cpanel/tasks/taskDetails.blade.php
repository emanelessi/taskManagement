<x-app-layout>
    <div class="flex-1 overflow-auto p-6">
        <!-- Alerts -->
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <div class="grid my-5 gap-6">
                <!-- Task Name -->
                <div class="flex items-center gap-2">
                    <p class="text-tertiary font-bold text-lg">Task Name:</p>
                    <div class="text-gray-800 font-medium">{{ $task->title }}</div>
                </div>

            </div>
            <!-- Section with Background -->
            <div class="bg-gradient-to-r from-tertiary/30 to-tertiary/10 p-6 rounded-lg mb-6 shadow-inner">
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
                    <!-- Created By -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Created By:</p>
                        <div class="text-gray-800 font-medium">{{ $task->user->name }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                    <!-- Category -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Category:</p>
                        <div class="text-gray-800 font-medium">{{ $task->category->name ?? 'غير متوفر' }}</div>
                    </div>
                    <!-- Assigned To -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-lg">Assigned To:</p>
                        <div class="text-gray-800 font-medium">{{ $task->assignedTo->name ?? 'غير متوفر' }}</div>
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
                    <div class="p-4 mb-4 border border-gray-300 rounded-lg bg-gray-50 shadow">
                        <div class="text-gray-800 font-medium">{{ $comment->comment }}</div>
                        <div class="text-gray-500 text-sm mt-1">Posted by: {{ $comment->user->name ?? 'Unknown User' }}
                            on {{ $comment->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                @endforeach
                @if ($comments->isEmpty())
                    <div class="text-gray-500">No comments available.</div>
                @endif
            </div>
            <div class="mb-6">
                <form action="#" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <div class="mb-4">
                        <label for="comment" class="block text-tertiary font-bold mb-2">Add a Comment:</label>
                        <textarea name="comment" id="comment" rows="4"
                                  class="w-full px-3 py-2 text-black border border-gray-300 rounded-lg"
                                  required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button type="submit">Submit Comment</x-primary-button>
                    </div>
                </form>
            </div>
            <!-- Back Button -->
            <div class="flex justify-end mt-6 gap-4">
                <!-- Edit Button -->

                <x-primary-button href="#">
                    Edit Task
                </x-primary-button>


                <x-primary-button onclick="window.history.back()">Back</x-primary-button>

            </div>
        </div>
    </div>
</x-app-layout>
