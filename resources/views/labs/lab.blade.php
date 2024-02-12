<x-app-layout>
    @include('labs.partials.stage', ['stage' => 'lab'])
    <div class="p-5 flex flex-col gap-5 items-center">
        <h1 class="text-white text-5xl">Select Lab</h1>
        <form action="{{route('select.lab')}}" method="post">
            @csrf
            @method("POST")
            @if(session('message'))
            <p class="p-2 bg-red-600 text-gray-300 rounded">
                {{ session('message') }}
            </p>
            @endif
            <select name="id" size="5" class="p-5 m-5 bg-gray-700 rounded text-gray-100" required>
                @foreach ($labs as $lab)
                <option value="{{ $lab->id }}">
                    {{ $lab->name }}
                </option>
                @endforeach
            </select>
            <x-primary-button>
                Select
            </x-primary-button>
        </form>
    </div>
</x-app-layout>