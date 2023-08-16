<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mx-auto container">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto p-3">
                    <form action="{{ route('admin.permissions.update', $permission) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-1" for="nombre">
                                Nombre
                            </label>
                            <input class="w-64 px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                                type="text" value="{{$permission->name}}" id="name" name="name" placeholder="Escribe el nombre del permiso">
                            @error('name') <span class="text-red-400">{{$message}}</span> @enderror
                        </div>
                        <div class="">
                            <button
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300"
                                type="submit">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="p-4 flex justify-center">
            <a href="">Ir atras</a>
        </div>
    </div>
</x-admin-layout>
