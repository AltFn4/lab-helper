<x-app-layout>
    @isset($inquiry)
    <div class="p-5 grid grid-cols-2 gap-5 text-white">
        <h1 class="text-3xl col-span-2">Request</h1>
        <div class="flex flex-col gap-2">
            <h2 class="text-xl">Code</h2>
            <div class="border-2 border-gray-500 rounded">
                <textarea name="code" id="codeTextarea">{{ $inquiry->code }}</textarea>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <h2 class="text-xl">Details</h2>
            <p>Type: {{ $inquiry->type }}</p>
            <div class="flex flex-col gap-2">
                <label for="request-desc">Description</label>
                <textarea name="desc" id="request-desc" cols="30" rows="5" class="bg-gray-800 rounded"
                    placeholder="Describe the context of the request...">{{ $inquiry->desc }}</textarea>
            </div>
            <form action="{{ route('inquiry.destroy') }}" method="POST">
                @csrf
                @method("DELETE")
                <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                <button class="p-2 m-2 bg-red-500 text-white rounded">Delete</button>
            </form>
        </div>
    </div>
    @else
    <p class="p-5 m-5 text-center text-gray-500">Request does not exist.</p>
    @endisset
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            if ("{{ Auth::check() }}") {                // Connect to Pusher.
                var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                    cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                });

                var codeTextarea = document.getElementById('codeTextarea');
                var editor = CodeMirror.fromTextArea(codeTextarea, {
                    lineNumbers: true,
                    mode: 'javascript',
                    theme: 'yonce',
                    styleActiveLine: true,
                    matchBrackets: true,
                });
                editor.on('change', function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('inquiry.update') }}",
                        method: 'PATCH',
                        data: {
                            'code': editor.getValue(),
                            'inquiry_id': "{{ $inquiry->id }}",
                        },
                        success: function(data) {
                            console.log('success!');
                        }
                    });
                });

                var channel = pusher.subscribe('inquiry-' + "{{ $inquiry->id }}");
                channel.bind('notify', function(data) {
                    var code = data.inquiry.code;
                    if (editor.getValue() != code) {
                        editor.getDoc().setValue(code);
                    }
                });
            }
        });
    </script>
</x-app-layout>
