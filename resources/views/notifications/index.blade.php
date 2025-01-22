<x-app-layout>

    <div class="container">
        <h1>Notifications</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="list-group">
            @forelse ($notifications as $notification)
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $notification->data['title'] ?? 'No Title' }}</h5>
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $notification->data['body'] ?? 'No Body' }}</p>
                </a>
            @empty
                <p>No notifications found.</p>
            @endforelse
        </div>

        <form action="{{ route('notifications.markAsRead') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Mark All as Read</button>
        </form>
    </div>
</x-app-layout>
