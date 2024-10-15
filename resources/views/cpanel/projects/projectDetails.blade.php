<x-app-layout>
    <div class="flex-1 overflow-auto">
        <x-alert type="success" :message="session('success')" />
        <x-alert type="error" :errors="$errors->all()" />
        <div class="bg-white shadow-lg rounded-lg p-8">
            <!-- Section with Background -->
            <div class="bg-gradient-to-r from-tertiary/40 to-tertiary/10 p-6 rounded-lg mb-6 shadow-inner">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Project Name -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-md">Project Name:</p>
                        <div class="text-black  font-medium">{{ $project->name }}</div>
                    </div>
                    <!-- Status -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-md">Status:</p>
                        <div class="text-black   font-medium">{{ $project->status->name ?? 'غير متوفر' }}</div>
                    </div>
                    <!-- Cost -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-md">Cost:</p>
                        <div class="text-black  font-medium">{{ $project->cost }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <!-- Start Date -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-md">Start Date:</p>
                        <div class="text-black  font-medium">{{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}</div>
                    </div>
                    <!-- Deadline -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-md">Deadline:</p>
                        <div class="text-black  font-medium">{{ \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') }}</div>
                    </div>
                    <!-- Created By -->
                    <div class="flex items-center gap-2">
                        <p class="text-tertiary font-bold text-md">Created By:</p>
                        <div class="text-black   font-medium">{{ $project->user->name }}</div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <p class="text-tertiary  font-bold text-md">Description:</p>
                <div class="text-black  leading-relaxed break-words">{{ $project->description}}</div>
            </div>

            <!-- Back Button -->
            <div class="flex justify-end mt-6">
                <x-primary-button onclick="window.history.back()">Back</x-primary-button>
            </div>
        </div>
    </div>
</x-app-layout>
