<x-app-layout>

    <figure class="mb-12">
        <img src="{{ asset('img/home/portada.jpeg') }}" alt="Portada del Home"
            class="w-full aspect[3/1] object-cover object-center">
    </figure>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <h1 class="text-3xl text-center font-semibold mb-6">
            Lista de Articulos
        </h1>
        {{-- d --}}
        i categoria ==! "" undefined null else categoria == post == consulta base de datos
        <div class="grid grid-cols-4">
            <div class="col-span-1">
                <form action="{{ route('home') }}">
                    <div class="mb-4">
                        <p class="text-lg font-semibold">
                            Ordenar por:
                        </p>
                        <select name="order"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="new">Más recientes</option>
                            <option value="old" @selected(request('order') == 'old')>Más antiguos</option>
                        </select>
                    </div>
                    <div>
                        <p class="text-lg font-semibold">Categorías:</p>

                        <ul>
                            @if (is_array(request('category')))
                                @foreach ($categories as $category)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                @if (is_array(request('category')) && in_array($category->id, request('category'))) checked @endif
                                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                            <span class="ml-2 text-gray-700">
                                                {{ $category->name }}
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            @else
                                $category = []
                                @foreach ($categories as $category)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                @if (request('category') == $category->id) checked @endif
                                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                            <span class="ml-2 text-gray-700">
                                                {{ $category->name }}
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>

                    <div class="mt-4">

                        <x-button>
                            Aplicar filtros
                        </x-button>
                    </div>
                </form>
            </div>
            <div class="col-span-3">
                <div class="space-y-8">
                    @foreach ($posts as $post)
                        <article class="grid grid-cols-2 gap-6 ">
                            <figure
                                class="relative max-w-sm transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                                <a href="{{ route('posts.show', $post) }}">
                                    <img class="rounded-lg" src="{{ $post->image }}" alt="{{ $post->title }}">
                                </a>
                                <figcaption class="absolute px-4 text-lg text-white bottom-6">
                                    {{-- <p>Do you want to get notified when a new component is added to Flowbite?</p> --}}
                                </figcaption>
                            </figure>

                            <div>
                                <h1 class="text-xl font-semibold">
                                    <a href="{{ route('posts.show', $post) }}"
                                        class="hover:underline">{{ $post->title }}</a>
                                </h1>
                                <hr class="mt-1
                                        mb-2">
                                <div class="mb-2">
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('home') . '?tag=' . $tag->name }}">
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $tag->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                                <p class="text-sm mb-2">
                                    {{ $post->published_at->format('d M Y') }}
                                </p>
                                <div class="mb-4">
                                    {{ Str::limit($post->excerpt, 100) }}
                                </div>
                                <div>
                                    <button
                                        class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                                        <a href="{{ route('posts.show', $post) }}"
                                            class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                            Leer más
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mb-8">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>




    </section>



</x-app-layout>
