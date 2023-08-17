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
                    <div class="mt-6">
                        <div>
                            @if ($permission->roles)
                                <div class="my-10">
                                    <p class="block text-gray-700 text-sm font-bold mb-1" for="nombre">
                                        Roles del permiso
                                    </p>
                                    @foreach ($permission->roles as $permision_rol)
                                    <span id="badge-dismiss-default" class="inline-flex items-center px-2 py-1 mr-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">
                                        {{ $permision_rol->name }}
                                        <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="inline-flex items-center p-1 ml-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300">
                                          <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                          </svg>
                                          <span class="sr-only">Remove badge</span>
                                        </button>
                                      </span>
                                      <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                          <div class="relative w-full max-w-lg max-h-full">
                                              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                  <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                      </svg>
                                                      <span class="sr-only">Close modal</span>
                                                  </button>
                                                  <div class="p-6 text-center">
                                                      <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                      </svg>
                                                      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estas seguro de eliminar el rol: "{{$permision_rol->name}}" para el permiso: "{{$permission->name}}"</h3>
                                                      <form action="{{ route('admin.permissions.roles.remove', [$permission->id,$permision_rol->id]) }}" method="POST" class="flex justify-center">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Si, estoy seguro
                                                        </button>
                                                        <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mb-4 max-w-lg">
                                <form action="{{ route('admin.permissions.roles', $permission->id) }}" method="POST">
                                    @csrf
                                    <label class="block text-gray-700 text-sm font-bold mb-1" for="nombre">
                                        Asignar rol a permiso
                                    </label>
                                    <select id="permission" name="role" autocomplete="permission-name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                        <span class="text-red-400">{{ $message }}</span>
                                    @enderror
                                    <button
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 mt-3"
                                        type="submit">
                                        Asignar
                                    </button>
                                </form>
                            </div>
                        </div>
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
