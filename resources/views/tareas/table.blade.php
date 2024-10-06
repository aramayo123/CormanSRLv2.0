@php
    $tareas_modify = [];
    for($i = 0; $i < count($tareas); $i++){
        $tarea = $tareas[$i];
        $tarea->color_tarea = $tarea->ColorTipoTarea();
        $tarea->color_prioridad = $tarea->ColorTipoPrioridad();
        $tarea->color_estado = $tarea->ColorEstado();
        $tarea->certificado = $tarea->Certificado();
        $tarea->atm = $tarea->Atm();
        $tarea->color_atm = $tarea->ColorAtm();
        array_push($tareas_modify, $tarea);
    }
@endphp
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
                @can('tareas.create')
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button data-modal-target="carga-masiva" data-modal-toggle="carga-masiva" type="button"
                            class="flex items-center justify-center text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
                            <svg class="mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="19" height="19" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-4m5-13v4a1 1 0 0 1-1 1H5m0 6h9m0 0-2-2m2 2-2 2" />
                            </svg>Cargar
                        </button>
                        @can('tareas.notificar')
                        <button type="button" onclick="NotificarOperarios()"
                            class="flex items-center justify-center text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
                            <svg class="mr-2 text-white" width="19" height="19" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                <line x1="12" y1="12" x2="12" y2="12.01" />
                                <line x1="8" y1="12" x2="8" y2="12.01" />
                                <line x1="16" y1="12" x2="16" y2="12.01" />
                            </svg>
                            Notificar
                        </button>
                        @endcan
                        <a href="{{ url('tareas/create') }}"
                            class="flex items-center justify-center text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            <button type="button">Nueva tarea</button>
                        </a>
                    </div>
                @endcan
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 my-1 mx-1">
                    @if (count($tareas))
                        <thead class="text-xs text-gray-700 uppercase">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    Ticket</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    Cliente</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    Sucursal</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl text-red-500 bg-red-200 outline outline-offset-0 outline-1 outline-gray-800">
                                    Prioridad</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl text-red-500 bg-red-200 outline outline-offset-0 outline-1 outline-gray-800">
                                    Estado</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    Certificado</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl text-red-500 bg-red-200 outline outline-offset-0 outline-1 outline-gray-800">
                                    ATM</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    Fecha de cierre</th>
                                <th scope="col"
                                    class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                    @endif
                    <tbody id="tabla">
                        @forelse ($tareas as $tarea)
                            <tr class="border-b">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    {{ $tarea->tipo_de_tarea == "PREVENTIVO" ? "Preventivo":$tarea->ticket }}</th>
                                <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    {{ $tarea->Cliente->cliente }}</td>
                                <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    {{ $tarea->Sucursal->sucursal }}</td>
                                <td
                                    class="px-4 py-3 rounded-xl text-{{ $tarea->ColorTipoPrioridad() }}-500 bg-{{ $tarea->ColorTipoPrioridad() }}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    <?php
                                    echo $tarea->Prioridad ? $tarea->Prioridad->prioridad : '-';
                                    ?></td>
                                <td
                                    class="px-4 py-3 rounded-xl text-{{ $tarea->ColorEstado() }}-500 bg-{{ $tarea->ColorEstado() }}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    <?php
                                    echo $tarea->Estado ? $tarea->Estado->estado : '-';
                                    ?></td>
                                <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    {{ $tarea->Certificado() }}</td>
                                <td
                                    class="px-4 py-3 text-{{ $tarea->ColorAtm() }}-500 bg-{{ $tarea->ColorAtm() }}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    {{ $tarea->Atm() }}</td>
                                <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    {{ $tarea->fecha_cerrado }}</td>
                                <td
                                    class="px-4 py-3 flex items-center justify-center align-items-center rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                                    @can('tareas.notificar')
                                    <button type="button" class="hover:cursor-pointer hover:bg-gray-100"
                                        onclick="NotificarTarea(this, '{{ $tarea->id }}')">
                                        <svg class="w-6 h-6 text-gray-800" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                            <line x1="12" y1="12" x2="12" y2="12.01" />
                                            <line x1="8" y1="12" x2="8" y2="12.01" />
                                            <line x1="16" y1="12" x2="16" y2="12.01" />
                                        </svg>
                                    </button>
                                    @endcan
                                    @can('tareas.read')
                                    <a href="{{ url('tareas/' . $tarea->id) }}"
                                        class="hover:cursor-pointer hover:bg-gray-100">
                                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                            <path stroke="currentColor" stroke-width="2"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </a>
                                    @endcan
                                    @can('tareas.update')
                                        <a href="{{ url('tareas/' . $tarea->id . '/edit') }}"
                                            class="hover:cursor-pointer hover:bg-gray-100">
                                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('tareas.destroy')
                                        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="post"
                                            onclick="Eliminar(this, '{{ $tarea->ticket }}')">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="hover:cursor-pointer hover:bg-gray-100 mt-1">
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @empty
                    </tbody>
                    <p class="text-center text-slate-950 my-5">Todavia no existen tareas registradas</p>
                    @endforelse
                </table>
            </div>
            @if (count($tareas))
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

