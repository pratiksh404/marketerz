<script>
    $(function(){
        $('#print-invoice-button').on('click',function(){
            $('#invoice-print').printThis({
                printContainer: true,
                removeInline: false,
               loadCSS: "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css",
            });
        });
    });
</script>