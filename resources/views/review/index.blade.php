<x-app-layout>
    <div class="p-5 m-5">
        <div>
            <p class="text-5xl text-white text-center">
                Submissions
            </p>
        </div>
        <div class="p-5 bg-gray-500 text-white rounded">
            <ul>
                @foreach($submissions as $submission)
                <li>
                    <a href="{{ route('review') }}">{{ $submission->user->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>