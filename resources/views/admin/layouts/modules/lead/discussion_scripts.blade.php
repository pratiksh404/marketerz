<script>
    $(function(){

        $(document).ready(function(){
            reminderCheck();
        });

        $('#discussion_date').daterangepicker({
             parentEl: "#create_lead_discussion",
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });

        $('#deadline_date_time').daterangepicker({
             parentEl: "#create_lead_discussion",
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });
        $('#reminder_datetime').daterangepicker({
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
                    $('#reminder_datetime').removeAttr('disabled');
                    $('#chk-ani1').removeAttr('disabled');
                    $('#chk-ani2').removeAttr('disabled');
                    $('#chk-ani3').removeAttr('disabled');
                    $('#chk-anii4').removeAttr('disabled');
                } else {
                    $('#reminder_datetime').prop('disabled',true);
                            $('#chk-ani1').prop('disabled',true);
                            $('#chk-ani2').prop('disabled',true);
                            $('#chk-ani3').prop('disabled',true);
                            $('#chk-ani4').prop('disabled',true);
                }
            }
    });
</script>