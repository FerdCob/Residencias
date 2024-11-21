<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Subproductos', 'url' => route('admin.subproductos.index')],
    ['name' => $subproducto->tipo],
]">
    <form action="{{ route('admin.subproductos.update', $subproducto) }}" method="POST"
        class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')
        <x-validation-errors class="mb-4" />
        <div class="mb-4">
            <x-label class="mb-4">
                Nombre
            </x-label>
            <x-input name="tipo" class="w-full" placeholder="Ingrese el nombre del subproducto" label="Nombre"
                value="{{ $subproducto->tipo }} " />
        </div>
        <div class="flex justify-end">
            <x-danger-button class="mr-2" onclick="deleteSubproducto()">
                Eliminar subproducto
            </x-danger-button>

            <x-button>
                Actualizar subproducto
            </x-button>
        </div>

    </form>

    <form action="{{ route('admin.subproductos.destroy', $subproducto) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>
    @push('js')
        <script>
            function deleteSubproducto() {
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>
    @endpush

</x-admin-layout>
