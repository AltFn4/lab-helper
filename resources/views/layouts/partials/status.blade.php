<section>
    <p id="status"></p>

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
                    $('#status').hide();
                } else if (statusCode == 201) {
                    var assignee = data.assignee;
                    var text = `Assignee: ${assignee}`;
                    $('#status').text(text);
                } else {
                    var current = data.current;
                    var max = data.max;
                    var text = `Position: ${current}/${max}`;
                    $('#status').text(text);
                }
            },
            error: function(error) {
                $('#status').hide();
            }
        });
    </script>
</section>
