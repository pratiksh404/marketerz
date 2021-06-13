<script>
    $(function() {
        $(document).ready(function() {
            var type = $('#type').val();
            initializeMessage(type);
        });
        $('#type').on('change', function() {
            var type = $(this).val();
            initializeMessage(type);
        });

        function initializeMessage(type) {
            if (parseInt(type) == 2) {
                $('textarea.message').removeAttr('id');
                CKEDITOR.instances.message.updateElement();
                CKEDITOR.instances.message.destroy();
            } else if (parseInt(type) == 1) {
                CKEDITOR.replace('message', {
                    filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                    width: '100%'
                });
                $('textarea.message').attr('id', 'message');
            }
        }
    });

</script>