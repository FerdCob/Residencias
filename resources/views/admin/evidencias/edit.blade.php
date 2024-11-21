<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Evidencia', 'url' => route('admin.evidencias.index')],
    ['name' => 'Editar Evidencia'],
]">
    <form action="{{ route('admin.evidencias.update', $evidencia) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-validation-errors class="mb-4" />
        <div class="mb-6 relative">
            <figure>
                <img class="aspect-[9/4] object-cover object-center w-full" src="{{ $evidencia->image }}"
                    alt=""id="imgPreview">
            </figure>
            <div class="absolute top-8 right-8">
                <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
                    <i class="fa-solid fa-camera mr-2">
                    </i>
                    Actualizar imagen
                    <input type="file" onchange="previewImage(event, '#imgPreview')" accept="image/*" name="image"
                        class="hidden">
                </label>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-label class="mb-2">
                    Titulo de la Evidencia
                </x-label>
                <x-input class="w-full" name="title" value="{{ old('title', $evidencia->title) }}"
                    placeholder="Ingrese el titulo de la evidencia">
                </x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Fecha de captura
                </x-label>
                <x-input class="w-full" type="date" value="{{ old('fecha', $evidencia->fecha) ?? ($fecha ?? '') }}"
                    name="fecha" placeholder="Ingrese la fecha de captura">
                </x-input>
            </div>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Slug
            </x-label>
            <x-input class="w-full" name="slug_image" value="{{ old('slug_image', $evidencia->slug_image) }}"
                placeholder="Ingrese el slug de la eviencia" />
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Ingrese la descripcion
            </x-label>
            <x-input class="w-full" type="text" value="{{ old('descripcion', $evidencia->descripcion) }}"
                name="descripcion" placeholder="Ingrese la descripcion ">
            </x-input>
        </div>
        <div class="flex justify-end">
            <x-danger-button class="mr-2" onclick="deleteEvidencia()">
                Eliminar Evidencia
            </x-danger-button>
            <x-button>
                Actualizar
            </x-button>
        </div>
    </form>
    <form action="{{ route('admin.evidencias.destroy', $evidencia) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>

    @push('js')
        <script>
            function deleteEvidencia() {
                let form = document.getElementById('formDelete');
                form.submit();
            }
        </script>
        <script>
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }
        </script>
    @endpush
</x-admin-layout>
