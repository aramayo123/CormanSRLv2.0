<section class="bg-gray-50 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="buscar" class="sr-only">Buscar</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" x-model="search" id="buscar"
                                class="cursor-text bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2"
                                placeholder="Buscar..." required="">
                            <button type="button" id="boton_buscar"
                                class="text-white absolute end-0 bottom-0 -top-[1px] focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 ">
                    @if (count($tareasAsignadas))
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-4 py-3">Ticket</th>
                                <th scope="col" class="px-4 py-3">Cliente</th>
                                <th scope="col" class="px-4 py-3">Sucursal</th>
                                <th scope="col" class="px-4 py-3 rounded-xl text-red-500 ">Prioridad</th>
                                <th scope="col" class="px-4 py-3">Fecha</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                    @endif
                    <tbody id="tabla">
                        @forelse ($tareasAsignadas as $tarea)
                            <tr class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $tarea->tipo_de_tarea == "PREVENTIVO" ? "Preventivo":$tarea->ticket }}</th>
                                <td class="px-4 py-3">{{ $tarea->Tarea->Cliente->cliente }}</td>
                                <td class="px-4 py-3">{{ $tarea->Tarea->Sucursal->sucursal }}</td>
                                <td
                                    class="px-4 py-3 rounded-xl text-{{ $tarea->Tarea->ColorTipoPrioridad() }}-500 rounded-xl ">
                                    <?php
                                    echo $tarea->Tarea->Prioridad ? $tarea->Tarea->Prioridad->prioridad : '-';
                                    ?></td>
                                <td class="px-4 py-3 flex items-center justify-center align-items-center">
                                    <a href="{{ url('tareas/' . $tarea->Tarea->id . '/completar') }}">
                                        <button type="button"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
                                            COMPLETAR
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                    </tbody>
                    <p class="text-center text-slate-950 my-5">Todavia no tienes tareas
                        asignadas</p>
                    @endforelse
                </table>
            </div>
            @if (count($tareasAsignadas))
                <div class="flex flex-col items-center my-5">
                    <!-- Help text -->
                    <span class="text-sm text-gray-800">
                        Mostrando <span class="font-semibold text-gray-900" id="paginaActual"></span> de <span
                            class="font-semibold text-gray-900" id="max_pag"></span> página<span
                            id="terminacion"></span>
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <!-- Buttons -->
                        <button onclick="PaginaPrev()"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium rounded-s hover:bg-gray-900 bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">
                            <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            Prev
                        </button>
                        <button onclick="PaginaNext()"
                            class="flex items-center justify-center px-4 h-10 text-base font-medium bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">
                            Next
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    const limit_for_pag = 5;
    var text_max_pag = document.querySelector('#max_pag');
    var registros = @json($tareasAsignadas);
    var max_pag = Math.ceil(registros.length / limit_for_pag);
    var terminacion = document.querySelector("#terminacion");
    if (terminacion)
        terminacion.innerHTML = max_pag == 1 ? "" : "s";
    var Tabla = document.querySelector("#tabla");
    var PagActual = 0;
    if (Tabla) Tabla.innerHTML = "";
    if (text_max_pag) text_max_pag.innerHTML = max_pag;

    document.addEventListener('DOMContentLoaded', function() {
        if (Tabla)
            RellenarTabla();
    });

    function PaginaNext() {
        if (PagActual < max_pag - 1)
            PagActual++

        RellenarTabla()
    }

    function PaginaPrev() {
        if (PagActual > 0)
            PagActual--

        RellenarTabla()
    }
    function data(registro){
            return `
                <tr class="border-b">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                        ${ registro.tarea.tipo_de_tarea === "PREVENTIVO" ? "Preventivo": "#"+registro.tarea.ticket}</th>
                    <td class="px-4 py-3">${registro.tarea.cliente.cliente}</td>
                    <td class="px-4 py-3">${registro.tarea.sucursal.numero} ${registro.tarea.sucursal.sucursal}</td>
                    <td class="px-4 py-3 rounded-xl ">
                        ${registro.tarea.prioridad ? registro.tarea.prioridad.prioridad : "-" }
                    </td>
                    <td class="px-4 py-3 rounded-xl ">
                        ${registro.tarea.fecha_mail ? registro.tarea.fecha_mail : "-" }
                    </td>
                    <td class="px-4 py-3 flex items-center justify-center align-items-center">
                        <a href="{{ url('tareas') }}/${registro.tarea.id}/completar">
                            <button type="button"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
                                COMPLETAR
                            </button>
                        </a>
                    </td>
                </tr>
        `;
    }
    function RellenarTabla() {
        var min = (limit_for_pag * PagActual);
        var max = min + limit_for_pag;
        var contador = min;
        var paginaActual = document.querySelector("#paginaActual");
        if(paginaActual) paginaActual.innerHTML = (PagActual + 1);
        Tabla.innerHTML = "";
        for (var i = contador; i < max; i++) {
            if (i >= registros.length)
                continue

            var registro = registros[i];
            //console.log(registro)
            if (contador >= min && contador <= max) {
                Tabla.innerHTML += data(registro);
            }
        }
    }
    function KeyUpDown(event){
        if (event.isComposing || event.keyCode === 229) {
            return;
        }
        if (!buscador.value) {
            RellenarTabla()
            return
        }
        if (buscador.value) {
            TablaCompleta();
            var filtro = buscador.value.toLowerCase();
            var filas = Tabla.getElementsByTagName('tr');
            for (var i = 0; i < filas.length; i++) {
                var textoFila_0 = filas[i].children[0].innerText.toLowerCase() || filas[i].children[0].textContent.toLowerCase(); 
                var textoFila_1 = filas[i].children[2].innerText.toLowerCase() || filas[i].children[2].textContent.toLowerCase(); 
                
                if (textoFila_0.includes(filtro) || textoFila_1.includes(filtro))
                    filas[i].style.display = '';
                else
                    filas[i].style.display = 'none';
            }
        }
    }
    var buscador = document.querySelector("#buscar");
    if (buscador){
        buscador.addEventListener("keyup", KeyUpDown);
        buscador.addEventListener("keydown", KeyUpDown);
    }
    
    boton_buscar = document.querySelector("#boton_buscar");
    if (boton_buscar)
        boton_buscar.addEventListener('click', KeyUpDown);

    function TablaCompleta() {
        Tabla.innerHTML = "";
        for (var i = 0; i < registros.length; i++) {
            var registro = registros[i];
            Tabla.innerHTML += data(registro);
        }
    }
</script>
