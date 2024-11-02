<x-app-layout>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-6 gap-6">
            <!-- بطاقة المهام المكتملة -->
            <div class="p-4 md:my-4 bg-white rounded-lg shadow ">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/star.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl text-secondary">Task Completed</h2>
                    <p class="text-3xl font-semibold">{{ $completedTasksLastWeek }}</p>
                </div>
                <hr class="text-secondary/30 m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/vector.svg') }}">
                    <div>
                        <h2 class="text-xl text-secondary">
                            <span class="text-tertiary font-bold items-end">{{ $taskDifferenceText }}</span>
                        </h2>
                        <p class="text-xl font-bold">from last week</p>
                    </div>
                </div>
            </div>

            <!-- بطاقة المهام الجديدة -->
            <div class="p-4 md:my-4 bg-white rounded-lg shadow ">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/newTasks.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl text-secondary">New Task</h2>
                    <p class="text-3xl font-semibold">{{ $newTasksThisWeek }}</p>
                </div>
                <hr class="text-secondary/30 m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/vector2.svg') }}">
                    <div>
                        <h2 class="text-xl text-secondary">
                            <span class="text-tertiary font-bold">{{ $newTaskDifferenceText }}</span>
                        </h2>
                        <p class="text-xl font-bold">from last week</p>

                    </div>
                </div>
            </div>

            <div class="p-4 md:my-4 bg-white rounded-lg shadow ">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/newProject.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl text-secondary">Project Done</h2>
                    <p class="text-3xl font-semibold">{{ $newProjectsThisWeek }}</p>
                </div>
                <hr class="text-secondary/30 m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/vector3.svg') }}">
                    <div>
                        <h2 class="text-xl text-secondary">
                            <span class="text-tertiary font-bold">{{ $newProjectDifferenceText }}</span>
                        </h2>
                        <p class="text-xl font-bold">from last week</p>

                    </div>
                </div>
            </div>
        </div>

            <!-- قسم الرسوم البيانية -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- رسم بياني للمشاريع -->
            <div class="bg-white p-4 shadow-lg rounded-lg">
                <div class="container mx-auto">
                    {!! $chart->container() !!}
                </div>
            </div>
            <!-- رسم بياني للمهام -->
            <div class="bg-white p-4 shadow-lg rounded-lg">
                <div class="container mx-auto ">
                    {!! $cost->container() !!}
                </div>
            </div>
        </div>
    </div>

    {!! $chart->script() !!}
    {!! $cost->script() !!}
</x-app-layout>
