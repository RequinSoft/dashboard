Highcharts.chart('container_moliendaxhora', {
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
            '06:30', '07:30', '08:30', '09:30', '10:30', '11:30', '12:30', '13:30', '14:30', '15:30', '16:30', '17:30',
            '18:30', '19:30', '20:30', '21:30', '22:30', '23:30', '00:30', '01:30', '02:30', '03:30', '04:30', '05:30'
        ],
        crosshair: true,
    }],

    //Configuración de 
    yAxis: [{ // Primary yAxis
        labels: {
            format: '',
            style: {
                color: Highcharts.getOptions().colors['cyan']
            }
        },
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors['cyan']
            }
        },
        opposite: true
    }, { // Secondary yAxis
        gridLineWidth: 0,
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors['blue']
            }
        },
        labels: {
            format: '',
            style: {
                color: Highcharts.getOptions().colors['blue']
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
        type: 'column',
        data: realxhora['planxHora'],
        color: 'cyan',
        tooltip: {
            valueSuffix: ' tons'
        }

    }, {
        name: 'Reales',
        type: 'spline',
        data: realxhora['realxHora'],
        lineWidth: 5,
        color: 'gold',
        marker: {
            enabled: false
        },
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
