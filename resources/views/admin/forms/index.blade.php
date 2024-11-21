<x-admin-layout :breadcrumb="[['name' => 'Home', 'url' => route('admin.dashboard')], ['name' => 'Formulario']]">
    <x-slot name="action">
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
            href="{{ route('admin.forms.create') }}">Nuevo</a>
    </x-slot>

    <ul class="space-y-8">
        @foreach ($posts as $post)
            <li class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <h1 class="text-xl font-semibold">
                    <a href="{{ route('admin.forms.show', $hotel->idHotel) }}">
                        Hotel: {{ $hotel->nombre }}
                    </a>
                </h1>
                <hr class="mt-1 mb-2">
                <p class="text-gray-700 mt-2">
                    Fecha: {{ $post->fecha }}
                </p>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('admin.forms.show', $hotel->idHotel) }}?fecha={{ $post->fecha }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Ver
                    </a>


                </div>

            </li>
        @endforeach
    </ul>

    <div class="m-4">
        {{ $posts->links() }}
    </div>

</x-admin-layout>
