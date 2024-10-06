<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear sucursal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <form action="{{ route('sucursales.store') }}" method="post" class="max-w-xl mx-auto">
                        @csrf
                        <div class="mb-5">
                            <label for="zona" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba una zona para separar por categorias: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="zona" name="zona" value="{{ old('zona') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ejemplo: NORTE"  />
                            <x-mi-input-error :messages="$errors->get('zona')" />
                        </div>
                        <div class="mb-5">
                            <label for="numero" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba el numero de la sucursal: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="numero" name="numero" value="{{ old('numero') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ejemplo: 100 o ATM"  />
                            <x-mi-input-error :messages="$errors->get('numero')" />
                        </div>
                        <div class="mb-5">
                            <label for="sucursal" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba un nombre para la sucursal: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="sucursal" name="sucursal" value="{{ old('sucursal') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ejemplo: PLAZA EMPRESAS"  />
                            <x-mi-input-error :messages="$errors->get('sucursal')" />
                        </div>
                        <div class="mb-5">
                            <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba la direccion de la sucursal: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ejemplo: BELGRANO 549"  />
                            <x-mi-input-error :messages="$errors->get('direccion')" />
                        </div>
                        <div class="mx-auto text-center">
                            <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-blue-700 bg-blue-800 text-white border-blue-600 hover:text-white hover:bg-blue-700">
                                GUARDAR
                            </button>
                            <a href="{{ url('/sucursales')}}">
                                <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-red-700 bg-red-800 text-white border-red-600 hover:text-white hover:bg-red-700">
                                    CANCELAR
                                </button>    
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
