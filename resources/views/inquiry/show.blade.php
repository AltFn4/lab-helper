<x-app-layout>
    @isset($inquiry)
    <div class="grid grid-cols-2 gap-5 p-5 text-white">
        <h1 class="col-span-2 text-3xl">Request</h1>

        @include('inquiry.partials.editor', ['code' => $inquiry->code])

        <div class="flex flex-col gap-2">
            <h2 class="text-xl">Details</h2>
            @if(Auth::user()->hasRole('student'))
            @include('layouts.partials.status')
            @elseif(Auth::user()->hasRole('assistant'))
            @include('layouts.partials.info', ['student' => $inquiry->student])
            @endif
            <p>Type: {{ $inquiry->type }}</p>
            <p>Description: {{ $inquiry->desc ?? "(Not provided)" }}</p>
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
        var code = "";

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

                var codeTextarea = $('#codeTextarea')[0];
                var editor = CodeMirror.fromTextArea(codeTextarea, {
                    lineNumbers: true,
                    mode: 'javascript',
                    theme: 'yonce',
                    styleActiveLine: true,
                    matchBrackets: true,
                    indentWithTabs: true,
                    indentUnit: 4,
                    autoCloseTags: true,
                    autoCloseBrackets: true,
                    readOnly: !canEdit,
                });

                var languageMode = $('#languageMode');
                languageMode.change(function() {
                    editor.setOption('mode', languageMode.val());
                });


                var isUpdate = false;

                editor.on('change', function() {
                    if (isUpdate) return;
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
                    var code = data.code;
                    var current = data.current;
                    var max = data.max;
                    var assignee = data.assignee == null ? 'N/A' : data.assignee;
                    var status = data.assignee == null ? 'In Queue': 'Reviewing';

                    if (author_id == -1) { // System event.
                        $('#status').text(status);
                        $('#assignee').text(assignee);

                        if (current == null && max == null) { // Updated assignee.
                            $('#position').text('-/-');
                        } else { // Updated queue position.
                            $('#position').text(`${current}/${max}`);
                            $('#position').css('width', `${100 * current / max}%`);
                        }
                    }else if (editor.getValue() != code && user_id != author_id) { // Update code.
                        console.log(author_id);
                        setTimeout(() => {
                            isUpdate = true;
                            var cursor = editor.getCursor();
                            editor.getDoc().setValue(code);
                            editor.setCursor(cursor);
                        }, 500);
                    };
                });
            }
        });
    </script>
</x-app-layout>
