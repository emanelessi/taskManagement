<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            direction: rtl;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
        }

        .w-1-6 {
            width: 16.6667%;
        }

        .break-words {
            word-break: break-word;
        }

    </style>
</head>
<body>


<table>
    <thead>
    <tr>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            title
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            content
        </th>
    </tr>
    </thead>
    <tbody class="divide-y divide-quaternary/30">
    <tr>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
            {{ $title }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  w-1-6 break-words">
            {{ $content }}</td>
    </tr>
    </tbody>
</table>

<table>
    <thead>
    <tr>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            ID
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Task Title
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Priority
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Start Date
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Completed Date
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Category
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Status
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Project
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Assigned To
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($tasks as $task)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->title }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->priority }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->completed_at ? \Carbon\Carbon::parse($task->completed_at)->format('Y-m-d') : '-' }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->category->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->status->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->project->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $task->user->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
