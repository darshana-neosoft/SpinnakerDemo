var colors = Highcharts.getOptions().colors.slice(0),
dark = -0.5;
colors[1] = Highcharts.Color(colors[0]).brighten(dark).get();
colors[3] = Highcharts.Color(colors[2]).brighten(dark).get();


Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'FTE Required by Month'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
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
        data: [1011,992,978,968,903,762,884,947,986,1213,1235,1176
]}, {
        name: 'Shift B',
        data: [744,730,720,712,664,561,650,696,725,892,909,865
]}]
});




Highcharts.chart('total_fte', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'FTE Required by Month'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
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
        data: [1911,1875,1849,1830,1707,1441,1671,1790,1864,2293,2335,2223]}, {
        name: 'Shift B',
        data: [1465,1515,1576,1424,1420,1193,1324,1585,1708,2012,1963,1887
]}]
});


/* /////////////////////////////////////  Year to Date ////////////////////*/


Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'ASA by Month'
    },
    xAxis: {
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        crosshair: true
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
        data: [12,11,7,9,6,3,8,7,10,19,23,27]

    }, {
        name: 'Shift B',
        data: [18,13,8,11,7,4,10,8,12,23,28,32]
    }]
});






/* /////////////////////////////////////  Year to Date ////////////////////*/



Highcharts.chart('container3', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'FTE Required by Month'
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
        data: [900,883,871,862,804,679,787,843,878,1080,1100,1047]

    }, {
        name: 'Shift B',
        data: [721,785,856,712,756,632,674,889,983,1120,1054,1022]
    }]
});



/* /////////////////////////////////////  Year to Date ////////////////////*/



Highcharts.chart('container4', {
    chart: {
        type: 'column'
    },
    colors: colors,
    title: {
        text: 'ASA by Month'
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
        data: [17,12,8,9,6,16,8,17,10,19,23,27]

    }, {
        name: 'Shift B',
        data: [14,14,10,11,7,19,10,20,12,23,28,21]
    }]
});

