<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('admin.dashboard')],
    ['name' => 'Usuarios', 'url' => route('admin.users.index')],
    ['name' => $user->name],
]">
    <div class="bg-white rounded shadow-lg p-6">

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- <x-validation-errors class="mb-4" /> --}}

            <div class="mb-4">
                <x-label>
                    Nombre
                </x-label>
                <x-input name="name" value="{{ old('name', $user->name) }}" class="w-full" />
            </div>
            <div class="mb-4">
                <x-label>
                    Email
                </x-label>
                <x-input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full" />
            </div>
            <div class="mb-4">
                <x-label>
                    Hotel
                </x-label>
                <x-select name="idHotel" class="w-full">
                    <!-- Opción predeterminada en caso de que no haya hotel seleccionado -->
                    <option value="" disabled @if (!$user->idHotel) selected @endif>-- Selecciona un
                        hotel --</option>

                    <!-- Listado de hoteles -->
                    @foreach ($hoteles as $hotel)
                        <option value="{{ $hotel->idHotel }}" @if (old('hotel') == $hotel->idHotel || $user->idHotel == $hotel->idHotel) selected @endif>
                            {{ $hotel->nombre }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            {{-- <div class="mb-4">
                <x-label>
                    Password
                </x-label>
                <x-input type="password" name="passwors" class="w-full" />
            </div>
            <div class="mb-4">
                <x-label>
                    Confirmar Password
                </x-label>
                <x-input type="password" name="passwors_confirmation" class="w-full" />
            </div> --}}
            <div class="m-4">
                <ul>
                    @foreach ($roles as $role)
                        <li>
                            <label>
                                <x-checkbox name="roles[]" value="{{ $role->id }}" :checked="in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))" />
                                {{ $role->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-end">
                <x-button>
                    Actualizar usuario
                </x-button>
            </div>
        </form>
    </div>
</x-admin-layout>
