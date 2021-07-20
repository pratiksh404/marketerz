<script>
    $(function(){
        $(document).ready(function(){
              $.get('{{route('get_client_sms_email_count')}}',
              {
                  'client_id': $('#client_daily_email_sms_count').data('client_id')
              },
             function(data){
                var days = [];
               var email_counts = [];
               var sms_counts = [];
               $.each(data.sms_email_count,function(index,count){
               days.push(index);
               email_counts.push(count.email);
               sms_counts.push(count.sms);
               })
        var optionsproductchart = {
          chart: {
              height: 320,
              type: 'line'
          },
          stroke: {
              curve: 'smooth'
          },
      
          series: [{
              name: 'SMS',
              type: 'area',
              data: sms_counts
          }, {
              name: 'Email',
              type: 'line',
              data: email_counts
          }],
          fill: {
              colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
              type: 'gradient',
              gradient: {
                  shade: 'light',
                  type: 'vertical',
                  shadeIntensity: 0.4,
                  inverseColors: false,
                  opacityFrom: 0.9,
                  opacityTo: 0.8,
                  stops: [0, 100]
              }
          },
      
          colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
          labels: days,
          markers: {
              size: 0
          },
          yaxis: [
              {
                  title: {
                      text: 'SMS'
                  }
              },
              {
                  opposite: true,
                  title: {
                      text: 'Email'
                  }
              }
          ],
          tooltip: {
              shared: true,
              intersect: false,
              y: {
                  formatter: function (y) {
                      if(typeof y !== "undefined") {
                          return  y.toFixed(0) + " points";
                      }
                      return y;
      
                  }
              }
          }
      
      }
      
      var chartproductchart = new ApexCharts(
          document.querySelector("#client_daily_email_sms_count"),
          optionsproductchart
      );
      chartproductchart.render();
       });

            $.get('{{route('get_client_sms_email_count')}}',
              {
                  'client_id': $('#client_monthly_email_sms_count').data('client_id'),
                  'period': 30
              },
             function(data){
                var days = [];
               var email_counts = [];
               var sms_counts = [];
               $.each(data.sms_email_count,function(index,count){
               days.push(index);
               email_counts.push(count.email);
               sms_counts.push(count.sms);
               })
        var optionsproductchart = {
          chart: {
              height: 320,
              type: 'line'
          },
          stroke: {
              curve: 'smooth'
          },
      
          series: [{
              name: 'SMS',
              type: 'area',
              data: sms_counts
          }, {
              name: 'Email',
              type: 'line',
              data: email_counts
          }],
          fill: {
              colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
              type: 'gradient',
              gradient: {
                  shade: 'light',
                  type: 'vertical',
                  shadeIntensity: 0.4,
                  inverseColors: false,
                  opacityFrom: 0.9,
                  opacityTo: 0.8,
                  stops: [0, 100]
              }
          },
      
          colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
          labels: days,
          markers: {
              size: 0
          },
          yaxis: [
              {
                  title: {
                      text: 'SMS'
                  }
              },
              {
                  opposite: true,
                  title: {
                      text: 'Email'
                  }
              }
          ],
          tooltip: {
              shared: true,
              intersect: false,
              y: {
                  formatter: function (y) {
                      if(typeof y !== "undefined") {
                          return  y.toFixed(0) + " points";
                      }
                      return y;
      
                  }
              }
          }
      
      }
      
      var chartproductchart = new ApexCharts(
          document.querySelector("#client_monthly_email_sms_count"),
                  optionsproductchart
          );
          chartproductchart.render();
        });
        
        $.get('{{route('get_client_monthly_sms_email_count')}}',
        {
            'client_id': $('#get_client_monthly_sms_email_count').data('client_id')
        },
        function(data){
            var months = [];
            var email_counts = [];
            var sms_counts = [];
            $.each(data.sms_email_count,function(index,count){
            months.push(index);
            email_counts.push(count.email);
            sms_counts.push(count.sms);
            })
        // column chart
        var options3 = {
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
                name: 'Email',
                data: email_counts
            }, {
                name: 'SMS',
                data: sms_counts
            }],
            xaxis: {
                categories: months
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
        
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " unit"
                    }
                }
            },
            colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
        }
        
        var chart3 = new ApexCharts(
            document.querySelector("#get_client_monthly_sms_email_count"),
            options3
        );
        
        chart3.render();
       });

         $.get('{{route('get_client_sms_email_count')}}',
              {
                  'client_id': $('#client_daily_email_sms_count').data('client_id')
              },
             function(data){
                var days = [];
               var email_counts = [];
               var sms_counts = [];
               $.each(data.sms_email_count,function(index,count){
               days.push(index);
               email_counts.push(count.email);
               sms_counts.push(count.sms);
               })
        var optionsproductchart = {
          chart: {
              height: 320,
              type: 'line'
          },
          stroke: {
              curve: 'smooth'
          },
      
          series: [{
              name: 'SMS',
              type: 'area',
              data: sms_counts
          }, {
              name: 'Email',
              type: 'line',
              data: email_counts
          }],
          fill: {
              colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
              type: 'gradient',
              gradient: {
                  shade: 'light',
                  type: 'vertical',
                  shadeIntensity: 0.4,
                  inverseColors: false,
                  opacityFrom: 0.9,
                  opacityTo: 0.8,
                  stops: [0, 100]
              }
          },
      
          colors:[CubaAdminConfig.primary, CubaAdminConfig.secondary],
          labels: days,
          markers: {
              size: 0
          },
          yaxis: [
              {
                  title: {
                      text: 'SMS'
                  }
              },
              {
                  opposite: true,
                  title: {
                      text: 'Email'
                  }
              }
          ],
          tooltip: {
              shared: true,
              intersect: false,
              y: {
                  formatter: function (y) {
                      if(typeof y !== "undefined") {
                          return  y.toFixed(0) + " points";
                      }
                      return y;
      
                  }
              }
          }
      
      }
      
      var chartproductchart = new ApexCharts(
          document.querySelector("#client_daily_email_sms_count"),
          optionsproductchart
      );
      chartproductchart.render();
       });

       // Payment Charts
       dailyClientPayment();
       monthlyClientPayment();
       dailyClientAdvance();
       monthlyClientAdvance();

              });
          });

    function dailyClientPayment()
    {
              $.get('{{route('daily_client_payment')}}',
              {
                  'client_id': $('#daily_client_payment').data('client_id'),
                  'limit': 7
              },
             function(data){
                var days = [];
                var payments = [];

                $.each(data.daily_client_payment,function(day,payment){
                   days.push(day);
                   payments.push(payment);
                });
               var options = {
                 chart: {
                     height: 350,
                     type: 'area',
                     zoom: {
                         enabled: false
                     },
                     toolbar:{
                       show: false
                     }
                 },
                 dataLabels: {
                     enabled: false
                 },
                 stroke: {
                     curve: 'straight'
                 },
                 series: [{
                     name: "Payments",
                     data: payments
                 }],
                 title: {
                     text: 'Daily',
                     align: 'left'
                 },
                 subtitle: {
                     text: 'Client Payments',
                     align: 'left'
                 },
                 labels: days,
                 xaxis: {
                     type: 'datetime',
                 },
                 yaxis: {
                     opposite: true
                 },
                 legend: {
                     horizontalAlign: 'left'
                 },
                 colors:[ CubaAdminConfig.primary ]
             
             }
             
                 var chart = new ApexCharts(
                     document.querySelector("#daily_client_payment"),
                     options
                 );
                 
                 chart.render();
                    });
    }

    function monthlyClientPayment()
    {
           $.get('{{route('monthly_client_payment')}}',
        {
            'client_id': $('#monthly_client_payment').data('client_id')
        },
        function(data){
            var months = [];
            var payments = [];
            $.each(data.monthly_client_payment,function(index,payemnt){
            months.push(index);
            payments.push(payemnt);
            })
        // column chart
        var options3 = {
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
                name: 'Payment',
                data: payments
            }],
            xaxis: {
                categories: months
            },
            yaxis: {
                title: {
                    text: 'Rs'
                }
            },
            fill: {
                opacity: 1
        
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " Rupees"
                    }
                }
            },
            colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
        }
        
        var monthly_client_payment = new ApexCharts(
            document.querySelector("#monthly_client_payment"),
            options3
        );
        
        monthly_client_payment.render();
       });
    }
    function dailyClientAdvance()
    {
              $.get('{{route('daily_client_advance')}}',
              {
                  'client_id': $('#daily_client_advance').data('client_id'),
                  'limit': 7
              },
             function(data){
                var days = [];
                var advances = [];

                $.each(data.daily_client_advance,function(day,advance){
                   days.push(day);
                   advances.push(advance);
                });
               var options = {
                 chart: {
                     height: 350,
                     type: 'area',
                     zoom: {
                         enabled: false
                     },
                     toolbar:{
                       show: false
                     }
                 },
                 dataLabels: {
                     enabled: false
                 },
                 stroke: {
                     curve: 'straight'
                 },
                 series: [{
                     name: "Advances",
                     data: advances
                 }],
                 title: {
                     text: 'Daily',
                     align: 'left'
                 },
                 subtitle: {
                     text: 'Client Advances',
                     align: 'left'
                 },
                 labels: days,
                 xaxis: {
                     type: 'datetime',
                 },
                 yaxis: {
                     opposite: true
                 },
                 legend: {
                     horizontalAlign: 'left'
                 },
                 colors:[ CubaAdminConfig.primary ]
             
             }
             
                 var chart = new ApexCharts(
                     document.querySelector("#daily_client_advance"),
                     options
                 );
                 
                 chart.render();
                    });
    }

    function monthlyClientAdvance()
    {
           $.get('{{route('monthly_client_advance')}}',
        {
            'client_id': $('#monthly_client_advance').data('client_id')
        },
        function(data){
            var months = [];
            var advances = [];
            $.each(data.monthly_client_advance,function(index,payemnt){
            months.push(index);
            advances.push(payemnt);
            })
        // column chart
        var options3 = {
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
                name: 'Advance',
                data: advances
            }],
            xaxis: {
                categories: months
            },
            yaxis: {
                title: {
                    text: 'Rs'
                }
            },
            fill: {
                opacity: 1
        
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " Rupees"
                    }
                }
            },
            colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25']
        }
        
        var monthly_client_advance = new ApexCharts(
            document.querySelector("#monthly_client_advance"),
            options3
        );
        
        monthly_client_advance.render();
       });
    }

</script>