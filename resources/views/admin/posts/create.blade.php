<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Articulos', 'url' => route('admin.posts.index')],
    ['name' => 'Nuevo'],
]">
    <h1 class="text-3xl font-semibold mb-2">
        Nuevo Artículo
    </h1>
    <form action="{{ route('admin.posts.store') }}" method="POST" x-data="data()" x-init="$watch('title', value => { string_to_slug(value) })">
        @csrf

        <x-validation-errors class="mb-4" />

        <div class="mb-4">
            <x-label class="mb-2">
                Titulo del Artículo
            </x-label>
            <x-input class="w-full" value="{{ old('title') }}" x-model="title" name="title"
                placeholder="Ingrese el nombre del artículo" value="{{ old('title') }}">
            </x-input>

        </div>
        <div class="mb-4">
            <x-label class="mb-2">
                Slug
            </x-label>
            <x-input class="w-full" value="{{ old('slug') }}" x-model="slug" name="slug"
                placeholder="Ingrese el slug del artículo" value="{{ old('slug') }}">
            </x-input>

        </div>
        <div class="mb-4">
            <x-label>
                Categoría
            </x-label>
            <x-select name="category_id" class="w-full">
                @foreach ($categories as $category)
                    <option @selected(old('category_id') == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-select>
        </div>

        <div class="flex justify-end">
            <x-button>
                Crear Artículo
            </x-button>
        </div>
    </form>

    @push('js')
        <script>
            function data() {
                return {
                    title: '{{ old('title') }}',
                    slug: '{{ old('slug') }}',
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
                        this.slug = str;
                    }
                }
            }
        </script>
    @endpush



</x-admin-layout>
