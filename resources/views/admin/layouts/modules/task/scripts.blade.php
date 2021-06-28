<script>
    $(function(){

        $(document).ready(function(){
            reminderCheck();
        });

        $('#deadline_date_time').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });
        $('#reminder_date_time').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });
        
            $('#chk-ani').on('change',function(){
              reminderCheck();
            });

            function reminderCheck()
            {
                if ($('#chk-ani').is(":checked")) {
                    $('#reminder_date_time').removeAttr('disabled');
                    $('#chk-ani1').removeAttr('disabled');
                    $('#chk-ani2').removeAttr('disabled');
                    $('#chk-ani3').removeAttr('disabled');
                    $('#chk-ani14').removeAttr('disabled');
                } else {
                    $('#reminder_date_time').prop('disabled',true);
                            $('#chk-ani1').prop('disabled',true);
                            $('#chk-ani2').prop('disabled',true);
                            $('#chk-ani3').prop('disabled',true);
                            $('#chk-ani4').prop('disabled',true);
                }
            }
    });
</script>