<x-app-layout>
    @isset($inquiry)
    <div class="grid grid-cols-2 gap-5 p-5 text-white">
        <h1 class="col-span-2 text-3xl">Request</h1>
        <div class="flex flex-col gap-2">
            <h2 class="text-xl">Code</h2>
            <div class="rounded border-2 border-gray-500">
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
                <x-primary-button>Assign</x-primary-button>
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
            <div>
                <x-danger-button id="activate-btn" type="button">
                    Delete
                </x-danger-button>
            </div>
            <x-confirm-prompt route="{{ route('inquiry.destroy') }}" message="Are you sure you want to delete the request?">
                <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
            </x-confirm-prompt>
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
                            var cursor = editor.getCursor();
                            editor.getDoc().setValue(code);
                            editor.setCursor(cursor);
                        }, 500)
                    };
                });
            }
        });
    </script>
</x-app-layout>
