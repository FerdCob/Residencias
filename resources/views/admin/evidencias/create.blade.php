<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Evidencias', 'url' => route('admin.evidencias.index')],
    ['name' => 'Nueva Evidecia'],
]">
    <h1 class="text-3xl  font-semibold mb-2">
        Crear evidencia
    </h1>

    <form action="{{ route('admin.evidencias.store') }}" method="POST" x-data="data()" x-init="$watch('title', value => { string_to_slug(value) })">
        @csrf
        <x-validation-errors class="mb-4" />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <x-label class="mb-2">
                    Titulo de la Evidencia
                </x-label>
                <x-input class="w-full" name="title" value="{{ old('title') }}" x-model="title"
                    placeholder="Ingrese el titulo de la evidencia">
                </x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Fecha de captura
                </x-label>
                <x-input class="w-full" type="date" value="{{ old('fecha') ?? ($fecha ?? '') }}" name="fecha"
                    placeholder="Ingrese la fecha de captura">
                </x-input>
            </div>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Slug
            </x-label>
            <x-input class="w-full" name="slug_image" value="{{ old('slug_image') }}" x-model="slug_image"
                placeholder="Ingrese el slug de la eviencia" />
        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Ingrese la descripcion
            </x-label>
            <x-input class="w-full" type="text" value="{{ old('descripcion') }}" name="descripcion"
                placeholder="Ingrese la descripcion ">
            </x-input>
        </div>
        {{-- <div class="mb-6 relative">
            <figure>
                <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $evidence->image_path }}"
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
        </div> --}}

        <div class="flex justify-end">
            <x-button>
                Crear Evidencia
            </x-button>
        </div>
    </form>
    @push('js')
        <script>
            function data() {
                return {
                    title: '{{ old('title') }}',
                    slug_image: '{{ old('slug_image') }}',
                    string_to_slug(str) {
                        str = str.replace(/^\s+|\s+$/g, '');
                        str = str.toLowerCase();
                        var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                        var to = "aaaaeeeeiiiioooouuuunc------";
                        for (var i = 0, l = from.length; i < l; i++) {
                            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                        }
                        str = str.replace(/[^a-z0-9 -]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-');
                        this.slug_image = str;
                    }
                }
            }
        </script>
    @endpush

</x-admin-layout>