@include('tareas.modal')
<script>
    function Eliminar(e, tarea) {
        Swal.fire({
            title: "Estas seguro?",
            text: `Estas a punto de eliminar la tarea "${tarea}"`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                e.children[2].setAttribute('type', 'submit');
                e.submit();
            }
        });
    }

    function NotificarOperarios(e) {
        Swal.fire({
            title: "Estas seguro?",
            text: `Estas a punto enviar un whatsapp a los grupos notificando a los operarios`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, notificar!"
        }).then((result) => {
            if (result.isConfirmed) {
                Notify();
            }
        });
    }

    function NotificarTarea(e, id) {
        Swal.fire({
            title: "Estas seguro?",
            text: `Estas a punto enviar un whatsapp a los grupos notificando a los operarios`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, notificar!"
        }).then((result) => {
            if (result.isConfirmed) {
                NotificarTareaPost(id);
            }
        });
    }
    const NotificarTareaPost = async (id) => {
        try {
            const formData = new FormData();
            formData.append("id_tarea", id);
            const url = "{{ url('/notificar_tarea') }}";
            const opciones = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    'Accept': 'application/json',
                },
                method: 'POST',
                body: formData,
            };
            const res = await fetch(url, opciones);
            const data = await res.json();
            console.log(data)
            if (data.message === "exito") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Notificados todos!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        } catch (error) {
            console.log(error)
        }
    }
    const Notify = async () => {
        try {
            const formData = new FormData();
            const url = "{{ url('/notificar_all') }}";
            const opciones = {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    'Accept': 'application/json',
                },
                method: 'POST',
                body: formData,
            };
            const res = await fetch(url, opciones);
            const data = await res.json();
            console.log(data)
            if (data.message === "exito") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Notificados todos!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        } catch (error) {
            console.log(error)
        }
    }

    const limit_for_pag = 5;
    var text_max_pag = document.querySelector('#max_pag');
    var registros = @json($tareas_modify).reverse();
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
                    <th scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${ registro.tipo_de_tarea === "PREVENTIVO" ? "Preventivo": "#"+registro.ticket}</th>
                    <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${registro.cliente.cliente}</td>
                    <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${registro.sucursal.numero} ${registro.sucursal.sucursal}</td>
                    <td class="px-4 py-3 rounded-xl text-${registro.color_prioridad}-500 bg-${registro.color_prioridad}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${registro.prioridad ? registro.prioridad.prioridad : "-" }</td>
                    <td class="px-4 py-3 rounded-xl text-${registro.color_estado}-500 bg-${registro.color_estado}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${registro.estado.estado}</td>
                    <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${registro.certificado}</td>
                    <td
                        class="px-4 py-3 text-${registro.color_atm}-500 bg-${registro.color_atm}-200 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${registro.atm}</td>
                    <td class="px-4 py-3 rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        ${registro.fecha_cerrado ? registro.fecha_cerrado:""}</td>
                    <td class="px-4 py-3 flex items-center justify-center align-items-center rounded-xl outline outline-offset-0 outline-1 outline-gray-800">
                        @can('tareas.notificar')
                            <button type="button" class="hover:cursor-pointer hover:bg-gray-100"
                                onclick="NotificarTarea(this, '${registro.id}')">
                                <svg class="w-6 h-6 text-gray-800" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                                    <line x1="12" y1="12" x2="12" y2="12.01" />
                                    <line x1="8" y1="12" x2="8" y2="12.01" />
                                    <line x1="16" y1="12" x2="16" y2="12.01" />
                                </svg>
                            </button>
                        @endcan
                        @can('tareas.read')
                            <a href="{{ url('tareas') }}/${registro.id}"
                                class="hover:cursor-pointer hover:bg-gray-100">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>
                        @endcan
                        @can('tareas.update')
                            <a href="{{ url('tareas') }}/${registro.id}/edit"
                                class="hover:cursor-pointer hover:bg-gray-100">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                </svg>
                            </a>
                        @endcan
                        @can('tareas.destroy')
                            <form action="{{ url('tareas') }}/${registro.id}" method="post"
                                onclick="Eliminar(this, '${registro.ticket}')">
                                @csrf
                                @method('delete')
                                <button type="button" class="hover:cursor-pointer hover:bg-gray-100 mt-1">
                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                            </form>
                        @endcan
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
                var textoFila_2 = filas[i].children[8].innerText.toLowerCase() || filas[i].children[8].textContent.toLowerCase();
                var textoFila_3 = filas[i].children[3].innerText.toLowerCase() || filas[i].children[3].textContent.toLowerCase();
                
                if (textoFila_0.includes(filtro) || textoFila_1.includes(filtro) || textoFila_2.includes(filtro) || textoFila_3.includes(filtro))
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
