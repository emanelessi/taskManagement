<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="min-w-full bg-white">
        <thead class="bg-secondary/20 border-b border-quaternary/30">
        <tr>
            @foreach($headers as $header)
                <th class="px-6 py-3 text-left text-sm font-medium text-black uppercase tracking-wider">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
        </thead>
        <tbody class="divide-y divide-quaternary/30">
        @foreach($rows as $row)
            <tr>
                @foreach($row as $key => $cell)
                    @if ($key === 1)
                    <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($cell == 'enable'|| $cell == 'Completed'|| $cell == 'Medium') bg-green-100 text-green-800
                                    @elseif ($cell == 'disable'|| $cell == 'Cancelled'|| $cell == 'Delayed'|| $cell == 'High') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ $cell }}
                                </span>
                    </td>
                    @elseif ($headers[$key] === "Actions")
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        {!! $cell !!}
                    </td>
                    @else
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-black/80">   {!! $cell !!}</div>
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
