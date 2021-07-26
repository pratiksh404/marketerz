<script>
    $(function(){
        $('#print-report-button').on('click',function(){
                $('#report-print').printThis({
                printContainer: true,
                removeInline: false,
                loadCSS: "{{asset('adminetic/assets/css/vendors/bootstrap.css')}}",
                });
        });
        $('#print-monthly-report-button').on('click',function(){
                $('#monthly-report-print').printThis({
                printContainer: true,
                removeInline: false,
                loadCSS: "{{asset('adminetic/assets/css/vendors/bootstrap.css')}}",
                });
        });
        $('#print-yearly-report-button').on('click',function(){
                $('#yearly-report-print').printThis({
                printContainer: true,
                removeInline: false,
                loadCSS: "{{asset('adminetic/assets/css/vendors/bootstrap.css')}}",
                });
        });
    });
</script>