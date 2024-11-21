<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Hoteles', 'url' => route('admin.hoteles.index')],
    ['name' => $hotel->nombre],
]">
    <form action="{{ route('admin.hoteles.update', $hotel) }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" />
        <div class="mb-4">
            <x-label class="mb-2">
                Nombre del hotel
            </x-label>
            <x-input name="nombre" class="w-full mb-2" placeholder="Ingrese el nombre del hotel" label="nombre"
                value="{{ $hotel->nombre }} " />
            <x-label class="mb-2">
                Dirección
            </x-label>
            <x-input name="direccion" class="w-full mb-2" placeholder="Ingrese la dirección" label="direccion"
                value="{{ $hotel->direccion }} " />
            <x-label class="mb-2">
                Numero de contacto
            </x-label>
            <x-input name="contacto" class="w-full mb-2" placeholder="Ingrese el numero de contacto" label="contacto"
                value="{{ $hotel->contacto }} " />

        </div>
        <div class="flex justify-end">
            <x-danger-button class="mr-2" onclick="deleteHotel()">
                Eliminar hotel
            </x-danger-button>

            <x-button>
                Actualizar hotel
            </x-button>
        </div>

    </form>

    <form action="{{ route('admin.hoteles.destroy', $hotel) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>
    @push('js')
        <script>
            function deleteHotel() {
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>
    @endpush


</x-admin-layout>
