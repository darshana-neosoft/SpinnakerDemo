var colors = Highcharts.getOptions().colors.slice(0),
dark = -0.5;
colors[1] = Highcharts.Color(colors[0]).brighten(dark).get();
colors[3] = Highcharts.Color(colors[2]).brighten(dark).get();

Highcharts.chart('container-fte-prod1-m', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'FTE Required by Month Product 1'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'FTE'
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Shift A',
        data: [549,539,531,526,490,414,480,514,536,659,671,639]

    }, {
        name: 'Shift B',
        data: [425,463,505,420,446,373,398,525,580,661,622,603]
    }]
});



Highcharts.chart('container-fte-prod2-m', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'FTE Required by Month Product 2'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'FTE'
        },
       
    },
    
     tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

    series: [{
        name: 'Shift A',
        data: [513,503,496,491,458,387,449,481,500,616,627,597]

    }, {
        name: 'Shift B',
        data: [447,487,531,441,469,392,418,551,609,694,653,634]
    }]
});


/* /////////////////////////////////////  Year to Date ////////////////////*/


Highcharts.chart('container-asa-prod1-m', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'ASA by Month Product 1'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'ASA'
        }
    },
  tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Shift A',
        data: [10,7,5,5,4,10,5,10,6,12,14,16]

    }, {
        name: 'Shift B',
        data: [8,8,6,6,4,11,6,12,7,14,17,12]
    }]
});




Highcharts.chart('container-asa-prod2-m', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'ASA by Month Product 2'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'ASA'
        }
           },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Shift A',
        data: [19,14,9,10,7,18,9,19,11,21,26,31]

    }, {
        name: 'Shift B',
        data: [11,11,8,9,6,15,8,16,10,19,23,17]
    }]
});


/* /////////////////////////////////////  Year to Date ////////////////////*/


Highcharts.chart('container-fte-prod1-p', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'FTE Required by Month Product 1'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'FTE'
        },
        },
      
     tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Shift A',
        data: [485,476,469,465,433,366,424,455,473,582,593,564]

    }, {
        name: 'Shift B',
        data: [305,299,295,292,272,230,267,285,297,366,373,355]
    }]
});



Highcharts.chart('container-fte-prod2-p', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'FTE Required by Month Product 2'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'FTE'
        },
        
    },
   tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Shift A',
        data: [728,714,704,697,650,549,636,682,710,873,889,847]

    }, {
        name: 'Shift B',
        data: [506,496,490,484,452,381,442,473,493,607,618,588]
    }]
});


/* /////////////////////////////////////  Year to Date ////////////////////*/


Highcharts.chart('container-asa-prod1-p', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'ASA by Month Product 1'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'ASA'
        },
        
    },
   tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

    series: [{
        name: 'Shift A',
        data: [13,7,5,5,11,10,7,10,6,12,14,16]

    }, {
        name: 'Shift B',
        data: [8,8,6,6,4,11,6,12,7,14,17,12]
    }]
});




Highcharts.chart('container-asa-prod2-p', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'ASA by Month Product 2'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'ASA'
        },
        
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Shift A',
        data: [19,14,9,7,7,18,9,19,11,14,21,18]

    }, {
        name: 'Shift B',
        data: [11,11,8,9,6,15,8,16,10,19,23,17]
    }]
});


/* /////////////////////////////////////  Year to Date ////////////////////*/



Highcharts.chart('total_fte', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'Total FTE Required by Month'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'FTE'
        },
        
    },
   tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Shift A',
        data: [2275,2232,2200,2179,2031,1716,1989,2132,2219,2730,2780,2647]

    }, {
        name: 'Shift B',
        data: [1683,1745,1821,1637,1639,1376,1525,1834,1979,2328,2266,2180]
    }]
});
