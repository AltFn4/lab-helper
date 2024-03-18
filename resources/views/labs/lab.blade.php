<x-app-layout>
    @include('labs.partials.stage', ['stage' => 'lab'])
    <div class="p-5 m-5 grid grid-cols-1 gap-5">
        <h1 class="text-white text-5xl">Select Lab</h1>
        <p class="text-gray-100">Select the lab you are located in.</p>

        <input type="text" id="searchBar" class="rounded" onkeyup="search()" placeholder="search...">

        @foreach ($labs as $lab)
        <form action="{{route('select.lab')}}" method="post" id="lab-{{ $lab->id }}" class="lab">
            @csrf
            @method("POST")
            <input type="hidden" class="moduleName" value="{{ $lab->module->name }}">
            <input type="hidden" name="lab_id" value="{{ $lab->id }}">
            <div class="p-5 bg-gray-700 text-gray-100 rounded">
                <h2 class="text-3xl">{{ $lab->module->name }}</h2>
                <p>Room: {{ $lab->room->name }}</p>
                <p>Start time: {{ $lab->start_time }}</p>
                <p>Duration: {{ $lab->duration }} hour{{ $lab->duration > 1 ? "s" : "" }}</p>
                <x-primary-button>
                    Select
                </x-primary-button>
            </div>
        </form>
        @endforeach

        <script>
            function search() {
                var searchBar = $('#searchBar');
                var pattern = searchBar.val().toUpperCase();

                $('.lab').each(function (_, lab) {
                    var moduleName = $(this).children('.moduleName').val().toUpperCase();
                    this.style.display = moduleName.includes(pattern) ? 'block' : 'none';
                });
            }
        </script>
    </div>
</x-app-layout>
