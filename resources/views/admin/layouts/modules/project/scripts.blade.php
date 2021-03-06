<script>
  $(function(){
      $( document ).ready(function() {
		    	let random = Math.floor((Math.random() * 1000000) + 1);
		    	$('#code').val(random);
		    });
    
		    $('#code_reload').on('click',function(){
               let random = Math.floor((Math.random() * 1000000) + 1)
               $('#code').val(random);
        });

         window.addEventListener('from_lead_event', event => {
           $('#leadid').val(event.detail.lead_id);
        });
         window.addEventListener('from_client_event', event => {
           $('#clientid').val(event.detail.client_id);
        });
          $('#project_interval').daterangepicker({
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  }
            });

          $('#cancel_date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });

            $('#project_interval').on('change',function(){
               assignStartEnd();
            });
            $(document).ready(function(){
              assignStartEnd();
            });

        $('#print-invoice-button').on('click',function(){
            $('#invoice-print').printThis({
                printContainer: true,
                removeInline: false,
                importCSS: true,
            });
        });

              // Date Time with Format
		         function formattedDay(date)
		         {
		         var dd = String(date.getDate()).padStart(2, '0');
		         var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
		         var yyyy = date.getFullYear();
		         var h = String(date.getHours());
		         var m = String(date.getMinutes());
		         
		         date = yyyy + '/' + mm + '/' + dd + ' ' + h + ':' + m;
		         return date;
		         }

             // Assign First and Last Date
             function assignStartEnd()
             {
                var start_date = formattedDay(new Date($('#project_interval').data('daterangepicker').startDate));
                var end_date = formattedDay(new Date($('#project_interval').data('daterangepicker').endDate));
                $('#project_startdate').val(start_date);
                $('#project_deadline').val(end_date);
             }
    });
</script>