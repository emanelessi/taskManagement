@props(['project', 'tasks' ])

@foreach($tasks as $categoryId => $taskGroup)
    @php
        $categoryName = $taskGroup->first()->category->name ?? 'Category';
    @endphp
    <div class="lg:w-2/4 w-full task-group" data-category-id="{{ $categoryId }}">
        <div class="flex justify-between bg-secondary/10  p-4 rounded-lg">
            <div class="flex space-x-2 px-2">
                <h2 class="text-md font-bold">{{ $categoryName }}</h2>
                <h2 class="text-md font-bold text-tertiary">{{ $taskGroup->count() }}</h2>
            </div>
            <div class="flex space-x-2 px-2">
                <img src="{{ asset('image/icon/dots.svg') }}" alt="dots" width="20"/>
            </div>
        </div>
        <div class="mt-2 tasks-list">
            @foreach($taskGroup as $task)
                <div class="bg-sky-light/10  p-3 rounded-lg shadow mb-2 task" data-task-id="{{ $task->id }}">
                    @if($task->attachments->isNotEmpty())
                        @php
                            $latestAttachment = $task->attachments->sortByDesc('created_at')->first();
                        @endphp
                        <img src="{{ asset('storage/' . $latestAttachment->file_path) }}" alt="Latest Attachment Image"
                             class="flex justify-center m-4 mx-auto w-1/2 h-1/2"/>
                    @else
                        <p></p>
                    @endif
                        <div class="flex gap-6 justify-between ">
                            @if($task->priority == 'High')
                                <p class="bg-red-300 text-sm flex   items-center justify-center rounded-md w-1/2"> {{ $task->priority ?? 'NON' }}</p>
                            @elseif($task->priority == 'Medium')
                                    <p class="bg-tertiary/30 text-sm flex items-center justify-center rounded-md w-1/2"> {{ $task->priority ?? 'NON' }}</p>
                            @else
                                <p class="bg-amber-200 text-sm flex  items-center justify-center rounded-md w-1/2"> {{ $task->priority ?? 'NON' }}</p>
                            @endif
                        <p class="bg-red-600 w-1/2 py-1 text-sm justify-center items-center rounded-md flex gap-2 text-white">
                            <img src="{{ asset('image/icon/hourglass.svg') }}" alt="hourglass" class="w-4 h-4"/>
                            {{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}
                        </p>
                    </div>
                    @if(auth()->user()->can('view task details', $task))
                        <a href="{{ route('tasks.details', $task->id) }}">
                            <p class="font-bold m-4 text-tertiary hover:underline">{{ $task->title ?? 'Task Title' }}</p>
                        </a>
                    @else
                        <p class="font-bold m-4 text-tertiary">{{$task->title ?? 'Task Title' }}</p>
                    @endif

                    <p class="m-4 break-words">{{ Str::limit($task->description, 50) ?? 'Task Description' }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-2 ">
            <div class="p-3 bg-secondary/5  rounded-lg shadow mb-2 addTaskBtn" data-category-id="{{ $categoryId }}"
                 data-project-id="{{ $project->id ?? '' }}">
                <svg width="250" height="15" class="flex justify-center items-center mx-auto" viewBox="0 0 9 8"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.96 5.064V3.64H3.984V0.808H5.456V3.64H8.48V5.064H5.456V7.912H3.984V5.064H0.96Z"
                          fill="#232360"/>
                </svg>
            </div>
        </div>
    </div>
@endforeach


