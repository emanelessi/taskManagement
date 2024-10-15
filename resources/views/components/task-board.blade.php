@foreach($tasks as $task)
    <div class=" lg:w-2/4 w-full task-group ">
        <div class="flex justify-between bg-white p-4 rounded-lg">
            <div class="flex space-x-2 px-2 ">
                <h2 class="text-md font-bold">{{ $task->category->name ?? 'Category' }}</h2>
                <h2 class="text-md font-bold text-tertiary">{{ $backlogCount ?? '0' }}</h2>
            </div>
            <div class="flex space-x-2 px-2 ">
                <img src="{{ asset('image/icon/dots.svg') }}" alt="dots" width="20"/>
            </div>
        </div>
        <div class="mt-2 tasks-list">
            <div class="bg-white p-3 rounded-lg shadow mb-2 task">
                <div class="flex justify-between my-3">
                    <h3 class="font-semibold bg-tertiary/30 w-1/2  flex items-center justify-center rounded-md"> {{ $task->priority ?? 'NON' }}</h3>
                    <div class="flex space-x-2 px-2 ">
                        <img src="../image/icon/delete.svg" alt="delete" width="15"/>
                        <img src="../image/icon/edit.svg" alt="edit" width="20"/>
                    </div>
                </div>
                @foreach($task->attachments as $attachment)
                    <img src="{{ asset('image/icon/' . $attachment->file_path) }}" alt="Attachment Image" class="m-4"/>
                @endforeach
                <div class="flex space-x-2 ">
                    <p class="bg-red-400  w-1/2 py-2 justify-center items-center rounded-md flex gap-2 text-white">
                        <img src="{{ asset('image/icon/hourglass.svg ') }}" alt="hourglass" class="w-4 h-4"/>
                        {{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</p>
                </div>
                <a href="{{ route('tasks.details', $task->id) }}" >
                  <p class="font-bold m-4 text-tertiary hover:underline">{{ $task->title ?? 'Task Title' }}</p>
                </a>
                <p class="m-4">{{ $task->description ?? 'Task Description' }}</p>
            </div>
        </div>
        <div class="mt-2  ">
            <div class="p-3 rounded-lg shadow mb-2">
                <svg width="250" height="15"
                     class="flex justify-center items-center mx-auto"
                     viewBox="0 0 9 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                          fill="#232360"/>
                </svg>
            </div>
        </div>
    </div>
@endforeach
