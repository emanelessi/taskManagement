<x-app-layout>
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 my-6 gap-6">
            <div class="p-4 md:my-4 bg-white rounded-lg shadow ">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="{{ asset('image/icon/star.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl  text-secondary">Task Completed</h2>
                    <p class="text-3xl font-semibold">12</p>
                </div>
                <hr class="text-secondary/30 m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src="  {{ asset('image/icon/vector.svg') }}">
                    <div>
                        <h2 class="text-xl  text-secondary"><span class="text-tertiary font-bold items-end">10+ </span>more
                        </h2>
                        <p class="text-xl  font-bold">from last week</p>
                    </div>
                </div>
            </div>
            <div class="p-4 md:my-4  bg-white rounded-lg shadow ">
                <div class="flex w-full justify-between items-center my-3">
                    <img src=" {{ asset('image/icon/newTasks.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl  text-secondary">New Task</h2>
                    <p class="text-3xl font-semibold">10</p>
                </div>
                <hr class="text-secondary/30 m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src=" {{ asset('image/icon/vector2.svg') }}">
                    <div>
                        <h2 class="text-xl  text-secondary"><span class="text-tertiary font-bold items-end">10+ </span>more
                        </h2>
                        <p class="text-xl  font-bold">from last week</p>
                    </div>
                </div>
            </div>
            <div class="p-4 md:my-4  bg-white rounded-lg shadow ">
                <div class="flex w-full justify-between items-center my-3">
                    <img src=" {{ asset('image/icon/newProject.svg') }}" class="w-12 h-12">
                    <h2 class="text-xl  text-secondary">Project Done</h2>
                    <p class="text-3xl font-semibold">12</p>
                </div>
                <hr class="text-secondary/30 m-4">
                <div class="flex w-full justify-between items-center my-3">
                    <img src=" {{ asset('image/icon/vector3.svg') }}">
                    <div>
                        <h2 class="text-xl  text-secondary"><span class="text-tertiary font-bold items-end">10+ </span>more
                        </h2>
                        <p class="text-xl  font-bold">from last week</p>
                    </div>
                </div>
            </div>
        </div>
        <div x-data="chartComponent()">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 shadow-lg rounded-lg">
                    <canvas id="barChart"></canvas>
                </div>
                <div class="bg-white p-4 shadow-lg rounded-lg">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
