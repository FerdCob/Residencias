<x-admin-layout :breadcrumb="[['name' => 'Home', 'url' => route('admin.dashboard')], ['name' => 'Evidencias']]">
    <x-slot name="action">
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
            href="{{ route('admin.evidencias.create') }}">Nuevo</a>
    </x-slot>
    <ul class="space-y-8">
        @foreach ($evidences as $evidence)
            <li class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <a href="{{ route('admin.evidencias.edit', $evidence) }}">
                        <img class="aspect-[16/9] object-cover object-center w-full" src="{{ $evidence->image }}"
                            alt="">
                    </a>
                </div>
                <div>
                    <h1 class="text-xl font-semibold">
                        <a href="{{ route('admin.evidencias.edit', $evidence) }}">
                            {{ $evidence->title }}
                        </a>

                    </h1>
                    <hr class="mt-1 mb-2">
                    <p class="text-gray-700 mt-6">
                        {{ Str::limit($evidence->descripcion, 100) }}
                    </p>
                    <div class="flex justify-end mt-4">
                        @hasanyrole('Administrador|Super Administrador')
                            @can('Editar evidencias')
                                <a href="{{ route('admin.evidencias.edit', $evidence) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    Editar
                                </a>
                            @endcan
                        @endhasanyrole
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="mt-4">
        {{ $evidences->links() }}
    </div>

</x-admin-layout>
