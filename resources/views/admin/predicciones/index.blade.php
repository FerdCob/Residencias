<x-admin-layout>
    <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
        <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
            Gráficas predictivas
        </span>
    </h3>
    <!-- Restaurantes -->
    <div>
        <h2>Restaurantes</h2>
        <canvas id="graficaRestaurantes" width="400" height="200"></canvas>
    </div>

    <!-- Áreas Comunes -->
    <div>
        <h2>Áreas Comunes</h2>
        <canvas id="graficaAreasComunes" width="400" height="200"></canvas>
    </div>

    <!-- Habitaciones -->
    <div>
        <h2>Habitaciones</h2>
        <canvas id="graficaHabitaciones" width="400" height="200"></canvas>
    </div>

    <!-- Volumetría 4 -->
    <div>
        <h2>Volumetría Valorizable</h2>
        <canvas id="graficaVolumetria4" width="400" height="200"></canvas>
    </div>

    <!-- Volumetría 5 -->
    <div>
        <h2>Volumetría No Valorizable</h2>
        <canvas id="graficaVolumetria5" width="400" height="200"></canvas>
    </div>

    <!-- Percápita 1 -->
    <div>
        <h2>Percápita kg por Persona</h2>
        <canvas id="graficaPercapita1" width="400" height="200"></canvas>
    </div>

    <!-- Percápita 2 -->
    <div>
        <h2>Percápita kg por Habitación</h2>
        <canvas id="graficaPercapita2" width="400" height="200"></canvas>
    </div>

    <!-- Subproductos -->
    <div id="subproductos">
        <h2>Subproductos</h2>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module">
        import {
            linearRegression,
            linearRegressionLine
        } from 'https://cdn.jsdelivr.net/npm/simple-statistics@7.8.3/index.js';

        document.addEventListener('DOMContentLoaded', () => {
            const url = '/admin/predicciones';

            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Datos recibidos del servidor:', data);

                    // Manejar Restaurantes
                    procesarGrafica('graficaRestaurantes', data.restaurantes.promedios_semanales,
                        'Restaurantes');

                    // Manejar Áreas Comunes
                    procesarGrafica('graficaAreasComunes', data.areasComunes.promedios_semanales,
                        'Áreas Comunes');

                    // Manejar Habitaciones
                    procesarGrafica('graficaHabitaciones', data.habitaciones.promedios_semanales,
                        'Habitaciones');

                    // Manejar Volumetría 4
                    procesarGrafica('graficaVolumetria4', data.volumetria4.promedios_semanales,
                        'Volumetría Valorizable');

                    // Manejar Volumetría 5
                    procesarGrafica('graficaVolumetria5', data.volumetria5.promedios_semanales,
                        'Volumetría No Valorizable');

                    // Manejar Percápita 1
                    procesarGrafica('graficaPercapita1', data.percapita1.promedios_semanales,
                        'Percápita kg por Persona');

                    // Manejar Percápita 2
                    procesarGrafica('graficaPercapita2', data.percapita2.promedios_semanales,
                        'Percápita kg por Habitación');

                    // Manejar Subproductos
                    const subproductosContainer = document.getElementById('subproductos');
                    const nombresSubproductos = [
                        "Cartón",
                        "Papel",
                        "Aluminio",
                        "Metal",
                        "PET",
                        "Plástico rígido",
                        "Jardinería",
                        "Alimenticios",
                        "Composteables",
                        "Sanitarios",
                        "No valorizables",
                        "Manejo especial",
                        "Peligrosos",
                        "Vidrio"
                    ];

                    for (const [idSubproducto, subproducto] of Object.entries(data.subproductos)) {
                        const canvasId = `graficaSubproducto${idSubproducto}`;
                        const canvas = document.createElement('canvas');
                        canvas.id = canvasId;
                        canvas.width = 400;
                        canvas.height = 200;

                        const subproductoLabel = nombresSubproductos[idSubproducto - 1] ||
                            `Subproducto ${idSubproducto}`;
                        const title = document.createElement('h3');
                        title.textContent = subproductoLabel;

                        subproductosContainer.appendChild(title);
                        subproductosContainer.appendChild(canvas);

                        procesarGrafica(canvasId, subproducto.promedios_semanales, subproductoLabel);
                    }
                })
                .catch(error => console.error('Error al cargar los datos:', error));
        });

        function procesarGrafica(canvasId, promediosSemanales, label) {
            const valoresHistoricos = Object.values(promediosSemanales) || [];
            const etiquetas = Object.keys(promediosSemanales).map(
                semana => `Semana ${parseInt(semana) + 1}`
            );

            const predicciones = predecir(valoresHistoricos, 4);
            const etiquetasFuturas = ['Semana +1', 'Semana +2', 'Semana +3', 'Semana +4'];
            const etiquetasConPrediccion = [...etiquetas, ...etiquetasFuturas];

            graficar(canvasId, etiquetasConPrediccion, valoresHistoricos, predicciones, label);
        }

        function predecir(valores, semanasFuturas = 4) {
            if (valores.length < 2) {
                return Array(semanasFuturas).fill(Math.max(valores[valores.length - 1] || 0, 0));
            }

            const datos = valores.map((v, i) => [i, v]);
            const {
                m,
                b
            } = linearRegression(datos);
            const line = linearRegressionLine({
                m,
                b
            });

            const predicciones = [];
            for (let i = valores.length; i < valores.length + semanasFuturas; i++) {
                predicciones.push(Math.max(line(i), 0));
            }

            return predicciones;
        }

        function graficar(canvasId, etiquetas, valoresHistoricos, predicciones, label) {
            const valoresConPrediccion = [...valoresHistoricos, ...predicciones];

            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: etiquetas,
                    datasets: [{
                            label: `Históricos (${label})`,
                            data: valoresHistoricos,
                            borderColor: 'blue',
                            tension: 0.3,
                        },
                        {
                            label: `Predicción (${label})`,
                            data: valoresConPrediccion,
                            borderColor: 'red',
                            borderDash: [5, 5],
                            tension: 0.3,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        }
    </script>
</x-admin-layout>
