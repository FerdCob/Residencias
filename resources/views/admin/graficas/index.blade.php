<x-admin-layout>
    <!-- Incluir el JavaScript compilado por Vite -->
    @push('js')
        @vite(['resources/js/get-datos.js'])
    @endpush
    <h1>Gráficas de Residuos</h1>
    <!-- Incluye un atributo data-url con la URL generada por Blade -->
    <canvas id="graficoResiduos" data-url="{{ route('graficas.datos') }}"></canvas>

</x-admin-layout>
