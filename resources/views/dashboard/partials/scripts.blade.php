<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isDarkMode = document.documentElement.classList.contains('dark');
        const textColor = isDarkMode ? '#9ca3af' : '#6b7280';
        const gridColor = isDarkMode ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

        function createChart(id, type, labels, data, labelName, color) {
            const ctx = document.getElementById(id);
            if(!ctx) return;
            
            return new Chart(ctx.getContext('2d'), {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: labelName,
                        data: data,
                        backgroundColor: color + (type === 'bar' ? '0.8)' : '0.1)'),
                        borderColor: color + '1)',
                        fill: type === 'line',
                        borderRadius: 6,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { ticks: { color: textColor }, grid: { display: false } },
                        y: { beginAtZero: true, ticks: { color: textColor }, grid: { color: gridColor } }
                    }
                }
            });
        }

        // Gráficos locais
        const dadosDemandaLocal = @json($statsAppo['demandaSemanal']);
        createChart('chartDemandaLocal', 'bar', dadosDemandaLocal.map(d => d.dia), dadosDemandaLocal.map(d => d.porcentagem), 'Demanda %', 'rgba(99, 102, 241, ');

        const dadosPicoLocal = @json($statsAppo['picoHorario']);
        createChart('chartHorariosLocal', 'line', dadosPicoLocal.labels, dadosPicoLocal.data, 'Agendamentos', 'rgba(16, 185, 129, ');

        // Gráficos globais
        @if(Auth::user()->is_admin)
            const dadosDemandaGlobal = @json($statsGlobal['demandaSemanal']);
            createChart('chartDemandaGlobal', 'bar', dadosDemandaGlobal.map(d => d.dia), dadosDemandaGlobal.map(d => d.porcentagem), 'Demanda %', 'rgba(239, 68, 68, ');

            const dadosPicoGlobal = @json($statsGlobal['picoHorario']);
            createChart('chartHorariosGlobal', 'line', dadosPicoGlobal.labels, dadosPicoGlobal.data, 'Agendamentos', 'rgba(239, 68, 68, ');
        @endif
    });
</script>