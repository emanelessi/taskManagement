<x-app-layout>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-6 gap-6">
            <div class="p-4 md:my-4 bg-secondary rounded-lg shadow">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/star.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl text-text">{{ __('Task Completed') }}</h2>
                    <p class="text-3xl font-semibold">{{ $completedTasksLastWeek }}</p>
                </div>
                <hr class="text-secondary m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/vector.svg') }}">
                    <div>
                        <h2 class="text-xl text-text">
                            <span class="text-tertiary font-bold items-end">{{ $taskDifferenceText }}</span>
                        </h2>
                        <p class="text-xl font-bold text-white">{{ __('from last week') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-4 md:my-4 bg-secondary rounded-lg shadow">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/newTasks.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl text-text">{{ __('New Task') }}</h2>
                    <p class="text-3xl font-semibold">{{ $newTasksThisWeek }}</p>
                </div>
                <hr class="text-secondary m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/vector2.svg') }}">
                    <div>
                        <h2 class="text-xl text-text">
                            <span class="text-tertiary font-bold">{{ $newTaskDifferenceText }}</span>
                        </h2>
                        <p class="text-xl font-bold text-white">{{ __('from last week') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-4 md:my-4 bg-secondary rounded-lg shadow">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/newProject.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl text-text">{{ __('Project Done') }}</h2>
                    <p class="text-3xl font-semibold">{{ $newProjectsThisWeek }}</p>
                </div>
                <hr class="text-secondary m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/vector3.svg') }}">
                    <div>
                        <h2 class="text-xl text-text">
                            <span class="text-tertiary font-bold">{{ $newProjectDifferenceText }}</span>
                        </h2>
                        <p class="text-xl font-bold text-white">{{ __('from last week') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-secondary p-4 shadow-lg rounded-lg">
                <div class="container mx-auto">
                    {!! $chart->container() !!}
                </div>
            </div>
            <div class="bg-secondary p-4 shadow-lg rounded-lg">
                <div class="container mx-auto">
                    {!! $cost->container() !!}
                </div>
            </div>
        </div>
    </div>

    {!! $chart->script() !!}
    {!! $cost->script() !!}
</x-app-layout>
