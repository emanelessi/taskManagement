<x-app-layout>
    <div class="flex-1 overflow-auto">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>
        <div class="bg-component shadow-lg rounded-lg p-8">
            <div class="grid mb-5 gap-6">
                <!-- Section with Background -->
                <div class="bg-gradient-to-r from-bg-component to-bg-secondary p-6 rounded-lg mb-6 shadow-inner">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Project Name -->
                        <div class="flex items-center gap-2">
                            <p class="text-text font-bold text-lg">Project Name:</p>
                            <div class="text-hover font-medium">{{ $project->name }}</div>
                        </div>
                        <!-- Status -->
                        <div class="flex items-center gap-2">
                            <p class="text-text font-bold text-lg">Status:</p>
                            <div class="text-hover  font-medium">{{ $project->status->name ?? '-' }}</div>
                        </div>
                        <!-- Cost -->
                        <div class="flex items-center gap-2">
                            <p class="text-text font-bold text-lg">Cost:</p>
                            <div class="text-hover font-medium">{{ $project->cost }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                        <!-- Start Date -->
                        <div class="flex items-center gap-2">
                            <p class="text-text font-bold text-lg">Start Date:</p>
                            <div
                                class="text-hover font-medium">{{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}</div>
                        </div>
                        <!-- Deadline -->
                        <div class="flex items-center gap-2">
                            <p class="text-text font-bold text-lg">Deadline:</p>
                            <div
                                class="text-hover font-medium">{{ \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') }}</div>
                        </div>
                        <!-- Created By -->
                        <div class="flex items-center gap-2">
                            <p class="text-text font-bold text-lg">Created By:</p>
                            <div class="text-hover  font-medium">{{ $project->creator->name }}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-6 mt-4">
                        <div class="flex items-center gap-2">
                            <p class="text-text font-bold text-lg">Team Members:</p>
                            <div class="text-hover font-medium">
                                {{ $members}}
                            </div>
                        </div>
                     </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <p class="text-text font-bold text-lg">Description:</p>
                    <div class="text-black  leading-relaxed break-words">{{ $project->description}}</div>
                </div>

                <div class="flex justify-end mt-6 gap-4">
                    @can('manage tasks')
                    <form method="GET" action="{{ route('projects.tasks', ['project' => $project->id]) }}">
                        <x-primary-button type="submit">
                            Show Tasks
                        </x-primary-button>
                    </form>
                    @endcan

                    <x-primary-button onclick="window.history.back()">Back</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
