@extends('dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row mb-4">
                <div class="col-sm-8">
                    <h1>Sistem Informasi Kepatuhan Internal dan Penyuluhan KPPBC TMP C Meulaboh</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <a href="<?= url('sikap/v1/nko2018') ?>">
                        <div class="card text-white bg-primary">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">111,70%</div>
                                    <div>Nilai Kinerja Organisasi 2018</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="<?= url('sikap/v1/nko2019') ?>">
                        <div class="card text-white bg-info">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">111,70%</div>
                                    <div>Nilai Kinerja Organisasi 2019</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart2" height="70"></canvas>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="<?= url('sikap/v1/nko2020') ?>">
                        <div class="card text-white bg-warning">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">111,70%</div>
                                    <div>Nilai Kinerja Organisasi 2020</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart3" height="70"></canvas>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <a href="<?= url('sikap/v1/nko2021') ?>">
                        <div class="card text-white bg-danger">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">111,70%</div>
                                    <div>Nilai Kinerja Organisasi 2021</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart4" height="70"></canvas>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="fade-in">
            <div class="card-columns cols-2">
                <div class="card">
                    <div class="card-header">Nilai Kinerja Organisasi
                        {{-- <div class="card-header-actions"><a class="card-header-action" href="http://www.chartjs.org"
                                target="_blank"><small class="text-muted">docs</small></a></div> --}}
                    </div>
                    <div class="card-body">
                        <div class="c-chart-wrapper">
                            <canvas id="myChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Jenis IKU
                        {{-- <div class="card-header-actions"><a class="card-header-action" href="http://www.chartjs.org"
                                target="_blank"><small class="text-muted">docs</small></a></div> --}}
                    </div>
                    <div class="card-body">
                        <div class="c-chart-wrapper">
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script>
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        var areaChartData = {
            labels: ['2018', '2019', '2020', '2021'],
            datasets: [{
                    label: 'IKU \"CP\"',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [7, 6, 5, 3, 0]
                },
                {
                    label: 'IKU \"N\"',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [8, 8, 9, 12, 0]
                },
            ]
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });

        //-------------
        //- Line Chart -
        //-------------
        var ctx = $('#myChart').get(0).getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["2018", "2019", "2020"],
                datasets: [{
                    label: 'NKO', // Name the series
                    data: [111.7, 114.05, 115.3], // Specify the data values array
                    fill: false,
                    borderColor: '#2196f3', // Add custom color border (Line)
                    backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]
            },
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
            }
        });
    </script>
@endsection
