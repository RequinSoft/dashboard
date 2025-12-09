<div class="col-xxl-5 text-center">
    
    <div id="container_molienda" wire:ignore style="height: 400px;"></div>

<script>
    document.addEventListener("livewire:init", () => {
        initChart();
    });

    document.addEventListener("livewire:navigated", () => {
        initChart();
    });

    function initChart() {
        const el = document.getElementById('container_molienda');
        if (!el) return;

        // Datos iniciales desde Livewire
        const dias = @js($dias);
        const planMolienda = @js($planMolienda);
        const realMolienda = @js($realMolienda);

        renderChart(dias, planMolienda, realMolienda);

        // Evento cuando Livewire actualiza datos via poll
        Livewire.on('updateMoliendaChart', (data) => {
            renderChart(data.dias, data.planMolienda, data.realMolienda);
        });
    }

    function renderChart(dias, planMolienda, realMolienda) {
        Highcharts.chart('container_molienda', {
            title: { text: '' },
            xAxis: { categories: dias },
            yAxis: { title: { text: 'tons' }},
            tooltip: { valueSuffix: ' tons' },
            series: [
                { type: 'column', name: 'Planeadas', data: planMolienda },
                { type: 'spline', name: 'Reales', data: realMolienda }
            ],
            credits: { enabled: false }
        });
    }
</script>
</div>
