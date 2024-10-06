@php

    use Carbon\Carbon;
    $fecha = Carbon::parse(Carbon::now());
    $date = $fecha->locale(); //con esto revise que el lenguaje fuera es 

@endphp


<section class="bg-gray-50 p-3 sm:p-5">
    <div class="mx-auto max-w-screen-xl">
        <!-- Start coding here -->
        <div class="bg-white relative border-solid border border-gray-300 rounded-lg sm:rounded-lg overflow-hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="mx-auto mb-5 p-5">
                    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between items-start w-full">
                            <div class="flex-col items-center">
                                <div class="flex items-center mb-1">
                                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">
                                        Remedys realizados en {{ $fecha->monthName }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Line Chart -->
                        <div class="py-6" id="pie-chart"></div>
                    </div>
                </div>

                <div class="mx-auto mb-5 p-5">
                    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <div class="flex justify-between items-start w-full">
                            <div class="flex-col items-center">
                                <div class="flex items-center mb-1">
                                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Nivel
                                        de emergencia en {{ $fecha->monthName }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Line Chart -->
                        <div class="py-6" id="pie-chart2"></div>
                    </div>
                </div>

                <div class="mx-auto mb-5 p-5">
                    <p class="mb-5">Remedys realizados por sucursal en {{ $fecha->monthName }}: <strong id="trabajos_sucursal">0</strong></p>
                    <form class="max-w-sm mx-auto mb-80">
                        <label for="tipo_de_sucursal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Elija una sucursal</label>
                        <select id="tipo_de_sucursal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Ninguna seleccion</option>
                            @foreach ($sucursales as $sucursal)
                                <option value="{{$sucursal->id}}">{{ $sucursal->numero . " " .$sucursal->sucursal}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="mx-auto mb-5 p-5">
                    <p class="mb-5">Materiales gastados por mes en {{ $fecha->monthName }}: <strong id="trabajos_material">0</strong></p>
                    <form class="max-w-sm mx-auto mb-80">
                        <label for="tipo_de_material"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Elija un material</label>
                        <select id="tipo_de_material"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Ninguna seleccion</option>
                            @foreach ($materiales as $material)
                                <option value="{{$material->id}}">{{ $material->descripcion }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    const trabajos_sucursal = document.querySelector("#trabajos_sucursal");
    const trabajos_material = document.querySelector("#trabajos_material");
    const all_tareas = @json($all_tareas);
    const materials_gast = @json($materialesGastados);
    jQuery("#tipo_de_sucursal").chosen();
    $("#tipo_de_sucursal").chosen().change( function (event){
        var sucursal_id = event.target.value;
        var total = 0;
        all_tareas.forEach(tarea => {
            if(tarea.sucursal_id == sucursal_id)
                total++
        });
        trabajos_sucursal.innerHTML = total;
    } )

    jQuery("#tipo_de_material").chosen();
    $("#tipo_de_material").chosen().change( function (event){
        var material_id = event.target.value;
        var total = 0;
        //console.log(materials_gast)
        materials_gast.forEach(material => {
            if(material.material_id == material_id){
                total += parseInt(material.cantidad, 10);
                //console.log(total + " con el material id nro: " + material.material_id)
            }
        });
        trabajos_material.innerHTML = total;
    } )
    


    const total_correctivos = parseInt("<?php echo $total_correctivos; ?>", 10);
    const total_atm = parseInt("<?php echo $total_atm; ?>", 10);
    //console.log(total_correctivos + " " + total_atm)
    const getChartOptions = () => {
        return {
            series: [total_correctivos, total_atm],
            colors: ["#b048a3", "#6169c9"],
            chart: {
                height: 420,
                width: "100%",
                type: "pie",
            },
            stroke: {
                colors: ["black"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    labels: {
                        show: true,
                    },
                    size: "100%",
                    dataLabels: {
                        offset: -25
                    }
                },
            },
            labels: ["Sucursales", "ATM"],
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            legend: {
                position: "top",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }

    if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
        chart.render();
    }
    const total_altas = parseInt("<?php echo $total_altas; ?>", 10);
    const total_medias = parseInt("<?php echo $total_medias; ?>", 10);
    const total_bajas = parseInt("<?php echo $total_bajas; ?>", 10);
    //console.log(total_altas + " " + total_medias + " " + total_bajas)
    const getChartOptions2 = () => {
        return {
            series: [total_altas, total_medias, total_bajas],
            colors: ["#E41010", "#de8240", "#00B6FF"],
            chart: {
                height: 420,
                width: "100%",
                type: "pie",
            },
            stroke: {
                colors: ["black"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    labels: {
                        show: true,
                    },
                    size: "100%",
                    dataLabels: {
                        offset: -25
                    }
                },
            },
            labels: ["Alta", "Media", "Baja"],
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            legend: {
                position: "top",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function(value) {
                        return value
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        }
    }

    if (document.getElementById("pie-chart2") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart2"), getChartOptions2());
        chart.render();
    }
</script>
