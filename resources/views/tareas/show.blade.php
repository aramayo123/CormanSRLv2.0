<?php
    use App\Models\TareaAsignada;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver tarea') }}
            <button id="theme-toggle" type="button"
                class="text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 rounded-lg text-sm px-1">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </button>
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
                    @if ($message = Session::get('exito'))
                        <x-exito>
                            <x-slot:message>
                                {{ $message }}
                            </x-slot:message>
                        </x-exito>
                    @endif
                    @if ($message = Session::get('error'))
                        <x-error>
                            <x-slot:message>
                                {{ $message }}
                            </x-slot:message>
                        </x-error>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
                                    <p class="inline-block mb-2 text-md font-medium text-gray-900 ">Fecha de cierre :
                                        <strong>{{ $tarea->fecha_cerrado }}</strong>
                                    </p>
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
                            @endif
                        </div>
                        <div class="">
                            @if (count($imagenes))
                                <div class="rounded-xl outline outline-offset-0 outline-1 outline-gray-800 p-5 grid grid-cols-2 sm:grid-cols-3 gap-4 max-h-[150px] overflow-auto"
                                    id="div-imagenes">

                                </div>
                            @endif
                            <div
                                class="mt-4 rounded-xl outline outline-offset-0 outline-1 outline-gray-800 p-5 grid grid-row gap-5">
                                <div>
                                    <p>Certificado : <strong>{{ $tarea->Certificado() }}</strong></p>
                                    <hr class="my-2">
                                </div>
                                <div>
                                    <p>Creado por : <strong>{{ $tarea->Autor->username }}</strong></p>
                                    <hr class="my-2">
                                </div>
                                <div>
                                    <p>Fecha del mail : <strong>{{ $tarea->fecha_mail }}</strong></p>
                                    <hr class="my-2">
                                </div>
                            </div>
                        </div>
                        <div
                            class="rounded-xl outline outline-offset-0 outline-1 outline-gray-800 p-5 col-span-1 sm:col-span-2">
                            <div class="mb-5 grid w-full sm:w-2/3 mx-auto ">
                                <p class="block my-2 text-md font-medium text-gray-900">Descripcion del pedido: </p>
                                <textarea id="descripcion" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"> {{ $tarea->descripcion }} </textarea>
                            </div>

                            <div class="mb-5 grid w-full sm:w-2/3 mx-auto ">
                                <p class="block my-2 text-md font-medium text-gray-900">Elementos afectados: </p>
                                <textarea id="elementos" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"> {{ $tarea->elementos }} </textarea>
                            </div>

                            <div class="mb-5 grid w-full sm:w-2/3 mx-auto ">
                                <p class="block my-2 text-md font-medium text-gray-900">Diagnostico de la situacion :
                                </p>
                                <textarea id="diagnostico" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"> {{ $tarea->diagnostico }} </textarea>
                            </div>

                            <div class="mb-5 grid w-full sm:w-2/3 mx-auto ">
                                <p class="block my-2 text-md font-medium text-gray-900">Acciones ejecutadas : </p>
                                <textarea id="acciones" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"> {{ $tarea->acciones }} </textarea>
                            </div>

                            <div class="mb-5 grid w-full sm:w-2/3 mx-auto ">
                                <p class="block my-2 text-md font-medium text-gray-900">Observaciones : </p>
                                <textarea id="observaciones" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"> {{ $tarea->observaciones }} </textarea>
                            </div>
                            <div class="mb-5 grid w-full sm:w-2/3 mx-auto ">
                                <p>Personal asignado :</p>
                                <?php $personal_asignado = 0; ?>
                                @foreach ($users as $user)
                                    @if (!$user->hasRole('Corman') && !$user->hasRole('Facilitie'))
                                        @if (count(TareaAsignada::where('tarea_id', '=', $tarea->id)->where('user_id', '=', $user->id)->get()))
                                            <?php $personal_asignado++; ?>
                                            <div class="flex items-center ps-4 border border-gray-400 rounded">
                                                <input {{ count(TareaAsignada::where('tarea_id', '=', $tarea->id)->where('user_id', '=', $user->id)->get()) ? "checked":"" }} disabled id="{{ $user->username }}" type="checkbox" value="1" name="{{ $user->username }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 ">
                                                <label for="{{ $user->username }}" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 ">{{ $user->username }}</label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach    
                                @if (!$personal_asignado)
                                    <p>Sin personal asignado </p>
                                @endif
                            </div>
                            <div id="table_material" class="mb-5 mx-auto text-center w-full sm:w-2/3">
                            </div>
                            <div class="mx-auto text-center">
                                <form action="{{ url('/download') }}" method="post" id="form-ticket">
                                    @csrf
                                    @if (!$tarea->atm)
                                        <input type="hidden" name="folder" value="OTS/{{ $tarea->ticket }}">
                                    @else
                                        <input type="hidden" name="folder" value="ATM/{{ $tarea->ticket }}">
                                    @endif
                                    <input type="hidden" name="id" value="{{ $tarea->id }}">
                                    <input type="hidden" name="remedit" value="{{ $tarea->ticket }}">
                                    <button type="submit"
                                        class="py-2.5 px-5 me-2 mb-2 text-sm font-medium focus:outline-none rounded-lg border focus:z-10 focus:ring-4 focus:ring-orange-700 bg-orange-400 text-white border-gray-600 hover:text-white hover:bg-orange-500">
                                        DESCARGAR CARPETA
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="tarea_id" name="tarea_id" value="{{ $tarea->id }}" />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ObtenerImagenes()
            ObtenerMateriales()
        });
        var tarea = document.querySelector("#tarea_id");

        function ObtenerImagenes() {
            var div = document.querySelector('#div-imagenes');
            if(!div)
                return
            div.innerHTML = "";
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
                    registro.forEach(imagen => {
                        //console.log(imagen)
                        div.innerHTML += `
                            <div class="border-2 border-solid border-gray-500 text-gray-500 flex justify-between gap-2 rounded-xl px-2">
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
        document.querySelector('#form-ticket').addEventListener('submit', handleSubmit);
        function handleSubmit(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            fetch(e.target.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'CSRF-Token': data['_token'],
                    },
                    credentials: 'include',
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(({
                    success,
                    url
                }) => {
                    //displayData(success);
                    if (success === 'ERROR') {
                        Swal.fire({
                            title: `<p class="font-bold text-gray-500">ADVERTENCIA`,
                            html: `
                <p class="font-bold text-xl text-gray-500">${url}</p>
              `,
                            icon: "warning",
                            showClass: {
                                popup: `
                  animate__animated
                  animate__fadeInUp
                  animate__faster
                `
                            },
                            hideClass: {
                                popup: `
                  animate__animated
                  animate__fadeOutDown
                  animate__faster
                `
                            },
                            confirmButtonColor: "#3085d6",
                        });
                        return
                    }
                    const a = document.createElement('a');
                    a.href = url;
                    a.download;
                    a.target = '_blank';
                    a.click();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

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
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">${ material.nombre_material}</th>
                            <td class="px-1 py-1">$${ material.precio}</td>
                            <td class="px-1 py-1">${ material.cantidad}</td>
                        </tr>
                        `;
                    });

                    var principal = `
                        <div class="overflow-x-auto bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
                            <table class="w-full text-sm text-left text-gray-500 ">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Material</th>
                                        <th scope="col" class="px-1 py-1">Precio</th>
                                        <th scope="col" class="px-1 py-1">Cantidad</th>
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
    </script>
    <button data-modal-target="view-image" data-modal-toggle="view-image" type="button" class="hidden ">

    </button>
    <div id="view-image" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow ">
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
