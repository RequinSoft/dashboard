const tiempo = 300000;

// On chart load, start an interval that adds points to the chart and animate
// the pulsating marker.
const onChartLoad = function () {
    const chart = this,
        series = chart.series[0];

    const respuesta = [];
    

    setInterval(function () {

        $.ajax({
            url: 'demandaxMinuto',
            dataType: "json",
            success: function(respuesta) {
                //Accion 1
                //console.log('Respuesta');
                //console.log(respuesta[0]['created_at']);
                //console.log(respuesta[0]['kw']);
                const x = Date.parse(respuesta[0]['created_at']), // current time
                y = respuesta[0]['kw'];

                series.addPoint([x, y], true, true);
            }
        });

    }, tiempo);
};


// Create the initial data
const data = (function () {
    const data = [];
    let inicio = (demanda.length-1) * -1;
    let contador = demanda.length-1;

    for(let i=inicio; i<=0; i+=1){

        data.push({
            x: Date.parse(demanda[contador]['created_at']),
            y: demanda[contador]['kw']
        });
        contador--;
    }

    return data;
}());

// Plugin to add a pulsating marker on add point
Highcharts.addEvent(Highcharts.Series, 'addPoint', e => {
    const point = e.point,
        series = e.target;

    if (!series.pulse) {
        series.pulse = series.chart.renderer.circle()
            .add(series.markerGroup);
    }

    setTimeout(() => {
        series.pulse
            .attr({
                x: series.xAxis.toPixels(point.x, true),
                y: series.yAxis.toPixels(point.y, true),
                r: series.options.marker.radius,
                opacity: 1,
                fill: series.color
            })
            .animate({
                r: 20,
                opacity: 0
            }, {
                duration: 1000
            });
    }, 1);
});


Highcharts.chart('container_demanda_live', {
    chart: {
        type: 'spline',
        events: {
            load: onChartLoad
        }
    },

    time: {
        useUTC: false
    },

    title: {
        text: 'Datos Demanda'
    },

    accessibility: {
        announceNewData: {
            enabled: true,
            minAnnounceInterval: 15000,
            announcementFormatter: function (allSeries, newSeries, newPoint) {
                if (newPoint) {
                    return 'New point added. Value: ' + newPoint.y;
                }
                return false;
            }
        }
    },

    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150,
        maxPadding: 0.1
    },

    yAxis: {
        title: {
            text: 'KW'
        },
        plotLines: [
            {
                value: 0,
                width: 1,
                color: '#808080'
            }
        ]
    },

    tooltip: {
        headerFormat: '<b>{series.name}</b><br/>',
        pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.0f}'
    },

    legend: {
        enabled: false
    },

    exporting: {
        enabled: false
    },

    series: [
        {
            name: 'Kilowatts',
            lineWidth: 2,
            color: Highcharts.getOptions().colors[2],
            data
        }
    ]
});

function updateOneM() {
    var chart = Highcharts.charts[0]; // Obtener la gráfica
    chart.series[0].setData([5, 3, 4, 7, 2]); // Actualizar los datos
}

function updateFiveM() {
    var chart = Highcharts.charts[0]; // Obtener la gráfica
    chart.series[0].setData([5, 3, 4, 7, 2]); // Actualizar los datos
}