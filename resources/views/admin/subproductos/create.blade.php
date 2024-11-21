<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Subproductos', 'url' => route('admin.subproductos.index')],
    ['name' => 'Nuevo'],
]">
    <form action="{{ route('admin.subproductos.store') }}" method="POST" class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        <x-validation-errors class="mb-4" />
        <div class="MB-4">
            <x-label class="mb-4">
                Nombre
            </x-label>
            <x-input name="tipo" class="w-full" placeholder="Ingrese el nombre del subproducto" label="Nombre" />
        </div>
        <div class="flex justify-end">
            <x-button class="mt-4">
                Crear categoria
            </x-button>
        </div>

    </form>
</x-admin-layout>
