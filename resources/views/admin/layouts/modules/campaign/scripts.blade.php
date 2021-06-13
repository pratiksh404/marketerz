<script>
    $(function() {

        $('#send_type').on('change',function(){
            var send_type = $(this).val();
            if (parseInt(send_type) == 2) {
                $('#scheduled_time').show();
            } else {
                $('#scheduled_time').hide();
            }
        });

        $('#scheduled_time').daterangepicker({
            singleDatePicker: true,
            minDate: new Date(),
            locale: {
            format: 'YYYY/MM/DD'
            }
        });

        $('#campaign_info').on('change',function() {
            $('#campaign_info_card').toggle();
        });

        $(document).ready(function() {
            var type = $('#type').val();
            initializeMessage(type);
        });
        $('#channel').on('change', function() {
            var type = $(this).val();
            initializeMessage(type);
            initializeTemplate();
        });
            $(document).on('change', '#template', function() {
            var template_id = $(this).val();
            $.get('{{ route('get_template') }}', {
                    'template_id': template_id
                },
                function(data) {
                    clearMessage(data.template);
                    populateMessage(data.template);
                }
            );
        });

        function initializeTemplate()
        {
            var channel = $('#channel').val();
            $.get('{{ route('get_channel_templates') }}', {
                    'channel_id': channel
                },
                function(data) {
                    populateTemplates(data.templates);
                }
            );
        }

        function populateTemplates(templates) {
            if (templates != null) {
                var html = '';
                html += '<option selected disabled>Select Template ... </option>';
                $.each(templates, function(index, template) {
                    html += '<option value="' + template.id + '">' + template.name + '</option>';
                });
                $('#template').empty();
                $('#template').append(html);
            }
        }

        function populateMessage(template) {
            var type = template.type;
            if (type == "SMS") {
                $('textarea.body').val('');
                $('textarea.body').val(template.message);
            } else {
                CKEDITOR.instances['body'].insertHtml(template.message);
            }
        }

        function clearMessage(template) {
            var type = template.type;
            if (type == "SMS") {
                $('textarea.body').val('');
            } else {
                CKEDITOR.instances['body'].insertHtml('');
            }
        }
        
        function initializeMessage(type) {
            if (parseInt(type) == 2) {
                $('textarea.body').removeAttr('id');
                var body = CKEDITOR.instances.body;
              if (body) {
                  CKEDITOR.instances.body.updateElement();
                    CKEDITOR.instances.body.destroy();
              }
            } else if (parseInt(type) == 1) {
                CKEDITOR.replace('body', {
                    filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                    width: '100%'
                });
                $('textarea.body').attr('id', 'body');
            }
        }
    });

</script>