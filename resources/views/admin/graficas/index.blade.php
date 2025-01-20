<x-admin-layout>

    <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
        <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
            Gráficas de Residuos por Sección
        </span>
    </h3>

    <!-- Formulario para el rango de fechas -->
    <form method="GET" action="{{ route('admin.graficas.index') }}" class="mb-6 space-y-4">
        <div class=" mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ $fechaInicio ?? '' }}" required
                    class="mt-1 block w-full sm:w-auto border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ $fechaFin ?? '' }}" required
                    class="mt-1 block w-full sm:w-auto border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

        </div>
        <button type="submit "
            class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Filtrar
        </button>
    </form>

    <!-- Contenedor de las gráficas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Gráfica Restaurantes -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 mb-2 text-center">Restaurantes</h2>
            <canvas id="graficaRestaurantes"></canvas>
        </div>

        <!-- Gráfica Áreas Comunes -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 mb-2 text-center">Áreas Comunes</h2>
            <canvas id="graficaAreasComunes"></canvas>
        </div>

        <!-- Gráfica Habitaciones -->
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 mb-2 text-center">Habitaciones</h2>
            <canvas id="graficaHabitaciones"></canvas>
        </div>
    </div>
    <!-- Contenedor de la gráfica de Subproductos -->
    <div class="flex flex-col items-center justify-center w-full px-4">
        <div class="bg-white p-4 rounded-lg shadow-md w-full max-w-4xl">
            <h2 class="text-lg font-semibold text-gray -700 mb-4 text-center">Subproductos</h2>
            <canvas id="graficaSubproductos" class="w-full h-[300px] sm:h-[400px] md:h-[500px]"></canvas>
        </div>
    </div>

    <!-- Contenedor de la gráfica -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray -700 mb-4 text-center">Generacion Percapita</h2>
            <canvas id="graficaComparativa" class="w-full h-[400px]"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold text-gray -700 mb-4 text-center">Valorizables / No Valorizables</h2>
            <canvas id="graficaComparativaVtria" class="w-full h-[400px]"></canvas>
        </div>
    </div>




    <!-- Librería Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        function generarConfiguracion(data, titulo, tipo = 'bar', indexAxis = 'y') {
            return {
                type: tipo, // Tipo de gráfica
                data: data, // Datos dinámicos
                options: {
                    indexAxis: indexAxis, // Eje principal (y: horizontal, x: vertical)
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top', // Posición de la leyenda
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.raw} kg`; // Formato del tooltip
                                }
                            }
                        },
                        datalabels: { // Configuración del plugin DataLabels
                            formatter: function(value) {
                                return `${value.toFixed(2)} kg`; // Limita a 2 decimales
                            },
                            color: '#888888', // Color del texto
                            font: {
                                size: 12, // Tamaño del texto
                                weight: 'bold' // Peso del texto
                            },
                            align: 'right', // Alineación del texto
                            anchor: 'end' // Ubicación del texto
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Valores en kg'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: titulo // Título dinámico del eje Y
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Activa el plugin DataLabels
            };
        }
        // Configuración para Restaurantes
        const dataRestaurantes = {
            labels: {!! json_encode($restaurantes['nombres']) !!},
            datasets: [{
                label: 'Valores por kg - Restaurantes',
                data: {!! json_encode($restaurantes['valores']) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Configuración para Áreas Comunes
        const dataAreasComunes = {
            labels: {!! json_encode($areasComunes['nombres']) !!},
            datasets: [{
                label: 'Valores por kg - Áreas Comunes',
                data: {!! json_encode($areasComunes['valores']) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Configuración para Habitaciones
        const dataHabitaciones = {
            labels: {!! json_encode($habitaciones['nombres']) !!},
            datasets: [{
                label: 'Valores por kg - Habitaciones',
                data: {!! json_encode($habitaciones['valores']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Configuración para Subproductos
        const dataSubproductos = {
            labels: {!! json_encode($nombresSubproductos) !!},
            datasets: [{
                label: 'Valores por kg - Subproductos',
                data: {!! json_encode($valoresSubproductos) !!},
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        };
        const dataComparativa = {
            labels: {!! json_encode($labels) !!}, // Etiquetas ["Percapita 1", "Percapita 2"]
            datasets: [{
                label: 'Total (kg)',
                data: [
                    {{ $datosPercapita1 }}, // Total de Percapita 1 (como número)
                    {{ $datosPercapita2 }} // Total de Percapita 2 (como número)
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };
        const dataComparativaVtria = {
            labels: {!! json_encode($labelstria) !!}, // Etiquetas ["Percapita 1", "Percapita 2"]
            datasets: [{
                label: 'Total (kg)',
                data: [
                    {{ $volumetria4 }}, // Total de Percapita 1 (como número)
                    {{ $volumetria5 }} // Total de Percapita 2 (como número)
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };


        // Configuración general para las gráficas
        // const config = {
        //     type: 'bar',
        //     options: {
        //         indexAxis: 'y', // Eje horizontal
        //         responsive: true,
        //         plugins: {
        //             legend: {
        //                 display: true,
        //                 position: 'top',
        //             },
        //         },
        //         scales: {
        //             x: {
        //                 beginAtZero: true,
        //             },
        //         },
        //     },
        // };
        const configSubproducto = {
            type: 'bar', // Tipo de gráfica
            data: dataSubproductos, // Asegúrate de tener los datos definidos
            options: {
                indexAxis: 'x', // Eje horizontal
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Posición de la leyenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} kg`; // Formato del tooltip
                            }
                        }
                    },
                    datalabels: { // Configuración del plugin DataLabels
                        anchor: 'end', // Ubicación del texto (parte superior)
                        align: 'top', // Alineación del texto
                        formatter: function(value, context) {
                            return `${value.toFixed(2)} kg`; // Limita a 2 decimales
                        },
                        color: '#888888', // Color del texto
                        font: {
                            size: 12, // Tamaño del texto
                            weight: 'bold' // Peso del texto
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true, // Empieza desde cero
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Valores en kg' // Título del eje Y
                        }
                    }
                }
            },
            plugins: [ChartDataLabels] // Activar el plugin DataLabels
        };
        const configComparativa = {
            type: 'polarArea', // Tipo de gráfica
            data: dataComparativa,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Posición de la leyenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} kg`; // Formato del tooltip
                            }
                        }
                    },
                    datalabels: { // Configuración del plugin DataLabels
                        formatter: function(value, context) {
                            return `${value.toFixed(2)} kg`; // Limita a 2 decimales
                        },
                        color: '#888888', // Color del texto
                        font: {
                            size: 14, // Tamaño del texto
                            weight: 'bold' // Peso del texto
                        },
                        align: 'center', // Alineación del texto en las secciones
                        anchor: 'center' // Ubicación del texto
                    }
                }
            },
            plugins: [ChartDataLabels] // Activar el plugin DataLabels
        };

        // Crear configuraciones usando la función genérica
        const configRestaurantes = generarConfiguracion(dataRestaurantes, 'Categorías');
        const configAreasComunes = generarConfiguracion(dataAreasComunes, 'Categorías');
        const configHabitaciones = generarConfiguracion(dataHabitaciones, 'Categorías');

        // Crear las gráficas
        // Renderizar las gráficas
        new Chart(document.getElementById('graficaRestaurantes').getContext('2d'), configRestaurantes);
        new Chart(document.getElementById('graficaAreasComunes').getContext('2d'), configAreasComunes);
        new Chart(document.getElementById('graficaHabitaciones').getContext('2d'), configHabitaciones);
        new Chart(document.getElementById('graficaSubproductos').getContext('2d'), {
            ...configSubproducto,
            data: dataSubproductos
        });
        new Chart(document.getElementById('graficaComparativa').getContext('2d'), {
            ...configComparativa,
            data: dataComparativa
        });
        new Chart(document.getElementById('graficaComparativaVtria').getContext('2d'), {
            ...configComparativa,
            data: dataComparativaVtria
        });
    </script>

</x-admin-layout>
