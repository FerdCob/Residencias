<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Permisos', 'url' => route('admin.permissions.index')],
    ['name' => 'Nuevo'],
]">

    <div class="class bg-white shoadow rounded-lg p-6">

        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf

            <x-validation-errors class="mb-4" :errors="$errors" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre del permiso
                </x-label>
                <x-input class="w-full" name="name" placeholder="Ingrese el nombre del permiso"
                    value="{{ old('name') }}" />
            </div>
            <x-button>
                Crear permiso
            </x-button>
        </form>
    </div>
</x-admin-layout>
