<script>
    $(function(){
   $(document).ready(function(){
       $.get('{{route('get_daily_sms_count')}}',
       function(data){
           var days = [];
           var sms_counts = [];

           $.each(data.sms_count,function(index,count){
               days.push(index);
               sms_counts.push(count);
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
                type: 'datetime',
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
                    data: sms_counts
                }
            ],
            tooltip: {
                x: {
                    format: 'yy/MM/dd HH:mm'
                }
            }
        };
    
        var chartlinechart = new ApexCharts(
            document.querySelector("#chart-widget1"),
            optionslinechart
        );
    
        chartlinechart.render();
       });

       $.get('{{route('get_daily_email_count')}}',
       function(data){
           var days = [];
           var email_counts = [];
           $.each(data.email_count,function(index,count){
               days.push(index);
               email_counts.push(count);
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
                type: 'datetime',
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
                    data: email_counts
                }
            ],
            tooltip: {
                x: {
                    format: 'yy/MM/dd HH:mm'
                }
            }
        };
    
        var chartlinechart2 = new ApexCharts(
            document.querySelector("#chart-widget2"),
            optionslinechart2
        );
    
        chartlinechart2.render();
        });    
        $.get('{{route('get_daily_sms_email_count')}}',
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
          document.querySelector("#chart-widget6"),
          optionsproductchart
      );
      chartproductchart.render();
       });
   });
    });
</script>