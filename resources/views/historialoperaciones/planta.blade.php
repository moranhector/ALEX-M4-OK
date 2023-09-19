@extends('layouts.app')





<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>






<style>
    <style>.small-box {
        text-align: center;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 10px;
        color: #fff;
    }

    .small-box h3 {
        font-size: 28px;
        margin-top: 0;
    }

    .small-box p {
        font-size: 14px;
    }

    /* Colores */
    .bg-planta {
        background-color: #ff6b6b;
        /* Rojo anaranjado */
    }

    .bg-jubilaciones {
        background-color: #72d572;
        /* Verde claro */
    }

    .bg-ausentismo {
        background-color: #f9cb42;
        /* Amarillo */
    }

    .bg-altas {
        background-color: #5499c7;
        /* Azul claro */
    }

    html,
    body,
    #containerb {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #div_generoxv {
        width: 50%;
        height: 50%;
        margin: 0;
        padding: 0;
    }

    #div_uor {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 320px;
        max-width: 700px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>




@section('content')

<!-- Main content -->




<section class="content container-fluid">


<div class="col-md-8" style="margin-top: 5px; margin-bottom: 5px; padding: 60px;">
        <div class="panel panel-default" style="margin-top: 5px; margin-bottom: 5px ">
            <div class="panel-heading"><b>Altas por mes</b>
            </div>
            <div class="panel-body">
                <canvas id="canvasaltasbajas" height="580" width="1200"></canvas>
            </div>
        </div>
    </div>



    <!-- @include('flash::message') -->







    <figure class="highcharts-figure">
        <div id="container"></div>

    </figure>












    <div id="div_generoxv"></div>










    <div class="card card-widget widget-user" style="padding: 20px; margin: 20px;">

        <div class="card-header">
            <h1 class="card-title"><b>Distribución por Género</b></h1>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <div class="col-md-6"> <!-- Cambiado a col-md-6 para cubrir la mitad de la pantalla -->
                <div class="panel panel-default" style="box-shadow: 6px 20px 10px black; margin-top: 5px; margin-bottom: 5px; padding: 20px;">
                    <div class="panel-body">
                        <!-- Ajusta las dimensiones del canvas -->
                        <canvas id="canvas_genero" height="300" width="450"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <!-- <canvas id="bubbleChart" width="300" height="300"></canvas>



 -->








</section>










<script>
    var url = "{{url('http://localhost:3000/altasbajas/202301/202306')}}";
 

    var etiquetas = [];
    var altas = [];
    var bajas = [];


 
    var cantidades = [];
 

    $(document).ready(function() {

        console.log('entra a canvasaltasbajas');
        $.get(url, function(response) {

            const rowsData = response.rows; // Accede al array de objetos

            rowsData.forEach(function(row) {
                console.log('data:', row);
                etiquetas.push(row.PERIODO); // Cambio en la etiqueta
                altas.push(row.ALEX_ALTAS);
                bajas.push(row.ALEX_BAJAS);
                // cantidades.push(row.ALEX_ALTAS); // Cambio en la cantidad
            });



            var ctx = document.getElementById("canvasaltasbajas").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                // data: {
                //     labels: etiquetas,
                //     datasets: [{
                //         label: 'Altas (ALEX_ALTAS)',
                //         data: cantidades,
                //         backgroundColor: '#33ECFF',
                //         hoverBackgroundColor: '#3196C5',
                //         borderColor: '#000000',
                //         borderWidth: 2
                //     }]
                // },

                data: {
                    labels: etiquetas,
                    datasets: [{
                        label: 'Altas (ALEX_ALTAS)',
                        data: altas,
                        backgroundColor: '#33ECFF',
                        hoverBackgroundColor: '#3196C5',
                        borderColor: '#000000',
                        borderWidth: 2
                    }, {
                        label: 'Bajas (ALEX_BAJAS)',
                        data: bajas,
                        backgroundColor: '#FF5733',
                        hoverBackgroundColor: '#C53126',
                        borderColor: '#000000',
                        borderWidth: 2
                    }]
                },



                options: {
                    title: {
                        display: true,
                        text: 'Altas por Periodo'
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    });
</script>








<!-- GENERO
 ██████╗ ███████╗███╗   ██╗███████╗██████╗  ██████╗ 
██╔════╝ ██╔════╝████╗  ██║██╔════╝██╔══██╗██╔═══██╗
██║  ███╗█████╗  ██╔██╗ ██║█████╗  ██████╔╝██║   ██║
██║   ██║██╔══╝  ██║╚██╗██║██╔══╝  ██╔══██╗██║   ██║
╚██████╔╝███████╗██║ ╚████║███████╗██║  ██║╚██████╔╝
 ╚═════╝ ╚══════╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝ ╚═════╝ 
                                                     -->




<script>
    var url3 = "{{ url('genero') }}";
    var Etiquetas3 = new Array();
    var Cantidades3 = new Array();



    $(document).ready(function() {
        $.get(url3, function(response) {
            response.forEach(function(data) {
                Etiquetas3.push(data.genero);
                Cantidades3.push(data.cantidad);
                console.log(Cantidades3);
            });
            var ctx3 = document.getElementById("canvas_genero").getContext('2d');
            var myChart = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: Etiquetas3,
                    datasets: [{
                        label: Etiquetas3,

                        data: Cantidades3,
                        borderWidth: 1,
                        backgroundColor: [
                            '#FF1493', // Rosa
                            '#00BFFF', // Celeste
                            '#808080' // Gris
                        ],
                        borderColor: [
                            'rgba(205, 71, 43, 1)', // Borde rosa
                            'rgba(255, 206, 86, 1)', // Borde celeste
                            'rgba(75, 192, 192, 1)' // Borde gris
                        ]
                    }]

                },

                options: {
                    title: {
                        display: true,
                        text: 'Genero'
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 20
                        }
                    }
                }
            });
        });
    });
