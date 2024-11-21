<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Formulario', 'url' => route('admin.forms.index')],
    ['name' => 'Nuevo Registro'],
]">
    <h1 class="flex items-center justify-center text-3xl font-extrabold dark:text-white underline">
        <span {{-- class="bg-blue-100 text-blue-800 text-3xl font-semibold me-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-2" --}}> Nuevo Registro </span>
    </h1>

    <!-- Datos Generales -->
    <form action="{{ route('admin.forms.store') }}" method="POST">
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
                    <input type="date" name="fecha" id="fechaActual" value="{{ now()->format('Y-m-d') }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre del hotel asignado</label>
                    <input type="text" name="hotel" value="{{ $namehotel }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
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
                    <input type="hidden" name="residuo1" value="16">
                    <input type="number" name="rali_kg" id="rali_kg" placeholder="Valor kg" required step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Composteables</label>
                    <input type="hidden" name="residuo2" value="17">
                    <input type="number" name="rcom_kg" id="rcom_kg" placeholder="Valor kg" required step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos Valorizables</label>
                    <input type="hidden" name="residuo3" value="18">
                    <input type="number" name="rino_kg" id="rino_kg" placeholder="Valor kg" required step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos No Valorizables</label>
                    <input type="hidden" name="residuo03" value="19">
                    <input type="number" name="rnva_kg" id="rnva_kg" placeholder="Valor kg" required step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" name="totalRest" id="totalRest" placeholder="Valor kg" readonly tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>
            <!-- Habitaciones -->
            <h4 class=" mb-3 text-sm font-semibold text-gray-500 mt-4">Habitaciones</h4>
            <input type="hidden" name="seccion3" value="6"> <!-- Input que guarda el valor del tipo de seccion-->
            <div class="grid grid-cols-3 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos Valorizables</label>
                    <input type="hidden" name="residuo8" value="18">
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" name="hino_kg" id="hino_kg" placeholder="Valor kg" required step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos (No Valorizables -
                        Sanitarios)</label>
                    <input type="hidden" name="residuo9" value="21">
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" name="hotr_kg" id="hotr_kg" placeholder="Valor kg" required step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" name="totalHabi" id="totalHabi" placeholder="Valor kg" readonly
                        tabindex="-1"
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
                    <input type="number" name="asan_kg" id="asan_kg" placeholder="Valor kg" required
                        step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Orgánico</label>
                    <input type="hidden" name="residuo5" value="20">
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" name="ajar_kg" id="ajar_kg" placeholder="Valor kg" required
                        step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Inorgánicos Valorizables</label>
                    <input type="hidden" name="residuo6" value="18">
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" name="aino_kg" id="aino_kg" placeholder="Valor kg" required
                        step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" name="totalAreas" id="totalAreas" placeholder="Valor kg" readonly
                        tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total generación semanal</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="number" name="gentotal" id="gentotal" placeholder="Valor kg" readonly tabindex="-1"
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
                    <input type="hidden" name="habitacion" value="1">
                    <input type="number" name="nho" id="nho" placeholder="Valor kg" required
                        step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        N° Huespedes por noche </label>
                    <input type="hidden" name="huesped" value="2">
                    <input type="number" name="nhn" id="nhn" placeholder="Valor kg" required
                        step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">N° de personal</label>
                    <input type="hidden" name="personal" value="3">
                    <input type="number" name="np" id="np" placeholder="Valor kg" required
                        step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            <!-- Segundo apartado, generacion automatica -->
            <h4 class="mb-3 text-sm font-semibold text-gray-500 mt-4">Generación total Per capita</h4>
            <div class="grid grid-cols-2 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total kg por persona</label>
                    <input type="number" name="totalp1" id="tp" placeholder="Valor kg" readonly
                        tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total kg por habitacion</label>
                    <input type="number" name="totalh1" id="th" placeholder="Valor kg" readonly
                        tabindex="-1"
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
                    <input type="hidden" name="carton" value="1">
                    <input type="number" name="bs_car" id="bs_car" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Papel</label>
                    <input type="hidden" name="papel" value="2">
                    <input type="number"name="bs_pap" id="bs_pap" placeholder="Valor kg" required step="0.001"
                        value="0" min="0" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Aluminio</label>
                    <input type="hidden" name="aluminio" value="3">
                    <input type="number" name="bs_alu" id="bs_alu" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Metal</label>
                    <input type="hidden" name="metal" value="4">
                    <input type="number" name="bs_met" id="bs_met" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            {{-- PET Plastico-Rigigo Jardineria Alimenticios  --}}
            <div class="grid grid-cols-4 gap-4 w-full mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">PET</label>
                    <input type="hidden" name="pet" value="5">
                    <input type="number" name="bs_pet" id="bs_pet" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Plastico Rigido</label>
                    <input type="hidden" name="plasticoRig" value="6">
                    <input type="number" name="bs_pla" id="bs_pla" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jardineria</label>
                    <input type="hidden" name="jardin" value="7">
                    <input type="number" name="bs_jar" id="bs_jar" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Alimenticios</label>
                    <input type="hidden" name="alimenticio" value="8">
                    <input type="number" name="bs_ali" id="bs_ali" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            {{-- Composteables Sanitarios Otros Manejo-Especial --}}
            <div class="grid grid-cols-4 gap-4 w-full mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Composteables</label>
                    <input type="hidden" name="composta" value="9">
                    <input type="number"name="bs_com" id="bs_com" placeholder="Valor kg" required value="0"
                        min="0" step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sanitarios</label>
                    <input type="hidden" name="sanitario" value="10">
                    <input type="number" name="bs_san" id="bs_san" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Otros (No Valorizables)</label>
                    <input type="hidden" name="novalor" value="11">
                    <input type="number" name="bs_nv" id="bs_nv" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Manejo Especial</label>
                    <input type="hidden" name="especial" value="12">
                    <input type="number" name="bs_ms" id="bs_ms" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            {{-- Peligrosos Vidrio --}}
            <div class="grid grid-cols-4 gap-4 w-full">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Peligrosos</label>
                    <input type="hidden" name="peligroso" value="13">
                    <input type="number" name="bs_pel" id="bs_pel" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Vidrio</label>
                    <input type="hidden" name="vidrio" value="14">
                    <input type="number" name="bs_vid" id="bs_vid" placeholder="Valor kg" required
                        value="0" min="0" step="0.001"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total Generado</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="number" id="totalSubp" placeholder="Valor kg" readonly tabindex="-1"
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
                    <input type="hidden" name="volRep" value="1">
                    <input type="number" name="vol_r2" id="vol_r2" placeholder="Valor kg" required
                        min="0" step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Peso Neto</label>
                    <input type="hidden" name="pesoNet" value="4">
                    <input type="number" name="peso_net2" id="peso_net2" placeholder="Valor kg" required
                        min="0" step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total Generado</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="hidden" name="pesoVol" value="5">
                <input type="number" name="peso_vol2" id="peso_vol2" placeholder="Valor kg" readonly
                    tabindex="-1"
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
                    <input type="hidden" name="volRep" value="1">
                    <input type="number" name="vol_r1" id="vol_r1" placeholder="Valor kg" required
                        min="0" step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Peso Neto</label>
                    <input type="hidden" name="pesoNet" value="4">
                    <input type="number" name="peso_net1" id="peso_net1" placeholder="Valor kg" required
                        min="0" step="0.001" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
            </div>
            <!-- Total -->
            <h4 class="mb-3 my-4">Total Generado</h4>
            <div class="grid grid-cols-4 gap-4">
                <input type="hidden" name="pesoVol" value="5">
                <input type="number" name="peso_vol1" id="peso_vol1" placeholder="Valor kg" readonly
                    tabindex="-1"
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
                    <input type="number" name="semana" placeholder="(1,2,3..)" required step="1"
                        min="1" max="100" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">N° día</label>
                    <!-- Input que guarda el valor del tipo de residuo-->
                    <input type="number" name="dia" placeholder="(1,2,3...,7)" required step="1"
                        min="1" max="7" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Generado</label>
                    <input type="number" name="total_valor" id="total_valor" placeholder="Valor kg" readonly
                        tabindex="-1"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded bg-gray-100 pointer-events-none">
                </div>
            </div>
        </section>
        <hr class="my-8 border-t-2 rounded-full border-transparent">
        <!-- Fin -->
        <div class="flex justify-end  ">
            <x-button>
                Crear Registro
            </x-button>
        </div>
    </form>
    <!-- Incluir el JavaScript compilado por Vite -->
    @push('js')
        @vite(['resources/js/form-calculations.js'])
    @endpush
</x-admin-layout>
