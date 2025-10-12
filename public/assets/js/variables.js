    //Gráfica de Barras
    var dias = @json($sieteDiasAtras);
    var plan = @json($planSieteDiasAtras);
    var real = @json($realSieteDiasAtras);
    
    //Variables para la Gráfica de Gauge
    var dataPlanMensual = @json($dataPlanMensual);
    var avgPlan = dataPlanMensual['avgPlan'];
    avgPlan = parseFloat(avgPlan);
    var planAlDia = dataPlanMensual['planAlDia'];
    //planAlDia = parseFloat(planAlDia);

    var mes = '{{$esteMes}}';


    var dataRealMensual = @json($dataRealMensual);
    var avgReal = dataRealMensual['avgReal'];
    avgReal = parseFloat(avgReal);
    var realAlDia = dataRealMensual['realMensual'];
    //realAlDia = parseFloat(Math.trunc(realAlDia));



    //dataPlanMensual = parseFloat(dataPlanMensual);
    //console.log(dias);
    //console.log(plan);
    //console.log('Acumulado -> ' + acumulado);
    console.log('dataPlanMensual, porcentaje -> ' + dataPlanMensual['avgPlan'] + ' plan al día -> ' + planAlDia);
    console.log('dataRealMensual, porcentaje -> ' + dataRealMensual['avgReal'] + ' real al día -> ' + realAlDia);


    //Función actualizar    
    function actualizar(){
        location.reload(true);
    }
    //Función para actualizar cada 20 minutos (1200000 milisegundos)
    setInterval("actualizar()", 1200000);


    $(document).ready(function() {
        // intervalo
        setInterval(function() {
            // petición ajax
            $.ajax({
                url: 'ritmo',
                success: function(data) {
                    // reemplazo el texto que va dentro de #Ejemplo
                    $('#ritmo_molienda').text(data);
                }
            });
        }, 10000); // cada 10 segundos, el valor es en milisegundos
    });