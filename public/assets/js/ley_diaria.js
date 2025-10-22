// Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart('container_ley_diaria', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Ley Diaria'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            '12am', '1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am',
            '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', 
            '6pm', '7pm', '8pm', '9pm', '10pm', '11pm'
        ]
    },
    yAxis: {
        title: {
            text: 'Gr/Ton'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Au',
        color: Highcharts.getOptions().colors[7],
        data: ley_hoy_au
    }, {
        name: 'Ag',
        color: Highcharts.getOptions().colors[1],
        data: ley_hoy_ag
    }, {
        name: 'Pb',
        color: Highcharts.getOptions().colors[0],
        data: ley_hoy_pb
    }, {
        name: 'Zn',
        color: Highcharts.getOptions().colors[3],
        data: ley_hoy_zn
    }]
});