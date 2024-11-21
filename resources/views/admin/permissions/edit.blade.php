<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Permisos', 'url' => route('admin.permissions.index')],
    ['name' => $permission->name],
]">

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">

            @csrf

            @method('PUT')

            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre del permiso
                </x-label>
                <x-input class="w-full" name="name" placeholder="Ingrese el nombre del permiso"
                    value="{{ old('name', $permission->name) }}" />
            </div>

            <div class="flex">
                <x-button>
                    Actualizar permiso
                </x-button>

                <x-danger-button class="ml-2" onclick="DeletePermission()">
                    Eliminar
                </x-danger-button>
            </div>
        </form>

        <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" id="formDelete">

            @csrf
            @method('DELETE')

        </form>
    </div>

    @push('js')
        <script>
            function DeletePermission() {
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>
    @endpush

</x-admin-layout>
