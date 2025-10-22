Highcharts.chart('container_extraccion_planvsreal', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '',
        align: 'left'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    xAxis: [{
        categories: [
            '7am', '8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm',
            '7pm', '8pm', '9pm', '10pm', '11pm', '12am', '1am', '2am', '3am', '4am', '5am', '6am'
        ],
        crosshair: true
    }],

    //Configuración de 
    yAxis: [{ // Primary yAxis
        labels: {
            format: '',
            style: {
                color: Highcharts.getOptions().colors['blue']
            }
        },
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors['blue']
            }
        },
        opposite: true
    }, { // Secondary yAxis
        gridLineWidth: 0,
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors['red']
            }
        },
        labels: {
            format: '',
            style: {
                color: Highcharts.getOptions().colors['red']
            }
        }
    }, { // Tertiary yAxis
        gridLineWidth: 0,
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors['gold']
            }
        },
        labels: {
            format: '{value} mb',
            style: {
                color: Highcharts.getOptions().colors['gold']
            }
        },
        opposite: true
    }],


    
    tooltip: {
        shared: true
    },

    series: [{
        name: 'Planeadas',
        type: 'spline',
        data: dataExtraccion['planxHora'],
        lineWidth: 5,
        color: 'gold',
        marker: {
            enabled: false
        },
        tooltip: {
            valueSuffix: ' tons'
        }

    }, {
        name: 'Reales',
        type: 'spline',
        data: dataExtraccion['realxHora'],
        lineWidth: 3,
        color: 'red',
        tooltip: {
            valueSuffix: ' tons'
        }
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    floating: false,
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    x: 0,
                    y: 0
                },
                yAxis: [{
                    labels: {
                        align: 'right',
                        x: 0,
                        y: -6
                    },
                    showLastLabel: false
                }, {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -6
                    },
                    showLastLabel: false
                }, {
                    visible: false
                }]
            }
        }]
    },    
    credits: {
        enabled: false
    },
});
