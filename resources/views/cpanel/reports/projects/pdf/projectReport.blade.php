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
            Project Name
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Status
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Start Date
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Deadline
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Cost
        </th>
        <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
            Created By
        </th>
    </tr>
    </thead>
    <tbody class="divide-y divide-quaternary/30">
    @foreach ($projects as $project)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium   w-1-6 break-words">
                {{ $project->name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  w-1-6 break-words">
                {{ $project->status->name ?? '-'}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  w-1-6 break-words">
                {{  $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('Y-m-d'):"-" }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  w-1-6 break-words">
                {{  $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') :"-"}}
            </td>

            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  w-1-6 break-words">
                {{ $project->cost ?? '-'}}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  w-1-6 break-words">
                {{ $project->user->name ?? '-'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
