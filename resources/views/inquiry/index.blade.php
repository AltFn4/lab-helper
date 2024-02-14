<x-app-layout>
    <div class="p-5 m-5 text-white">
        <h2 class="text-3xl">Requests</h2>
        <div>
            <table class="border-4 border-gray-800 w-full">
                <tr class="bg-gray-500 border-2 border-gray-800">
                    <th class="border-2 border-gray-800">name</th>
                    <th class="border-2 border-gray-800">type</th>
                    <th class="border-2 border-gray-800">wait time</th>
                    <th></th>
                </tr>

                @foreach($inquiries as $inquiry)
                <tr class="border-2 border-gray-800 hover:bg-gray-600">
                    <td class="border-2 border-gray-800">{{ $inquiry->user->name }}</td>
                    <td class="border-2 border-gray-800">{{ $inquiry->type }}</td>
                    <td class="border-2 border-gray-800">{{ $inquiry->created_at->diffInMinutes(Carbon\Carbon::now()) }} mins</td>
                    <td>
                        <a href="{{ route('inquiry.edit', ['inquiry_id' => $inquiry->id]) }}">Inspect</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>