</script>

<!-- UOR
██╗   ██╗███╗   ██╗██╗██████╗  █████╗ ██████╗      ██████╗ ██████╗  ██████╗ 
██║   ██║████╗  ██║██║██╔══██╗██╔══██╗██╔══██╗    ██╔═══██╗██╔══██╗██╔════╝ 
██║   ██║██╔██╗ ██║██║██║  ██║███████║██║  ██║    ██║   ██║██████╔╝██║  ███╗
██║   ██║██║╚██╗██║██║██║  ██║██╔══██║██║  ██║    ██║   ██║██╔══██╗██║   ██║
╚██████╔╝██║ ╚████║██║██████╔╝██║  ██║██████╔╝    ╚██████╔╝██║  ██║╚██████╔╝
 ╚═════╝ ╚═╝  ╚═══╝╚═╝╚═════╝ ╚═╝  ╚═╝╚═════╝      ╚═════╝ ╚═╝  ╚═╝ ╚═════╝ 
                                                                             -->








<!-- FIN UOR -->
<!-- FIN UOR -->
<!-- FIN UOR -->






<!-- GENERO
 ██████╗ ███████╗███╗   ██╗███████╗██████╗  ██████╗ 
██╔════╝ ██╔════╝████╗  ██║██╔════╝██╔══██╗██╔═══██╗
██║  ███╗█████╗  ██╔██╗ ██║█████╗  ██████╔╝██║   ██║
██║   ██║██╔══╝  ██║╚██╗██║██╔══╝  ██╔══██╗██║   ██║      22222
╚██████╔╝███████╗██║ ╚████║███████╗██║  ██║╚██████╔╝
 ╚═════╝ ╚══════╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═╝ ╚═════╝ 
                                                     -->



// Define una función para cargar y mostrar el nuevo gráfico

<script>
    function showAnotherChart(selectedUOR) {
        // Realiza una llamada a la API con el UOR seleccionado
        //console.log('showAnotherChart ', 'http://localhost:8000/uor-explode/' + selectedUOR);
        fetch('http://localhost:8000/uor-explode/' + selectedUOR) // Reemplaza 'uor' con la URL correcta de tu API Laravel
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el nuevo gráfico
                var newData = jsonData.map((item, index) => ({
                    name: item.uor,
                    value: item.cantidad,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));


                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#00FF00', '#FFD700'];
                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el nuevo gráfico TreeMap
                Highcharts.chart('container', {
                    colorAxis: {
                        minColor: '#FFFFFF',
                        maxColor: Highcharts.getOptions().colors[0]
                    },
                    series: [{
                        type: 'treemap',
                        layoutAlgorithm: 'squarified',
                        clip: false,
                        data: newData,
                        title: {
                            text: 'Planta Total distribuída por UOR: ' + selectedUOR
                        }
                    }],
                    title: {
                        text: 'Planta distribuída por UOR:' + selectedUOR
                    }
                });






            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Obtener los datos desde la API REST en Laravel
        fetch('http://localhost:8000/uor')
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el gráfico
                var data = jsonData.map((item, index) => ({
                    name: item.uor,
                    value: item.cantidad,
                    colorValue: index, // Usamos el índice como valor de color
                    color: getColorForIndex(index) // Obtener color basado en el índice
                }));

                // Función para obtener colores basados en el índice
                function getColorForIndex(index) {
                    var colors = ['#008B8B', '#8A2BE2', '#FF1493', '#00BFFF', '#808080', '#00FF00', '#FFD700'];
                    return colors[index % colors.length]; // Cicla a través de los colores
                }

                // Crear el gráfico TreeMap
                Highcharts.chart('container', {
                    colorAxis: {
                        minColor: '#FFFFFF',
                        maxColor: Highcharts.getOptions().colors[0]
                    },
                    series: [{
                        type: 'treemap',
                        layoutAlgorithm: 'squarified',
                        clip: false,
                        data: data,
                        events: {
                            click: function(event) {
                                // Obtener el UOR seleccionado
                                var selectedUOR = event.point.name;

                                //alert('Clic en el sector: ' +  selectedUOR );                            

                                // Llamar a la función para mostrar el nuevo gráfico
                                showAnotherChart(selectedUOR);
                            }
                        }
                    }],
                    title: {
                        text: 'Planta Total distribuída por UOR:'
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    });
</script>


<script>
    anychart.onDocumentReady(function() {
        // create pie chart
        var chart = anychart.pie();

        // set chart title
        chart.title('Distribución por Género');

        // Obtener los datos desde la API REST en Laravel
        fetch('http://localhost:8000/generoxv') // Reemplaza 'generoxv' con la URL correcta de tu API Laravel
            .then(response => response.json())
            .then(jsonData => {
                // Convertir los datos para usarlos en el chart
                var chartData = jsonData.map(item => ({
                    x: item.x,
                    value: item.value
                }));

                // set chart data
                chart.data(chartData);

                // Asignar colores personalizados a los sectores
                chart.palette(['#FF1493', '#00BFFF', '#808080']); // Rosa, Azul, Gris

                // Agregar un evento de clic a los sectores
                chart.listen('pointClick', function(e) {
                    var point = e.point;
                    alert('Clic en el sector: ' + point.x + ', Valor: ' + point.value);
                });


                // set container id for the chart
                chart.container('div_generoxv');

                // initiate chart drawing
                chart.draw();
            })
            .catch(error => console.error('Error al obtener los datos desde la API:', error));
    });
</script>




@endsection