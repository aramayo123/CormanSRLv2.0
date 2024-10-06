<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <style>
        hr {
            color: #FF5733;
            border-color: #FF5733;
        }
    </style>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <div class="max-w-xl mx-auto">
                        <div class="rounded-xl outline outline-offset-0 outline-1 outline-gray-800 p-5">
                            <div class="mb-5 ">
                                <p class="block mb-2 text-md font-medium text-gray-900 ">Tipo de tarea :
                                    <strong>{{ $tarea->tipo_de_tarea }}</strong>
                                </p>
                                <hr>
                            </div>
                            @if ($tarea->tipo_de_tarea == 'CORRECTIVO')
                                <div class="mb-5">
                                    <p class="block mb-2 text-md font-medium text-gray-900 ">Remedy nro :
                                        <strong>{{ $tarea->ticket }}</strong>
                                    </p>
                                    <hr>
                                </div>
                                <div class="mb-5">
                                    <p class="block mb-2 text-md font-medium text-gray-900 ">ATM :
                                        <strong>{{ $tarea->Atm() }}</strong>
                                    </p>
                                    <hr>
                                </div>
                            @endif
                            <div class="mb-5">
                                <p class="inline-block mb-2 text-md font-medium text-gray-900 ">Cliente :
                                    <strong>{{ $tarea->Cliente->cliente }}</strong>
                                </p>
                                <hr>
                            </div>
                            <div class="mb-5">
                                <p class="inline-block mb-2 text-md font-medium text-gray-900 ">Sucursal : <strong>
                                        {{ $tarea->Sucursal->numero . " " .$tarea->Sucursal->sucursal }}</strong></p>
                                <hr>
                            </div>
                            @if ($tarea->tipo_de_tarea == 'CORRECTIVO')
                                <div class="mb-5 ocultar">
                                    <label for="fecha_cerrado_1"
                                        class="inline-block mb-2 text-md font-medium text-gray-900 ">Seleccione
                                        la fecha de cierre : <p class="inline-block text-red-500">*</p></label>
                                    <input type="date" id="fecha_cerrado_1" name=""
                                        value="{{ $tarea->fecha_cerrado }}"
                                        class="hover:cursor-pointer bg-gray-100 hover:bg-gray-200 rounded-md">
                                    <x-mi-input-error :messages="$errors->get('fecha_cerrado')" />
                                    <hr class="mt-2">
                                </div>
                                <div class="mb-5 ocultar">
                                    <p class="block mb-2 text-md font-medium text-gray-900 ">Prioridad : <strong>
                                            {{ $tarea->Prioridad->prioridad }}</strong></p>
                                    <hr>
                                </div>
                                <div class="mb-5">
                                    <p class="block mb-2 text-md font-medium text-gray-900 ">Estado :
                                        <strong>{{ $tarea->Estado->estado }}</strong>
                                    </p>
                                    <hr>
                                </div>
                                <div class="mb-5">
                                    <p class="block mb-2 text-md font-medium text-gray-900 ">Descripcion del pedido :
                                        <strong>{{ $tarea->descripcion }}</strong>
                                    </p>
                                    <hr>
                                </div>
                            @endif
                        </div>
                        <div class="mt-10 mb-4 rounded-xl outline outline-offset-0 outline-1 outline-gray-800 p-2">
                                <p class="block text-md font-medium rounded-full bg-orange-200 text-gray-900 text-center mb-2">
                                Subir fotos :</p>
                            @if ($tarea->tipo_de_tarea == 'CORRECTIVO')
                                <div class="mb-5 grid grid-cols-1 sm:grid-cols-3 gap-7">
                                    <button data-modal-target="fotos-trabajo" data-modal-toggle="fotos-trabajo"
                                        class="md:mx-auto text-center block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 bg-orange-400 hover:bg-orange-500 focus:ring-orange-800"
                                        type="button">
                                        TRABAJO</button>
                                    <button data-modal-target="fotos-ot" data-modal-toggle="fotos-ot"
                                        class="md:mx-auto text-center block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 bg-orange-400 hover:bg-orange-500 focus:ring-orange-800"
                                        type="button">
                                        OT</button>
                                    <button data-modal-target="fotos-boleta" data-modal-toggle="fotos-boleta"
                                        class="md:mx-auto text-center block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 bg-orange-400 hover:bg-orange-500 focus:ring-orange-800"
                                        type="button">
                                        BOLETAS</button>
                                </div>
                            @else
                                <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-7">
                                    <button data-modal-target="fotos-preventivo" data-modal-toggle="fotos-preventivo"
                                        class="md:mx-auto text-center block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-2 py-2 bg-orange-400 hover:bg-orange-500 focus:ring-orange-800"
                                        type="button">
                                        PREVENTIVO</button>
                                    <button data-modal-target="fotos-planilla" data-modal-toggle="fotos-planilla"
                                        class="md:mx-auto text-center block text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-2 py-2 bg-orange-400 hover:bg-orange-500 focus:ring-orange-800"
                                        type="button">
                                        PLANILLA</button>
                                </div>
                            @endif
                            <div class="grid grid-cols-3 gap-4" id="div-imagenes"></div>

                            <section class="hidden bg-gray-50 px-3 sm:px-5 my-3" id="imagen_delete">
                                <div class="mx-auto max-w-screen-xl ">
                                    <div class="bg-white relative sm:rounded-lg overflow-hidden">
                                        <div class="">
                                            <div id="alert-3"
                                                class="flex items-center px-4 py-2 text-green-800 rounded-lg bg-green-200"
                                                role="alert">
                                                <svg class="w-6 h-6 text-gray-800 " aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <div class="ml-3 text-sm font-medium">
                                                    <p>Imagen eliminada con exito!</p>
                                                </div>
                                                <button type="button"
                                                    class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-green-200 text-green-800 hover:bg-green-300"
                                                    data-dismiss-target="#alert-3" aria-label="Close">
                                                    <span class="sr-only">Close</span>
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="mb-5">
                            <section class="bg-gray-50 mb-5 hidden" id="material_eliminado">
                                <div class="mx-auto max-w-screen-xl ">
                                    <div class="bg-white relative sm:rounded-lg overflow-hidden">
                                        <div class="">
                                            <div id="alert-3"
                                                class="flex items-center p-4 text-green-800 rounded-lg bg-green-200"
                                                role="alert">
                                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <div class="ml-3 text-sm font-medium">
                                                    <p>Material eliminado con exito!</p>
                                                </div>
                                                <button type="button"
                                                    class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 inline-flex items-center justify-center h-8 w-8 bg-green-200 text-green-800 hover:bg-green-300"
                                                    data-dismiss-target="#alert-3" aria-label="Close">
                                                    <span class="sr-only">Close</span>
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div id="table_material" class="mb-5">
                            </div>
                            <div
                                class="mb-5 p-5 bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
                                <div class="mb-5">
                                    <label for="material_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Material: <p
                                            class="inline-block text-red-500">*</p> </label>
                                    <select id="material_id" name="material_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        <option selected value="">Ninguna seleccion</option>
                                        @foreach ($materiales as $material)
                                            <option value="{{ $material->id }}" <?php echo old('material_id') == $material->id ? 'selected' : ''; ?>>
                                                {{ $material->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="error-material_id"
                                        class="hidden flex items-center my-2 text-red-800 rounded-lg " role="alert">
                                        <svg class="w-5 h-5 text-red-900 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-3 text-sm font-medium" id="text-material_id"></div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="cantidad"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Cantidad: <p
                                            class="inline-block text-red-500">*</p> </label>
                                    <input type="number" id="cantidad" name="cantidad" value=""
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="" />
                                    <div id="error-cantidad"
                                        class="hidden flex items-center my-2 text-red-800 rounded-lg " role="alert">
                                        <svg class="w-5 h-5 text-red-900 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-3 text-sm font-medium" id="text-cantidad"></div>
                                    </div>
                                </div>
                                <div class="mb-5">
                                    <label for="precio"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Precio por unidad <p class="inline-block text-gray-500">(redondear)</p>: <p
                                            class="inline-block text-red-500">*</p> </label>
                                    <input type="number" id="precio" name="precio"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="" />
                                    <div id="error-precio"
                                        class="hidden flex items-center my-2 text-red-800 rounded-lg " role="alert">
                                        <svg class="w-5 h-5 text-red-900 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-3 text-sm font-medium" id="text-precio"></div>
                                    </div>
                                </div>
                                <input type="hidden" id="tarea_id" name="tarea_id" value="{{ $tarea->id }}" />
                                <div class="text-center mx-auto" onclick="CrearMaterial()">
                                    <button type="button"
                                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-orange-600 bg-orange-500 text-white border-gray-600 hover:text-white hover:bg-orange-400">
                                        AGREGAR PRESUPUESTO
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mx-auto text-center">
                            <form action="{{ url('tareas/' . $tarea->id . '/cerrar') }}" method="post"
                                class="inline-block">

                                @csrf
                                <input type="date" id="fecha_cerrado" name="fecha_cerrado"
                                        value="{{ $tarea->fecha_cerrado }}"
                                        class="hidden hover:cursor-pointer bg-gray-100 hover:bg-gray-200 rounded-md">
                                <button type="submit"
                                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-orange-600 bg-orange-500 text-white border-gray-600 hover:text-white hover:bg-orange-400">
                                    CERRAR TRABAJO
                                </button>
                            </form>
                            <a href="{{ url('/') }}">
                                <button type="button"
                                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-red-700 bg-red-800 text-white border-red-600 hover:text-white hover:bg-red-700">
                                    CANCELAR
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        fecha_cerrado_1 = document.querySelector("#fecha_cerrado_1");
        fecha_cerrado = document.querySelector("#fecha_cerrado");
        if(fecha_cerrado_1)
            fecha_cerrado_1.addEventListener("change", function (e){
                if(fecha_cerrado)
                    fecha_cerrado.value = fecha_cerrado_1.value;
            })
        document.addEventListener('DOMContentLoaded', function() {
            ObtenerImagenes()
            ObtenerMateriales()
        });

        const ConfirmarEliminarMaterial = (form) => {
            const id = form.previousElementSibling.value;
            const material = form.nextElementSibling.value;
            Swal.fire({
                title: "Estas seguro?",
                text: `Estas a punto de eliminar el material "${material}"`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const EliminarMaterial = async () => {
                        const url = "{{ url('/tareas/materiales/') }}/" + id;
                        try {
                            const opciones = {
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]')
                                        .getAttribute(
                                            'content'),
                                    'Accept': 'application/json',
                                },
                                method: 'DELETE',
                            }
                            const res = await fetch(url, opciones);
                            const data = await res.json();
                            const material_eliminado = document.querySelector("#material_eliminado");
                            material_eliminado.classList.remove("hidden");
                            ObtenerMateriales();
                        } catch (error) {
                            console.log(error)
                        }
                    }
                    EliminarMaterial();
                }
            });
        }

        var material = document.querySelector("#material_id");
        var tarea = document.querySelector("#tarea_id");
        var cantidad = document.querySelector("#cantidad");
        var precio = document.querySelector("#precio");
        const CrearMaterial = async () => {
            const formData = new FormData();
            const url = "{{ url('/tareas/materiales') }}";
            try {
                formData.append("material_id", material.value);
                formData.append("tarea_id", tarea.value);
                formData.append("cantidad", cantidad.value);
                formData.append("precio", precio.value);
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
                var error_material = document.querySelector("#error-material_id");
                var error_precio = document.querySelector("#error-precio");
                var error_cantidad = document.querySelector("#error-cantidad");
                error_material.classList.add("hidden");
                error_precio.classList.add("hidden");
                error_cantidad.classList.add("hidden");
                var text_material = document.querySelector("#text-material_id");
                var text_precio = document.querySelector("#text-precio");
                var text_cantidad = document.querySelector("#text-cantidad");
                // console.log(data)
                if (data.message === "error") {
                    if (data.errors.material_id || data.errors.precio || data.errors.cantidad) {
                        if (data.errors.material_id) {
                            text_material.innerHTML = data.errors.material_id;
                            error_material.classList.remove("hidden");
                        }
                        if (data.errors.precio) {
                            text_precio.innerHTML = data.errors.precio;
                            error_precio.classList.remove("hidden");
                        }
                        if (data.errors.cantidad) {
                            text_cantidad.innerHTML = data.errors.cantidad;
                            error_cantidad.classList.remove("hidden");
                        }
                        return
                    }
                }
                if (data.message === "exito") {
                    error_material.classList.add("hidden");
                    error_precio.classList.add("hidden");
                    error_cantidad.classList.add("hidden");
                    material.value = "";
                    cantidad.value = "";
                    precio.value = "";
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Presupuesto agregado con exito!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    ObtenerMateriales();
                    return
                }
            } catch (error) {
                console.log(error)
            }
        }

        function ObtenerMateriales() {
            var tabla = document.querySelector('#table_material');
            tabla.innerHTML = "";
            const getAll = async () => {
                try {
                    const formData = new FormData();
                    formData.append("tarea_id", tarea.value);
                    const url = "{{ url('materiales_gastados') }}";
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
                    //console.log(data.message)

                    var registro = data.message;
                    var filas = "";
                    registro.forEach(material => {
                        //console.log(material)
                        filas += `
                        <tr class="border-b text-gray-900">
                            <th class="px-4 py-3">${ material.nombre_material}</th>
                            <td class="px-1 py-1">${ material.cantidad }</td>
                            <td class="px-1 py-1">${ material.cantidad*material.precio }</td>
                             <td>
                                <input type="hidden" id="" name="" value="${material.id}">
                                <button type="button"onclick="ConfirmarEliminarMaterial(this)"
                                    class="hover:cursor-pointer hover:bg-gray-100 mt-1">
                                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" 
                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                    </svg>
                                </button>
                                <input type="hidden" id="" name="" value="${material.nombre_material}">
                            </td>
                        </tr>
                        `;
                    });

                    var principal = `
                        <div class="overflow-x-auto bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
                            <table class="w-full text-sm text-left text-gray-500 ">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Material</th>
                                        <th scope="col" class="px-1 py-1">Cantidad</th>
                                        <th scope="col" class="px-1 py-1">Precio $</th>
                                        <th scope="col">
                                            <span class="sr-only">Acciones</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${filas}
                                </tbody>
                            </table>
                        </div>
                    `;
                    if (registro.length)
                        tabla.innerHTML = principal;

                } catch (error) {
                    console.log(error)
                }
            }
            getAll()
        }
        function CerrarViewImage(){
            const $targetEl = document.getElementById('view-image');// options with default values
            const options = {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 fixed inset-0 z-40',
                closable: true,
                onHide: () => {
                    //console.log('modal is hidden');
                },
                onShow: () => {
                    //console.log('modal is shown');
                },
                onToggle: () => {
                    //console.log('modal has been toggled');
                },
            };

            // instance options object
            const instanceOptions = {
                id: 'view-image',
                override: true
            };
            const modal = new Modal($targetEl, options, instanceOptions);
            modal.hide();
        }
        function VerImagen(url, nombre) {
            const imagen_url = document.querySelector("#imagen-url");
            const imagen_name = document.querySelector("#imagen-name");
            imagen_url.setAttribute("src", "{{ asset('') }}" + url);
            imagen_name.innerHTML = nombre;
            
            const $targetEl = document.getElementById('view-image');// options with default values
            const options = {
                placement: 'bottom-right',
                backdrop: 'dynamic',
                backdropClasses:
                    'bg-gray-900/50 fixed inset-0 z-40',
                closable: true,
                onHide: () => {
                   // console.log('modal is hidden');
                },
                onShow: () => {
                    //console.log('modal is shown');
                },
                onToggle: () => {
                    //console.log('modal has been toggled');
                },
            };

            // instance options object
            const instanceOptions = {
                id: 'view-image',
                override: true
            };
            const modal = new Modal($targetEl, options, instanceOptions);
            modal.show();
        }

        function Eliminar(e) {
            Swal.fire({
                title: "Estas seguro?",
                text: `Estas a punto de eliminar la imagen `,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const tarea_id = e.children[1].value;
                    const imagen_id = e.children[2].value;
                    const Delete = async () => {
                        try {
                            const formData = new FormData();
                            formData.append("tarea_id", tarea_id);
                            formData.append("imagen_id", imagen_id);
                            const url = "{{ url('/tareas/eliminar') }}";
                            const opciones = {
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute(
                                            'content'),
                                    'Accept': 'application/json',
                                },
                                method: 'POST',
                                body: formData,
                            };
                            const res = await fetch(url, opciones);
                            const data = await res.json();
                            //console.log(data)
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Imagen eliminada con exito!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            setTimeout(function() {
                                ObtenerImagenes();
                            }, 500);
                        } catch (error) {
                            console.log(error)
                        }
                    }
                    Delete();
                }
            });
        }

        function ObtenerImagenes() {
            var div = document.querySelector('#div-imagenes');
            const getAll = async () => {
                try {
                    const formData = new FormData();
                    formData.append("tarea_id", tarea.value);
                    const url = "{{ url('/tareas/imagenes') }}";
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
                    //console.log(data.message)
                    var registro = data.message;
                    div.innerHTML = "";
                    registro.forEach(imagen => {
                        //console.log(imagen)
                        div.innerHTML += `
                            <div class="border-2 border-solid border-gray-500 text-gray-500 flex gap-2 rounded-xl px-2">
                                <img src="{{ asset('') }}${imagen.url}" alt="" class="w-6 h-6 rounded-full">
                                <button type="button" onclick="VerImagen('${imagen.url}','${imagen.nombre}')" class="truncate">
                                    <p>${imagen.nombre}</p>
                                </button>
                                <form action="{{ url('tareas/eliminar') }}" method="post" onclick="Eliminar(this)">
                                    @csrf
                                    <input class="hidden" name="tarea_id" value="{{ $tarea->id }}">
                                    <input class="hidden" name="imagen_id" value="${imagen.id}">
                                    <button type="button">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        `;
                    });

                } catch (error) {
                    console.log(error)
                }
            }
            getAll()
        }
    </script>
    @if ($tarea->tipo_de_tarea == 'CORRECTIVO')
        @include('tareas.modals.fotos-trabajo')
        @include('tareas.modals.fotos-ot')
        @include('tareas.modals.fotos-boleta')
    @else
        @include('tareas.modals.fotos-preventivo')
        @include('tareas.modals.fotos-planilla')
    @endif
    <button data-modal-target="view-image" data-modal-toggle="view-image" type="button" class="hidden ">

    </button>
    <div id="view-image" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between px-4 pt-4">
                    <h3 class="text-lg font-semibold text-gray-800 truncate w-11/12" id="imagen-name"></h3>
                    <button type="button" onclick="CerrarViewImage()"
                        class="text-gray-400 bg-transparent rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white"
                        data-modal-toggle="view-image">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class="p-4 md:p-5 text-center">
                    <img src="" alt="" id="imagen-url">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
