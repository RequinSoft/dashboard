// Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart('container_demanda_live_ayer', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Medición Diaria'
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
            text: 'Kw´s'
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
        name: 'Ayer',
        color: Highcharts.getOptions().colors[5],
        data: demanda_ayer
    }, {
        name: 'Hoy',
        color: Highcharts.getOptions().colors[1],
        data: demanda_hoy
    }]
});