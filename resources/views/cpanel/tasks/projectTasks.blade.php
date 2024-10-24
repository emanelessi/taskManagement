<x-app-layout>
    <div class="flex-col  w-full  overflow-auto scrollbar-thin">
        <x-alert type="success" :message="session('success')"/>
        <x-alert type="error" :errors="$errors->all()"/>

        {{--        @foreach($tasks as $task)--}}
        {{--            <p class="font-semibold text-tertiary">{{ $task->project->name ?? 'Project Name' }}</p>--}}
        {{--        @endforeach--}}

        <div class="md:flex  my-4 w-full">
            <div id="task-board" class="md:flex justify-between w-full space-x-4">
                <x-task-board :tasks="$tasks ?? []"/>
                <div class="lg:w-2/4 w-full ">
                    <div class="flex justify-between bg-white p-4 rounded-lg">
                        <div class="flex space-x-2 px-2 ">
                            <h2 class="text-md font-bold">ADD MORE TOPIC</h2>
                        </div>
                        <div class="flex space-x-2 px-2 addCategoryBtn">
                            <img src="{{ asset('image/icon/add.svg') }}" alt="add"/>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class=" p-3 rounded-lg shadow mb-2 addTaskBtn">
                            <svg width="250" height="15"
                                 class="flex justify-center items-center mx-auto"
                                 viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                                    fill="#232360"/>
                            </svg>

                        </div>
                    </div>
                </div>
            </div>
            <x-add-task-form :projects="$projects" :categories="$categories" :statuses="$statuses"/>
            <x-edit-task-form :task="$task" :projects="$projects" :categories="$categories" :statuses="$statuses"/>
            <x-delete-task-form :task="$task"/>
            <x-add-category-form/>
        </div>
    </div>
</x-app-layout>
