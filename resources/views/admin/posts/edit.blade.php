<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Articulos', 'url' => route('admin.posts.index')],
    ['name' => $post->title],
]">
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4" :errors="$errors" />
        <div class="mb-6 relative">
            <figure>
                <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $post->image }}"
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
        <div class="mb-4">
            <x-label class="mb-1">
                Titulo
            </x-label>
            <x-input class="w-full" name="title" value="{{ old('title', $post->title) }}"
                placeholder="Ingrese el titulo del texto" />
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Slug
            </x-label>
            <x-input class="w-full" name="slug" value="{{ old('slug', $post->slug) }}"
                placeholder="Ingrese el slug del post" />
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Categoría
            </x-label>
            <x-select name="category_id" class="w-full">
                @foreach ($categories as $category)
                    <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Contenido
            </x-label>
            <x-textarea class="w-full" name="excerpt" rows="6" placeholder="Ingrese el contenido del post">
                {{ old('excerpt', $post->excerpt) }}
            </x-textarea>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Etiquetas
            </x-label>
            <select class="tag-multiple" name="tags[]" multiple="multiple" style="width: 100%">
                @foreach ($post->tags as $tag)
                    <option selected value="{{ $tag->name }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <x-label class="mb-1">
                Cuerpo
            </x-label>
            <x-textarea class="w-full" name="body" rows="6" placeholder="Ingrese el contenido">
                {{ old('body', $post->body) }}
            </x-textarea>
        </div>

        <div class="mb-4">
            <input type="hidden" name="published" value="0">
            <label class="inline-flex items-center cursor-pointer">
                <input name="published" type="checkbox" value="1" class="sr-only peer"
                    @checked(old('published', $post->published) == 1)>
                <div
                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Publicar</span>
            </label>
        </div>
        <div class="flex justify-end">
            <x-danger-button class="mr-2" onclick="deletePost()">
                Eliminar Post
            </x-danger-button>
            <x-button>
                Actualizar
            </x-button>
        </div>

    </form>
    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" id="formDelete">
        @csrf
        @method('DELETE')

    </form>
    @push('js')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.tag-multiple').select2({
                    tags: true,
                    tokenSeparators: [','],
                    ajax: {
                        url: "{{ route('api.tags.index') }}",
                        dataType: 'json',
                        data: function(params) {
                            return {
                                term: params.term
                            }
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            }
                        }
                    }
                });
            });
        </script>
        <script>
            function deletePost() {
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
