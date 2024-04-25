<section id="request-status" class="p-2 bg-gray-500 rounded">
    <div class="flex flex-col gap-5">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col gap-2">
                <p class="p-2 text-center text-white bg-gradient-to-b from-indigo-500 to-indigo-600 rounded-md">Status</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-indigo-600 to-indigo-700 rounded-md">Assignee</p>
                <p class="p-2 text-center text-white bg-gradient-to-b from-indigo-700 to-indigo-800 rounded-md">Time elapsed</p>
            </div>
            <div class="flex flex-col gap-2">
                <p id="status" class="p-2 text-gray-800">N/A</p>
                <p id="assignee" class="p-2 text-gray-800">N/A</p>
                <p class="p-2 text-gray-800">{{ Auth::user()->inquiry->created_at->diffInMinutes(Carbon\Carbon::now()) }} mins</p>
            </div>
        </div>
        <span id="position-bar">
            <div class="bg-gray-700 border-2 border-gray-700 rounded-full">
                <div id="position" class="bg-green-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full">-/-</div>
            </div>
        </span>
    </div>
    <script>
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('inquiry.status') }}",
            method: 'GET',
            data: {},
            success: function(data, _, xhr) {
                var statusCode = xhr.status;
                if (statusCode == 200) {
                    $('#request-status').hide();
                } else if (statusCode == 201) {
                    var assignee = data.assignee;
                    $('#status').text("Reviewing");
                    $('#assignee').text(assignee);
                } else {
                    var current = data.current;
                    var max = data.max;

                    $('#status').text("In Queue");
                    $('#position').text(`${current}/${max}`);
                    $('#position').css('width', `${100 * current / max}%`);
                }
            },
            error: function(error) {
                $('#request-status').hide();
            }
        });
    </script>
</section>
