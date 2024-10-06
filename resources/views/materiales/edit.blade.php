<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar material') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <form action="{{ route('materiales.update', $material->id) }}" method="post" class="max-w-xl mx-auto">
                        @csrf
                        @method('patch')
                        <div class="mb-5">
                            <label for="rubro_id" class="block mb-2 text-sm font-medium text-gray-900 ">Seleccione un
                                rubro <p class="inline-block text-red-500">*</p></label>
                            <select id="rubro_id" name="rubro_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option selected value="">Ninguna seleccion</option>
                                @foreach ($rubros as $rubro)
                                    <option value="{{ $rubro->id }}" <?php echo $material->rubro_id == $rubro->id ? 'selected' : ''; ?>> {{ $rubro->rubro }}
                                    </option>
                                @endforeach
                            </select>
                            <x-mi-input-error :messages="$errors->get('rubro_id')" />
                        </div>
                        <div class="mb-5">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba la descripcion del material: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="descripcion" name="descripcion" value="{{ $material->descripcion }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ejemplo: FOCO LED 9W"  />
                            <x-mi-input-error :messages="$errors->get('descripcion')" />
                        </div>
                        <div class="mb-5">
                            <label for="unidad" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba la unidad de medida: <p class="inline-block text-red-500">*</p></label>
                            <input type="text" id="unidad" name="unidad" value="{{ $material->unidad }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ejemplo: PZA"  />
                            <x-mi-input-error :messages="$errors->get('unidad')" />
                        </div>
                        <div class="mx-auto text-center">
                            <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-blue-700 bg-blue-800 text-white border-blue-600 hover:text-white hover:bg-blue-700">
                                ACTUALIZAR
                            </button>
                            <a href="{{ url('/materiales')}}">
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
