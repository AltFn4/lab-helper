<section class="p-2 bg-gray-500 rounded shadow-md">
    <div class="flex flex-row gap-2">
        <div class="flex flex-col gap-2">
            <p class="p-2 text-center text-white bg-gradient-to-b from-indigo-500 to-indigo-600 rounded-md">Student name</p>
            <p class="p-2 text-center text-white bg-gradient-to-b from-indigo-600 to-indigo-700 rounded-md">Seat no</p>
        </div>
        <div class="flex flex-col gap-2">
            <p class="p-2 text-gray-800">{{ $student->name }}</p>
            <p class="p-2 text-gray-800">{{ $student->seat->id }}</p>
        </div>
    </div>

    <div>
        <button id="seat-btn" class="text-gray-400 underline">toggle seat</button>
        <span class="flex">
            <div id="seat-plan" class="hidden p-2 bg-gray-500 rounded shadow-md">
                <span class="grid grid-rows-4 grid-flow-col gap-1 justify-between">
                    @foreach($student->lab->room->seats as $seat)
                    @if($seat->id == $student->seat->id)
                    <x-used-seat-logo width="20" height="20"></x-used-seat-logo>
                    @else
                    <x-empty-seat-logo width="20" height="20"></x-empty-seat-logo>
                    @endif
                    @endforeach
                </span>
            </div>
        </span>
    </div>

    <script>
        var btn = $('#seat-btn');
        btn.click(function toggle() {
            var seatPlan = $('#seat-plan');
            seatPlan.toggle();
        });
    </script>
</section>
