<script>
    $(function(){
   $(document).ready(function(){
       $.get('{{route('get_week_payment')}}',
       function(data){
           var days = [];
           var payments = [];

           $.each(data.weekly_payment,function(index,payment){
               days.push(index);
               payments.push(payment);
           })
             var optionslinechart = {
            chart: {
                toolbar: {
                    show: false
                },
                height: 170,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                show: false,
                categories: days,
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0,
                    bottom: -40
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.4,
                    inverseColors: false,
                    opacityFrom: 0.8,
                    opacityTo: 0.2,
                    stops: [0, 100]
                },
    
            },
            colors:[CubaAdminConfig.primary],
    
            series: [
                {
                    data: payments
                }
            ],
            tooltip: {
                x: {
                    format: 'yy/MM/dd HH:mm'
                }
            }
        };
    
        var chartlinechart = new ApexCharts(
            document.querySelector("#week-payment"),
            optionslinechart
        );
    
        chartlinechart.render();
       });

       $.get('{{route('get_monthly_payment')}}',
       function(data){
           var months = [];
           var payments = [];
           $.each(data.monthly_payment,function(index,payment){
               months.push(index);
               payments.push(payment);
           })
             var optionslinechart2 = {
            chart: {
                toolbar: {
                    show: false
                },
                height: 170,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                show: false,
                categories: months,
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0,
                    bottom: -40
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.4,
                    inverseColors: false,
                    opacityFrom: 0.8,
                    opacityTo: 0.2,
                    stops: [0, 100]
                },
    
            },
            colors:[CubaAdminConfig.primary],
    
            series: [
                {
                    data: payments
                }
            ],
            tooltip: {
                x: {
                    format: 'yy/MM/dd HH:mm'
                }
            }
        };
    
        var chartlinechart2 = new ApexCharts(
            document.querySelector("#monthly-payment"),
            optionslinechart2
        );
    
        chartlinechart2.render();
        });    
   });
    });
</script>