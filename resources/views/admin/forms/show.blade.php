<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Formulario', 'url' => route('admin.forms.index')],
    ['name' => 'Registro'],
]">
    <h1 class="flex items-center justify-center text-3xl font-extrabold dark:text-white underline">
        <span {{-- class="bg-blue-100 text-blue-800 text-3xl font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-2" --}}> Nuevo Registro </span>
    </h1>

    <!-- Datos Generales -->
    <form action="#">
        @csrf
        <x-validation-errors class="mb-4" />
        <!-- Datos generales -->
        <section>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Datos Generales
                </span>
            </h3>


            <div class="grid grid-cols-2 gap-4 mt-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha de registro</label>
                    <input type="date" name="fecha" value="{{ $fecha }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre del hotel asignado</label>
                    <input type="text" name="hotel" value="{{ $hotel->nombre }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
        </section>
        <hr class="my-6 border-t-8 rounded-full">
        <!-- Bitácora Generación Total Semanal -->
        <section>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Bitácora Generación Total Semanal
                </span>
            </h3>
            <p class="italic  mb-2 text-sm text-red-600/50 dark:text-red-500/50">Todos los valores de esta sección
                son numéricos*</p>
            <!-- Restaurante -->
            <h4 class=" mb-3 text-sm font-semibold text-gray-500 mt-4">Restaurante</h4>
            <input type="hidden" name="seccion1" value="4"> <!-- Input que guarda el valor del tipo de seccion-->
            <div class="grid grid-cols-5 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alimenticios</label>
                    <input type="number" value="{{ $alires }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Composteables</label>
                    <input type="number" value="{{ $comres }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos Valorizables</label>

                    <input type="number" value="{{ $inores }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos No Valorizables</label>
                    <input type="number" value="{{ $inores }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" value="{{ $totalres }}" tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>
            <!-- Habitaciones -->
            <h4 class=" mb-3 text-sm font-semibold text-gray-500 mt-4">Habitaciones</h4>
            <input type="hidden" name="seccion3" value="6"> <!-- Input que guarda el valor del tipo de seccion-->
            <div class="grid grid-cols-3 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos Valorizables</label>

                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" value="{{ $inohab }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos (No Valorizables -
                        Sanitarios)</label>
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" value="{{ $sanhab }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" value="{{ $totalhab }}" tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>
            <!-- Áreas comunes -->
            <h4 class=" mb-3 text-sm font-semibold text-gray-500 mt-4">Áreas comunes</h4>
            <input type="hidden" name="seccion2" value="5">
            <!-- Input que guarda el valor del tipo de seccion-->
            <div class="grid grid-cols-4 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sanitarios No valorizables</label>
                    <input type="hidden" name="residuo4" value="19">
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" value="{{ $sancom }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Orgánico</label>
                    <input type="hidden" name="residuo5" value="20">
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" value="{{ $orgcom }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos Valorizables</label>
                    <input type="hidden" name="residuo6" value="18">
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" value="{{ $inocom }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" value="{{ $totalcom }}" tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total generación semanal</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="number" value="{{ $totalgen }}" tabindex="-1"
                    class="
                    {{-- col-start-4 mt-1  --}}
                    block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
            </div>
        </section>
        <hr class="my-6 border-t-8 rounded-full">
        <!-- Bitácora De Generación Per Cápita Semanal -->
        <section>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Bitácora De Generación Per Cápita Semanal
                </span>
            </h3>
            <p class="italic  mb-2 text-sm text-red-600/50 dark:text-red-500/50">Todos los valores de esta sección
                son numéricos*</p>
            <!-- Primer apartado de insercion -->
            <div class="grid grid-cols-3 gap-4 w-full">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">N° Habitaciones Ocupadas</label>

                    <input type="number" value="{{ $hab }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        N° Huespedes por noche </label>

                    <input type="number" value="{{ $hue }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">N° de personal</label>

                    <input type="number" value="{{ $per }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
            <!-- Segundo apartado, generacion automatica -->
            <h4 class="mb-3 text-sm font-semibold text-gray-500 mt-4">Generación total Per capita</h4>
            <div class="grid grid-cols-2 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total kg por persona</label>
                    <input type="number" value="{{ $per1 }}"tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total kg por habitacion</label>
                    <input type="number" value="{{ $per2 }}"tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>

        </section>
        <hr class="my-6 border-t-8 rounded-full">
        <!-- Bitácora de subproductos -->
        <section>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Bitácora de subproductos
                </span>
            </h3>
            <p class="italic  mb-2 text-sm text-red-600/50 dark:text-red-500/50">Todos los valores de esta sección
                son numéricos*</p>
            <!-- Subproductos -->
            <h4 class=" mb-3 text-sm font-semibold text-gray-500 mt-4">Subproductos</h4>
            {{-- Carton Papel Aluminio Metal  --}}
            <div class="grid grid-cols-4 gap-4 w-full mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Carton</label>
                    <input type="number" value="{{ $car }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Papel</label>
                    <input type="number"value="{{ $pap }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Aluminio</label>
                    <input type="number" value="{{ $alu }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Metal</label>
                    <input type="number" value="{{ $met }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
            {{-- PET Plastico-Rigigo Jardineria Alimenticios  --}}
            <div class="grid grid-cols-4 gap-4 w-full mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">PET</label>
                    <input type="number" value="{{ $pet }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Plastico Rigido</label>
                    <input type="number" value="{{ $rig }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jardineria</label>
                    <input type="number" value="{{ $jar }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alimenticios</label>
                    <input type="number" value="{{ $ali }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
            {{-- Composteables Sanitarios Otros Manejo-Especial --}}
            <div class="grid grid-cols-4 gap-4 w-full mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Composteables</label>
                    <input type="number"value="{{ $com }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sanitarios</label>
                    <input type="number" value="{{ $san }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Otros (No Valorizables)</label>
                    <input type="number" value="{{ $nva }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Manejo Especial</label>
                    <input type="number" value="{{ $mes }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
            {{-- Peligrosos Vidrio --}}
            <div class="grid grid-cols-4 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Peligrosos</label>
                    <input type="number" value="{{ $pel }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Vidrio</label>
                    <input type="number" value="{{ $vid }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total Generado</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="number" value="{{ $totalsub }}" readonly tabindex="-1"
                    class="
                     {{-- col-start-4 mt-1  --}}
                     block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
            </div>
        </section>
        <hr class="my-6 border-t-8 rounded-full">
        <!-- Bitácora del peso volumetrico (Valorizables) -->
        <section>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Bitácora del peso volumetrico (Valorizables)
                </span>
            </h3>
            <p class="italic  mb-2 text-sm text-red-600/50 dark:text-red-500/50">Todos los valores de esta sección
                son numéricos*</p>
            {{-- Valorizables --}}
            <figure class="max-w-lg mx-auto mb-4">
                <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/Volumen/ilustration1.png') }}"
                    alt="image description">
                <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Imagen representativa
                    del contenedor de los residuos valorizables</figcaption>
                </figcaption>
            </figure>

            <div class="grid grid-cols-2 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Volumen Recipiente(m³)</label>
                    <input type="number" value="{{ $vre }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Peso Neto</label>
                    <input type="number" value="{{ $pne }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total Generado</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="number" value="{{ $pvo }}" tabindex="-1"
                    class=" block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
            </div>

        </section>
        <hr class="my-6 border-t-8 rounded-full">
        <!-- Bitácora del peso volumetrico (No Valorizables) -->
        <section>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Bitácora del peso volumetrico (No Valorizables)
                </span>
            </h3>
            <p class="italic  mb-2 text-sm text-red-600/50 dark:text-red-500/50">Todos los valores de esta sección
                son numéricos*</p>
            {{-- Valorizables --}}
            <figure class="max-w-lg mx-auto mb-4">
                <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/Volumen/ilustration1.png') }}"
                    alt="image description">
                <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Imagen representativa
                    del contenedor de los residuos valorizables</figcaption>
                </figcaption>
            </figure>

            <div class="grid grid-cols-2 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Volumen Recipiente(m³)</label>
                    <input type="number" value="{{ $nvro }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Peso Neto</label>
                    <input type="number" value="{{ $npne }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total Generado</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="number" value="{{ $npvo }}" tabindex="-1"
                    class=" block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
            </div>

        </section>
        <hr class="my-6 border-t-8 rounded-full">
        <!-- Bitácora De Producción De Residuos Urbanos Valorizables -->
        <section>
            <h3 class="mb-4 text-xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-3xl">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Bitácora De Producción De Residuos Urbanos Valorizables
                </span>
            </h3>
            <p class="italic  mb-2 text-sm text-red-600/50 dark:text-red-500/50">Todos los valores de esta sección
                son numéricos*</p>
            <h4 class=" mb-3 text-sm font-semibold text-gray-500 mt-4">Generación de residuos Valorizables</h4>
            <div class="grid grid-cols-3 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">N° Semana</label>
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" value="{{ $tval->semana }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">N° día</label>
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" value="{{ $tval->dia }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" value="{{ $tval->valorkg }}" tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>
        </section>
        <hr class="my-8 border-t-2 rounded-full border-transparent">
        <!-- Fin -->
        <div class="flex justify-end  ">
            <x-button>
                <a href="{{ route('admin.forms.index') }}">Regresar</a>
            </x-button>
        </div>
    </form>
    <!-- Incluir el JavaScript compilado por Vite -->
    @push('js')
        @vite(['resources/js/form-calculations.js'])
    @endpush
</x-admin-layout>
