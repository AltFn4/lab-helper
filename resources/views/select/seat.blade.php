<x-app-layout>
    <div class="p-5 flex flex-col items-center">
        <h1 class="text-white text-5xl">Select Seat</h1>
        <form action="{{route('select.seat')}}" method="post">
            @csrf
            @method("PATCH")
            <input type="hidden" name="seat_id" id="seat_id" required>
            <div class="p-5 m-5 flex flex-col justify-center gap-5 bg-gray-100 rounded">
                <div class="grid grid-rows-4 grid-flow-col gap-5">
                    @for($i = 0; $i < count($lab->seats); $i++)                
                    @if($lab->seats->sortBy('id')[$i]->user_id == NULL)
                    <button id="seat" name="{{ $lab->seats->sortBy('id')[$i]->id }}" type="button" onclick="select(this)">
                        <x-empty-seat-logo width="50px" height="50px"/>
                    </button>
                    @else
                    <x-used-seat-logo width="50px" height="50px"/>
                    @endif
                    @endfor
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
    var seat_id = document.getElementById("seat_id")
    function select(seat) {
        var seats = document.querySelectorAll("[id='seat']");
        seats.forEach(s => {
            var circle = s.getElementsByTagName("ellipse")[0];
            circle.style.fill = "white";
            if (seat == s) {
                circle.style.fill = "blue";
                seat_id.value = seat.name
            }
        });
    };
</script>