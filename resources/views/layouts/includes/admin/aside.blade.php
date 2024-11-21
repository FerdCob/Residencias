@php
    $links = [
        [
            'name' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
            'icon' => 'fa-solid fa-gauge-high',
            'can' => ['Acceso dashboard'],
        ],
        [
            'name' => 'Categorías',
            'url' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
            'icon' => 'fa-solid fa-inbox',
            'can' => ['Gestion categorias'],
        ],
        [
            'name' => 'Artículos',
            'url' => route('admin.posts.index'),
            'active' => request()->routeIs('admin.posts.*'),
            'icon' => 'fa-solid fa-blog',
            'can' => ['Gestion articulos'],
        ],
        [
            'name' => 'Roles',
            'url' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
            'icon' => 'fa-solid fa-user-tag',
            'can' => ['Gestion roles'],
        ],
        [
            'name' => 'Permisos',
            'url' => route('admin.permissions.index'),
            'active' => request()->routeIs('admin.permissions.*'),
            'icon' => 'fa-solid fa-key',
            'can' => ['Gestion permisos'],
        ],

        [
            'name' => 'Usuarios',
            'url' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
            'icon' => 'fa-solid fa-users',
            'can' => ['Gestion usuarios'],
        ],
        [
            'name' => 'Hoteles',
            'url' => route('admin.hoteles.index'),
            'active' => request()->routeIs('admin.hoteles.*'),
            'icon' => 'fa-solid fa-hotel',
            'can' => ['Gestion hoteles'],
        ],
        [
            'name' => 'Subproductos',
            'url' => route('admin.subproductos.index'),
            'active' => request()->routeIs('admin.subproductos.*'),
            'icon' => 'fa-solid fa-recycle',
            'can' => ['Gestion subproductos'],
        ],
        [
            'name' => 'Evidencias',
            'url' => route('admin.evidencias.index'),
            'active' => request()->routeIs('admin.evidencias.*'),
            'icon' => 'fa-solid fa-images',
            'can' => ['Gestion evidencias'],
        ],
        [
            'name' => 'Formulario',
            'url' => route('admin.forms.index'),
            'active' => request()->routeIs('admin.forms.*'),
            'icon' => 'fa-brands fa-wpforms',
            'can' => ['Gestion formulario'],
        ],
        [
            'name' => 'Graficas',
            'url' => route('admin.graficas.index'),
            'active' => request()->routeIs('admin.graficas.*'),
            'icon' => 'fa-solid fa-chart-line',
            //'can' => ['Gestion evidencias'],
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        '-translate-x-full': !open,
        'transfrom-none': open,
    }" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                @canany($link['can'] ?? [null])
                    <li>
                        <a href="{{ $link['url'] }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                            <i class="fas {{ $link['icon'] }} text-grayu-600"></i>
                            <span class="ms-3">
                                {{ $link['name'] }}
                            </span>
                        </a>
                    </li>
                @endcanany
            @endforeach


        </ul>
    </div>
</aside>
