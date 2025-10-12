Highcharts.chart('container_barrenacion', {
    chart: {
        type: 'column'
    },
    title: {
        text: '',
        align: 'left'
    },
    subtitle: {
        text:
            'Origen: Optimine',
        align: 'left'
    },
    xAxis: {
        categories: ['7am', '8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm',
                     '7pm', '8pm', '9pm', '10pm', '11pm', '12am', '1am', '2am', '3am', '4am', '5am', '6am'],
        crosshair: true,
        accessibility: {
            description: 'Barrenos'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Metros'
        }
    },
    tooltip: {
        valueSuffix: ' (Mts)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: obtenerBarrenacion['equipos'][0],
            data: obtenerBarrenacion['barrenos'][0],
        },
        {
            name: obtenerBarrenacion['equipos'][1],
            data: obtenerBarrenacion['barrenos'][1],
        },
        {
            name: obtenerBarrenacion['equipos'][2],
            data: obtenerBarrenacion['barrenos'][2],
        }
    ]
});
