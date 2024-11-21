<x-admin-layout :breadcrumb="[['name' => 'Home', 'url' => route('admin.dashboard')], ['name' => 'Subproductos']]">
    <x-slot name="action">
        <a class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
            href="{{ route('admin.subproductos.create') }}">Nuevo</a>
    </x-slot>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subproductos as $subproducto)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $subproducto->id_subproducto }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $subproducto->tipo }}
                        </td>
                        <td class="px-6 py-4">
                            @hasanyrole('Administrador|Super Administrador')
                                @can('Editar subproductos')
                                    <a href="{{ route('admin.subproductos.edit', $subproducto) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                @endcan
                            @endhasanyrole
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- <div class="mt-4">
        {{ $subproducto->links() }}
    </div> --}}

</x-admin-layout>
