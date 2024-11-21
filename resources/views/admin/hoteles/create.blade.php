<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Hoteles', 'url' => route('admin.hoteles.index')],
    ['name' => 'Nuevo'],
]">
    <form action="{{ route('admin.hoteles.store') }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        <x-validation-errors class="mb-4" />
        <div class="mb-4">
            <x-label class="mb-2">
                Nombre del hotel
            </x-label>
            <x-input name="nombre" class="w-full mb-4" placeholder="Ingrese el nombre del hotel" label="Nombre" />
            <x-label class="mb-2">
                Dirección
            </x-label>
            <x-input name="direccion" class="w-full mb-4" placeholder="Ingrese la dirección" label="Nombre" />
            <x-label class="mb-2">
                Numero de contacto
            </x-label>
            <x-input name="contacto" class="w-full mb-4" placeholder="Ingrese el numero de contacto" label="Nombre" />
        </div>
        <div class="flex justify-end">
            <x-button class="mt-4">
                Crear Hotel
            </x-button>
        </div>

    </form>


</x-admin-layout>
