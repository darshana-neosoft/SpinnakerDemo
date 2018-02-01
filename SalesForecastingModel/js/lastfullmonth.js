
/* /////////////////////////////////////  Year to Date ////////////////////*/
Highcharts.chart('yeartodate', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },

    xAxis: {
        categories: ['A&H', 'Casualty','FL','Tech Lines','Fire','Cyber','Surety','Marine','EIL','Other','Entertainment']
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        },


        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        },
         labels: {
             enabled:false,
            formatter: function() {
                return '$'+this.value ;
            }
        }
    },
    legend: {
        align: 'bottom',
        x: 200,
        verticalAlign: 'bottom',
        y: 20,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: ${point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            colorByPoint: true,
            stacking: 'normal',
            dataLabels: {
                enabled: false,
                
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            },

        }
    },
    colors: [
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9'
            ],
   series: [{
        data: [10982,8193,7235,6549,5942,4488,4395,1759,1402,177,119]
    }
    ]
});


Highcharts.chart('yeartodate1', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
     
    xAxis: {
        categories: ['France','Iberia','Italy','Germany','Benelux','Nordics','Switzerland','Austria','PCH']
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        },
       
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        },
         labels: {
             enabled:false,
            formatter: function() {
                return '$'+this.value ;
            }
        }
    },
    legend: {

        align: 'bottom',
        x: 200,
        verticalAlign: 'bottom',
        y: 20,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: ${point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            colorByPoint: true,
            stacking: 'normal',
            dataLabels: {
                enabled: false,
                
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            },

        }
    },
    colors: [
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                '#025db9',
                 '#025db9',
                  '#025db9',
                   '#025db9'
            ],
   series: [{
        data: [9978,8952,8608,7667,7665,3324,2898,2147]
    }
    ]
});



var myConfig = {
  type: 'pie',
  title: {
    text: '<span style="font-weight: bold;"></span>',
    fontSize:18,
    fontFamily: '"exo2",Georgia, Serif'
  },
    plot: {
      detach: false,
      cursor: 'hand',
      valueBox: {
         text: '%t<br>%v%',
        fontFamily: '"exo2",Georgia, Serif',
        fontSize: 14,
        fontWeight: 'normal',
        offsetR: '30%',
        fontColor:'#000'
      },
      tooltip: {
        visible: false
      }
    },
    series : [
      {
        values: [47.35],
        text: 'L',
        backgroundColor: '#1b4f72'
      },
        {
            values : [40.37],
            text: 'M',
            backgroundColor: '#21618c'
        },
        {
          values: [12.28],
          text: 'S',
          backgroundColor: '#2874a6'
        },
        
    ]
};


zingchart.render({ 
    id : 'piechart1', 
    data : myConfig, 
    height: 400, 
    width: '100%' 
});










