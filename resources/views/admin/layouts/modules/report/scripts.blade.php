<script>
    $(function(){
        $('#print-invoice-button').on('click',function(){
                $('#invoice-print').printThis({
                printContainer: true,
                removeInline: false,
                loadCSS: "{{asset('adminetic/assets/css/vendors/bootstrap.css')}}",
                });
        });
    });
</script>