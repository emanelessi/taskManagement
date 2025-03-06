<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>

        <div class="bg-component shadow-sm rounded-lg overflow-hidden">
            @forelse ($notifications as $notification)
                @php
                    $taskId = $notification->data['task_id'] ?? null;
                    if (!$taskId && isset($notification->data['url'])) {
                        $url = $notification->data['url'];
                        $taskId = basename($url);
                    }
                @endphp
                <a href="{{ $taskId ? route('tasks.details', $taskId) : '#' }}"
                   class="block transition duration-150 ease-in-out hover:bg-secondary
                    {{ $notification->read_at ? 'bg-white' : 'bg-secondary '  }}">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h5 class="text-lg font-semibold
                                {{ $notification->read_at ? 'text-gray-800' : 'text-text' }}">
                                {{ $notification->data['title'] ?? 'No Title' }}
                            </h5>
                            <small class="text-sm text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <p class="mt-2
                            {{ $notification->read_at ? 'text-gray-600' : 'text-text' }}">
                            {{ $notification->data['body'] ?? 'No Body' }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="px-6 py-4">
                    <p class="text-gray-600">No notifications found.</p>
                </div>
            @endforelse
        </div>

        <form action="{{ route('notifications.markAsRead') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="bg-component hover:bg-secondary text-text px-4 py-2 rounded-lg shadow-md transition duration-150 ease-in-out">
                {{__('Mark All as Read')}}
            </button>
        </form>

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    </div>
</x-app-layout>
