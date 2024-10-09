
        <div class="flex justify-between bg-white p-4 rounded-lg">
            <div class="flex space-x-2 px-2 ">
                <h2 class="text-md font-bold">Backlog</h2>
                <h2 class="text-md font-bold text-tertiary">{{ $backlogCount ?? '0' }}</h2>
            </div>
            <div class="flex space-x-2 px-2 ">
                <img src="{{ asset('image/icon/dots.svg') }}" alt="dots" width="20"/>
            </div>
        </div>
        <div class="mt-2 tasks-list">
{{--            @foreach($tasks as $task)--}}
                <div class="bg-white p-3 rounded-lg shadow mb-2 task">
                    <div class="flex justify-between my-3">
                        <h3 class="font-semibold bg-tertiary/30 w-5/12 flex items-center justify-center rounded-lg">{{ $task['title'] ?? 'Task Title' }}</h3>
                        <div class="flex space-x-2 px-2 ">
                            <img src="../image/icon/delete.svg" alt="delete" width="15" @click="showDeleteTask = true"/>
                            <img src="../image/icon/edit.svg" alt="edit" width="20" @click="showEditTask = true"/>
                        </div>
                    </div>
                    <img src="../image/icon/taskImage.svg"
                         class="w-11/12 flex justify-center items-center rounded-lg mx-auto"/>
                    <p class="font-bold m-4">Create styleguide foundation</p>
                    <p class=" m-4">{{ $task['description'] ?? 'Task Description' }}</p>
                </div>
{{--            @endforeach--}}
            <div class="mt-2 task ">
                <div class="p-3 rounded-lg shadow mb-2">
                    <svg @click="showAddTask = true" width="250" height="15" class="flex justify-center items-center mx-auto"
                         viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z" fill="#232360"/>
                    </svg>
                </div>
            </div>
        </div>
