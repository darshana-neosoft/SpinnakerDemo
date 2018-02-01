$(document).ready(function() {
    var table = $('#myTable').DataTable( {
        pageLength: 20,
        lengthMenu: [ 20, 50,100],
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );


$( "#score_form" ).submit(function( event ) {
    var case_size = document.getElementById("case-size");
    var case_size_score = Number(case_size.options[case_size.selectedIndex].value);
    var industry = document.getElementById("industry");
    var industry_score = Number(industry.options[industry.selectedIndex].value);
    var states = document.getElementById("state");
    var state_score = Number(states.options[states.selectedIndex].value);
    var seasonality = document.getElementById("seasonality");
    var seasonality_score = Number(seasonality.options[seasonality.selectedIndex].value);
    var broker = document.getElementById("broker");
    var broker_score =Number(broker.options[broker.selectedIndex].value);
    var total_score = case_size_score+industry_score+state_score+seasonality_score+broker_score
      $("#score-output-value").html(total_score);   
    $("#score-output-div").show();
});


function reset_div() {
    $('#score-output-div').hide();
}

    $(document).ready(function() {
    if (location.hash) {
        $("  a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", ".side-menu > li > a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("  a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});
/* /////////////////////////////////////  Year to Date ////////////////////*/
Highcharts.chart('yeartodate', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
     
    xAxis: {
        categories: ['2013', '2014', '2015', '2016','2017']
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
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
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
                '#003366',
                '#003366'
            ],
   series: [{
        data: [1181,1063,851,1313,1458]

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
        categories: ['2013', '2014', '2015', '2016','2017']
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
        pointFormat: '{series.name}: ${point.y}<br/>Total: ${point.stackTotal}'
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
                '#003366',
                '#003366'
            ],
   series: [{
      
        data: [576, 518, 415,640, 807]
    }
    ]
});








// Make monochrome colors and set them as default for all pies
Highcharts.getOptions().plotOptions.pie.colors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[0],
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
    }
    return colors;
}());



if($(window).width() >= 1200){
    (function($) {
        var element = $('#navigation'),
            originalY = element.offset().top;

        // Space between element and top of screen (when scrolling)
        var topMargin = 10;

        // Should probably be set in CSS; but here just for emphasis
        element.css('position', 'relative');

        $(window).on('scroll', function(event) {
            var scrollTop = $(window).scrollTop();

            element.stop(false, false).animate({
                top: scrollTop < originalY
                    ? 0
                    : scrollTop - originalY + topMargin
            }, 0);
        });
    })(jQuery);
}







var myConfig = {
  type: 'pie',
  title: {
    text: '<span style="font-weight: bold;">Case Size Mix By Face Amount</span>',
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
        values: [6],
        text: 'U100',
        backgroundColor: '#1b4f72'
      },
        {
            values : [9],
            text: '100-199',
            backgroundColor: '#21618c'
        },
        {
          values: [10],
          text: '200-499',
          backgroundColor: '#2874a6'
        },
        {
          values: [20],
          text: '500-999',
          backgroundColor: '#2e86c1'
        },
        {
          values: [15],
          text: '1000-2999',
          backgroundColor: '#3498db'
        },
        {
          values: [40],
          text: '3000+',
          backgroundColor: '#5dade2'
        }
    ]
};


zingchart.render({ 
    id : 'piechart1', 
    data : myConfig, 
    height: 400, 
    width: '100%' 
});


var myConfig = {
  type: 'pie',
  title: {
    text: '<span style="font-weight: bold;">Case Size Mix By # Of Cases</span>',
    fontSize:18,
    fontFamily: '"exo2",Georgia, Serif',
     
  },
    plot: {
      detach: false,
      cursor: 'hand',
      valueBox: {
        text: '%t<br>%v%',
        fontFamily: '"exo2",Georgia, Serif',
        fontSize: 14,
        fontWeight: '"exo2",Georgia, Serif',
        offsetR: '30%',
        fontColor:'#000'
      },
      tooltip: {
        visible: false
      }
    },
    series : [

    {
        values: [39],
        text: 'U100',
        backgroundColor: '#1b4f72'
      },
        {
            values : [16],
            text: '100-199',
            backgroundColor: '#21618c'
        },
        {
          values: [14],
          text: '200-499',
          backgroundColor: '#2874a6'
        },
        {
          values: [20],
          text: '500-999',
          backgroundColor: '#2e86c1'
        },
        {
          values: [8],
          text: '1000-2999',
          backgroundColor: '#3498db'
        },
        {
          values: [3],
          text: '3000+',
          backgroundColor: '#5dade2'
        }

     
    ]
};


zingchart.render({ 
    id : 'piechart', 
    data : myConfig, 
    height: 400, 
    width: '100%' 
});









