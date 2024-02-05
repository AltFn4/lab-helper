<x-app-layout>
    <div class="p-5 flex flex-col items-center">
        @if (session('message'))
        <p class="alert">{{ session('message') }}</p>
        @endif
        <h1 class="text-white text-5xl">Select Lab</h1>
        <form action="{{route('select.lab')}}" method="post">
            @csrf
            @method("POST")
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