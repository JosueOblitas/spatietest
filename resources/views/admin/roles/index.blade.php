<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 mx-auto container">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 flex justify-end">
                   <a href="{{route('admin.roles.create')}}"><button class="px-3 py-1 rounded-sm  text-white bg-green-700">Crear Role</button></a>
                </div>
                <div class="relative overflow-x-auto p-3">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 p-4">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nombre de Rol
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $role->name }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex justify-end">
                                        <div class="space-x-2">
                                            <a href="{{ route('admin.roles.edit',$role->id) }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-sm">Editar</a>
                                            <a href="" class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-sm">Eliminar</a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
