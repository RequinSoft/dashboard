// Data retrieved from https://www.ssb.no/energi-og-industri/olje-og-gass/statistikk/sal-av-petroleumsprodukt/artikler/auka-sal-av-petroleumsprodukt-til-vegtrafikk
Highcharts.chart('container_molienda', {
    title: {
        text: '',
        align: 'left'
    },
    xAxis: {
        categories: dias
    },
    yAxis: {
        title: {
            text: 'tons'
        }
    },
    tooltip: {
        valueSuffix: ' tons'
    },
    plotOptions: {
        series: {
            borderRadius: '25%'
        }
    },
    series: [{
        type: 'column',
        name: 'Planeadas',
        data: planSieteDiasAtras,
    }, {
        type: 'spline',
        name: 'Reales',
        data: realSieteDiasAtras,
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    },],
    credits: {
        enabled: false
    },
});
