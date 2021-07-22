<script>
    $(function(){
        $('#print-invoice-button').on('click',function(){
            $('#invoice-print').printThis({
                printContainer: true,
                removeInline: false,
                importCSS: true,
            });
        });
    });
</script>