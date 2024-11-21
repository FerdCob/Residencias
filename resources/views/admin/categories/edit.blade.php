<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Categorías', 'url' => route('admin.categories.index')],
    ['name' => $category->name],
]">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST"
        class="bg-white rounded-lg p-6 shadow-lg">
        @csrf
        @method('PUT')
        <x-validation-errors class="mb-4" />
        <div class="mb-4">
            <x-label class="mb-4">
                Nombre
            </x-label>
            <x-input name="name" class="w-full" placeholder="Ingrese el nombre de la categoria" label="Nombre"
                value="{{ $category->name }} " />
        </div>
        <div class="flex justify-end">
            <x-danger-button class="mr-2" onclick="deleteCategory()">
                Eliminar categoria
            </x-danger-button>

            <x-button>
                Actualizar categoria
            </x-button>
        </div>

    </form>

    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>
    @push('js')
        <script>
            function deleteCategory() {
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>
    @endpush

</x-admin-layout>
