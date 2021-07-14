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
         window.addEventListener('from_lead_event', event => {
           $('#clientid').val(event.detail.client_id);
        });
          $('#project_interval').daterangepicker({
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  }
            });

            $('#project_interval').on('change',function(){
               var start_date = formattedDay(new Date($(this).data('daterangepicker').startDate));
               var end_date = formattedDay(new Date($(this).data('daterangepicker').endDate));
               $('#project_startdate').val(start_date);
                $('#project_deadline').val(end_date);
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
    });
</script>