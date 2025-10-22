// Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart('container_leyxMinuto', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Ley x Minuto'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ley['ley_created_at']
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
        data: ley['ley_au']
    }, {
        name: 'Ag',
        color: Highcharts.getOptions().colors[1],
        data: ley['ley_ag']
    }, {
        name: 'Pb',
        color: Highcharts.getOptions().colors[0],
        data: ley['ley_pb']
    }, {
        name: 'Zn',
        color: Highcharts.getOptions().colors[5],
        data: ley['ley_zn']
    }]
});
