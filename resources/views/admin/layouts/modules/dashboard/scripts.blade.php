<script>
    $(function(){
        $(document).ready(function(){
            $('#calender').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                  locale: {
                 format: 'YYYY-MM-DD'
                  },
            });
               $('#project_calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($projects as $project)
                {
                    title : '{{ $project->name ?? ('#'.$project->code) }}',
                    start : '{{ $project->project_startdate }}',
                    end : '{{ $project->project_deadline }}',
                    url : '{{ adminShowRoute('project', $project->id) }}',
                    color: '{{ $project->color }}'
                },
                @endforeach
            ]
        })

        // Monthly Payment vs Advance vs Return Column Chart
        $.get('{{route('monthly_payment_advance_return')}}',
        function(data){
            var months = [];
            var payments = [];
            var advances = [];
            var returns = [];

            $.each(data.monthly_payment,function(index,payment){
                months.push(index);
                payments.push(payment);
            });
            $.each(data.monthly_advance,function(index,advance){
                advances.push(advance);
            });
            $.each(data.monthly_return,function(index,returnn){
                returns.push(returnn);
            });
           var monthly_payment_advance_return_options = {
               chart: {
                   height: 350,
                   type: 'bar',
                   toolbar:{
                     show: false
                   }
               },
               plotOptions: {
                   bar: {
                       horizontal: false,
                       endingShape: 'rounded',
                       columnWidth: '55%',
                   },
               },
               dataLabels: {
                   enabled: false
               },
               stroke: {
                   show: true,
                   width: 2,
                   colors: ['transparent']
               },
               series: [{
                   name: 'Payments',
                   data: payments
               }, {
                   name: 'Returns',
                   data: returns
               }, {
                   name: 'Advances',
                   data: advances
               }],
               xaxis: {
                   categories: months
               },
               yaxis: {
                   title: {
                       text: 'Rs.'
                   }
               },
               fill: {
                   opacity: 1
           
               },
               tooltip: {
                   y: {
                       formatter: function (val) {
                           return "Rs " + val
                       }
                   }
               },
               colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
           }
           
           var monthly_payment_advance_return = new ApexCharts(
               document.querySelector("#column-monthly-payment-advance-return-chart"),
               monthly_payment_advance_return_options
           );
           
           monthly_payment_advance_return.render();
        });

        // Debit VS Credit
        $.get('{{route('get_debit_credit')}}',function(data){
            var debit_credit_option = {
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: ['Debit', 'Credit'],
                    series: [data.debit, data.credit],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#ff3300', '#33cc33']
                }
                
                var debit_credit = new ApexCharts(
                    document.querySelector("#debit-credit"),
                    debit_credit_option
                );
                
                debit_credit.render();
        });

        // Weekly Payments
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
            
        });
    });
</script>