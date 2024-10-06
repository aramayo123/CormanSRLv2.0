<?php
    use App\Models\TareaAsignada;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar tarea') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <form action="{{ route('tareas.update', $tarea->id) }}" method="post" class="max-w-xl mx-auto">
                        @csrf
                        @method('patch')
                        <div class="mb-5">
                            <label for="tipo_de_tarea" class="block mb-2 text-sm font-medium text-gray-900 ">Tipo de tarea :</label>
                            <select disabled class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="{{ $tarea->tipo_de_tarea }}" selected>{{ $tarea->tipo_de_tarea }}</option>
                            </select>
                            <select id="tipo_de_tarea" name="tipo_de_tarea" class="hidden">
                                <option value="{{ $tarea->tipo_de_tarea }}" selected>{{ $tarea->tipo_de_tarea }}</option>
                            </select>
                            <x-mi-input-error :messages="$errors->get('tipo_de_tarea')" />
                        </div>
                        <div class="mb-5 flex gap-5 ocultar">
                            <div class="w-8/12">
                                <label for="ticket" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba el
                                    numero de ticket (Remedy): <p class="inline-block text-red-500">*</p></label>
                                <input type="text" id="ticket" name="ticket" value="{{ $tarea->ticket }}"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="" />
                                <x-mi-input-error :messages="$errors->get('ticket')" />
                            </div>
                            <div class="ml-5">
                                <label for="atm" class="block mb-2 text-sm font-medium text-gray-900 ">ATM
                                    <p class="inline-block text-gray-500">(opcional)</p>:
                                </label>
                                <input id="atm" type="checkbox" value="1" name="atm" <?php echo $tarea->atm ? 'checked' : ''; ?>
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-2">
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="cliente_id" class="block mb-2 text-sm font-medium text-gray-900 ">Seleccione un
                                cliente <p class="inline-block text-red-500">*</p></label>
                            <select id="cliente_id" name="cliente_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">Ninguna seleccion</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" <?php echo $tarea->cliente_id == $cliente->id ? 'selected' : ''; ?>> {{ $cliente->cliente }}
                                    </option>
                                @endforeach
                            </select>
                            <x-mi-input-error :messages="$errors->get('cliente_id')" />
                        </div>
                        <div class="mb-5">
                            <label for="sucursal_id" class="block mb-2 text-sm font-medium text-gray-900 ">Seleccione una
                                sucursal <p class="inline-block text-red-500">*</p></label>
                            <select id="sucursal_id" name="sucursal_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">Ninguna seleccion</option>
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}" <?php echo $tarea->sucursal_id == $sucursal->id ? 'selected' : ''; ?>> {{ $sucursal->numero . " " .$sucursal->sucursal }}
                                    </option>
                                @endforeach
                            </select>
                            <x-mi-input-error :messages="$errors->get('sucursal_id')" />
                        </div>
                        <div class="mb-5 ocultar">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba una descripcion: <p class="inline-block text-gray-500">(opcional)</p></label>
                            <textarea id="descripcion" name="descripcion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Intente separar con *">{{ $tarea->descripcion }}</textarea>
                        </div>
                        <div class="mb-5 ocultar">
                            <label for="elementos" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba los elementos afectados: <p class="inline-block text-gray-500">(opcional)</p></label>
                            <textarea id="elementos" name="elementos" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Intente separar con *">{{ $tarea->elementos }}</textarea>
                        </div>
                        <div class="mb-5 ocultar">
                            <label for="diagnostico" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba el diagnostico de la situacion: <p class="inline-block text-gray-500">(opcional)</p></label>
                            <textarea id="diagnostico" name="diagnostico" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Intente separar con *">{{ $tarea->diagnostico }}</textarea>
                        </div>
                        <div class="mb-5 ocultar">
                            <label for="acciones" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba las acciones ejecutadas: <p class="inline-block text-gray-500">(opcional)</p></label>
                            <textarea id="acciones" name="acciones" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Intente separar con *">{{ $tarea->acciones }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900 ">Escriba las observaciones: <p class="inline-block text-gray-500">(opcional)</p></label>
                            <textarea id="observaciones" name="observaciones" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Intente separar con *">{{ $tarea->observaciones }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label for="fecha_mail" class="block mb-2 text-sm font-medium text-gray-900 ">Seleccione la
                                fecha del mail <p class="inline-block text-gray-500">(opcional)</p></label>
                            <input type="date" id="fecha_mail" name="fecha_mail" value="{{ $tarea->fecha_mail }}"
                                class="hover:cursor-pointer bg-gray-100 hover:bg-gray-200 rounded-md">
                            <x-mi-input-error :messages="$errors->get('fecha_mail')" />
                        </div>
                        <div class="mb-5 ocultar">
                            <label for="fecha_cerrado" class="block mb-2 text-sm font-medium text-gray-900 ">Seleccione
                                la fecha de cierre <p class="inline-block text-gray-500">(opcional si es correctivo)</p></label>
                            <input type="date" datepicker id="fecha_cerrado" name="fecha_cerrado" value="{{ $tarea->fecha_cerrado }}"
                                class="hover:cursor-pointer bg-gray-100 hover:bg-gray-200 rounded-md">
                            <x-mi-input-error :messages="$errors->get('fecha_cerrado')" />
                        </div>
                        <div class="mb-5 ocultar">
                            <label for="prioridad_id" class="block mb-2 text-sm font-medium text-gray-900 ">Seleccione una
                                prioridad <p class="inline-block text-red-500">*</p></label>
                            <select id="prioridad_id" name="prioridad_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">Ninguna seleccion</option>
                                @foreach ($prioridades as $prioridad)
                                    <option value="{{ $prioridad->id }}" <?php echo $tarea->prioridad_id == $prioridad->id ? 'selected' : ''; ?>>
                                        {{ $prioridad->prioridad }}
                                    </option>
                                @endforeach
                            </select>
                            <x-mi-input-error :messages="$errors->get('prioridad_id')" />
                        </div>
                        <div class="mb-5">
                            <label for="estado_id" class="block mb-2 text-sm font-medium text-gray-900 ">Seleccione un estado <p class="inline-block text-red-500">*</p></label>
                            <select id="estado_id" name="estado_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">Ninguna seleccion</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}" <?php echo $tarea->estado_id == $estado->id ? 'selected' : ''; ?>>
                                        {{ $estado->estado }}
                                    </option>
                                @endforeach
                            </select>
                            <x-mi-input-error :messages="$errors->get('estado_id')" />
                        </div>
                        <div class="mb-5">
                            <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300"
                                type="button">Seleccionar personal <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg></button>

                            <!-- Dropdown menu -->
                            <div id="dropdownSearch"
                                class="z-10 hidden bg-white rounded-lg shadow w-60 ">
                                <div class="p-3">
                                    <label for="input-group-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input type="text" disabled id="input-group-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                            placeholder="Search user">
                                    </div>
                                </div>
                                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 "
                                    aria-labelledby="dropdownSearchButton">
                                    @foreach ($users as $user)
                                        @if (!$user->hasRole('Corman') && !$user->hasRole('Facilitie'))
                                            <li>
                                                <div
                                                    class="flex items-center p-2 rounded hover:bg-gray-100 ">
                                                    <input id="{{ $user->username }}" type="checkbox" value="1" name="{{ $user->username }}"
                                                        {{ count(TareaAsignada::where('tarea_id', '=', $tarea->id)->where('user_id', '=', $user->id)->get()) ? "checked":"" }}
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 ">
                                                    <label for="{{ $user->username }}"
                                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded ">{{ $user->name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="mx-auto text-center">
                            <button type="submit"
                                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-blue-700 bg-blue-800 text-white border-blue-600 hover:text-white hover:bg-blue-700">
                                GUARDAR
                            </button>
                            <a href="{{ url('/tareas') }}">
                                <button type="button"
                                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-red-700 bg-red-800 text-white border-red-600 hover:text-white hover:bg-red-700">
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
<script>
    var seleccion = document.querySelector('#tipo_de_tarea');
    var divsOcultar = document.querySelectorAll('.ocultar');

    document.addEventListener('DOMContentLoaded', function() {
        var selectedOption = seleccion.options[seleccion.selectedIndex];
        if(selectedOption.value === "PREVENTIVO"){
            divsOcultar.forEach(element => {
                element.classList.add("hidden");
            });
        }else{
            divsOcultar.forEach(element => {
                element.classList.remove("hidden");
            });
        }
    });

    seleccion.addEventListener('change',
        function(){
            var selectedOption = this.options[seleccion.selectedIndex];
            if(selectedOption.value === "PREVENTIVO"){
                divsOcultar.forEach(element => {
                    element.classList.add("hidden");
                });
            }else{
                divsOcultar.forEach(element => {
                    element.classList.remove("hidden");
                });
            }
        }
    );
</script>