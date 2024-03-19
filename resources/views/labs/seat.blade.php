<x-app-layout>
    @include('labs.partials.stage', ['stage' => 'seat'])
    <div class="p-5 flex flex-col items-center">
        <h1 class="text-white text-5xl">Select Seat</h1>
        <p class="text-gray-100">Select the seat you are located in.</p>
        <p class="text-gray-100 text-sm">*Green = selecting; Red = unavailable; Gray = available.</p>
        <form action="{{route('select.seat')}}" method="post">
            @csrf
            @method("PATCH")
            <input type="hidden" name="seat_id" id="seat_id" required>
            <div class="p-5 m-5 flex flex-col justify-center gap-5 bg-gray-100 rounded">
                <div class="grid grid-rows-4 grid-flow-col gap-5">
                    @foreach($lab->room->seats as $seat)
                    @if($seat->user_id == NULL)
                    <button class="seat" type="button" onclick="select('{{ $seat->id }}')" value="{{ $seat->id }}">
                        <x-empty-seat-logo width="50px" height="50px"/>
                    </button>
                    @else
                    <x-used-seat-logo width="50px" height="50px"/>
                    @endif
                    @endforeach
                </div>
                <x-table-logo height="50px"/>
            </div>
            <x-primary-button>
                Select
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
<script>
    function select(id) {
        const base_rect = 183;
        const base_ellipse = 202;
        var seat_id = $('#seat_id');
        seat_id.val(id);
        $('.seat').each(function (_, seat) {
            var v = $(this).val()
            $(this).find('*').each(function (_, e) {
                var base = e.tagName == 'rect' ? base_rect : base_ellipse;
                var c = base + (v == id ? -100 : 0);
                e.style.fill = `rgb(${c}, ${base}, ${c}`;
            });
        });
    }
</script>
