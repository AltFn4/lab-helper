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
            @if($inquiry->assistant == NULL)
            <p id="position">Position: -/-</p>
            @endif
            <p>Type: {{ $inquiry->type }}</p>
            <p>Description: {{ $inquiry->desc }}</p>
            @if($inquiry->link != NULL)
            <label for="link">Link:</label>
            <a name="link" class="text-cyan-300" href="{{ $inquiry->link }}" target="_blank">
                <img width="16" height="16" src="{{ $inquiry->link }}/favicon.ico" alt="Link">
            </a>
            @endif
            @if($inquiry->assistant == NULL && Auth::user()->hasRole('assistant'))
            <form action="{{ route('inquiry.assign') }}" method="POST">
                @csrf
                @method("PATCH")
                <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                <x-primary-button>Assign</x-primary-butto>
            </form>
            @elseif($inquiry->student->id == Auth::user()->id || $inquiry->assistant->id == Auth::user()->id)
            @if(Auth::user()->hasRole('assistant'))
            <form action="{{ route('inquiry.signoff') }}" method="POST">
                @csrf
                @method("POST")
                <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                <x-secondary-button type="submit">Sign-off</x-secondary-button>
            </form>
            @endif
            <form action="{{ route('inquiry.destroy') }}" method="POST">
                @csrf
                @method("DELETE")
                <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                <x-danger-button>Delete</x-danger-button>
            </form>
            @endif
        </div>
    </div>
    @else
    <p class="p-5 m-5 text-center text-gray-500">Request does not exist.</p>
    @endisset
    <script>
        const params = new URLSearchParams(window.location.search);
        var id = params.get('inquiry_id');
        var user_id = "{{ Auth::user()->id }}";
        var student_id = null;
        var assistant_id = null;

        if ("{{ isset($inquiry) }}") {
            id = "{{ $inquiry->id }}";
            student_id = "{{ $inquiry->student_id }}";
            assistant_id = "{{ $inquiry->assistant_id }}";
        }

        var canEdit = (user_id == student_id || user_id == assistant_id);

        document.addEventListener("DOMContentLoaded", function() {
            if (id) {
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
                    readOnly: !canEdit,
                });

                editor.on('change', function() {
                    setTimeout(() => {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('inquiry.update') }}",
                            method: 'PATCH',
                            data: {
                                'code': editor.getValue(),
                                'inquiry_id': id,
                            },
                            success: function(data) {
                                console.log('success!');
                            }
                        })
                    }, 500);
                });

                var channel = pusher.subscribe('inquiry-' + id);
                channel.bind('notify', function(data) {
                    var author_id = data.author_id;
                    var current_pos = data.current_pos;
                    var max_pos = data.max_pos;
                    var inq = data.inquiry;
                    var code = inq.code;

                    $('#position').text('Position: ' + (1 + current_pos) + '/' + max_pos);

                    if (editor.getValue() != code && user_id != author_id) {
                        setTimeout(() => {
                            editor.getDoc().setValue(code);
                        }, 500)
                    };
                });
            }
        });
    </script>
</x-app-layout>
