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

        $('#contact_date').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });
    });
</script>