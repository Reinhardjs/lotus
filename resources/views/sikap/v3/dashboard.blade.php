@extends('dashboard.base')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-sm-10">
            <h1>Intelijen</h1>
        </div>
        <div class="col-sm-2">
            <a href="<?= Request::url() ?>/nko2021">
                <button class="btn btn-primary">
                    Tambah Data
                </button>
            </a>
        </div>
    </div>
    <div class="fade-in">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Indikator Kerja Utama
                        <div class="card-header-actions"><a class="card-header-action" href="http://www.chartjs.org" target="_blank"><small class="text-muted">docs</small></a></div>
                    </div>
                    <div class="card-body">
                        <div id="myDIV" class="mb-3">
                            <button class="btn-chart active-btn-chart" onClick="changeData(0)">1a-N</button>
                            <button class="btn-chart" onClick="changeData(1)">2a-CP</button>
                            <button class="btn-chart" onClick="changeData(2)">3a-CP</button>
                            <button class="btn-chart" onClick="changeData(3)">4a-N</button>
                            <button class="btn-chart" onClick="changeData(4)">5a-N</button>
                            <button class="btn-chart" onClick="changeData(5)">6a-N</button>
                            <button class="btn-chart" onClick="changeData(6)">6b-N</button>
                            <button class="btn-chart" onClick="changeData(7)">7a-N</button>
                            <button class="btn-chart" onClick="changeData(8)">8a-N</button>
                            <button class="btn-chart" onClick="changeData(9)">8b-N</button>
                            <button class="btn-chart" onClick="changeData(10)">9a-N</button>
                            <button class="btn-chart" onClick="changeData(11)">9b-N</button>
                            <button class="btn-chart" onClick="changeData(12)">9c-N</button>
                            <button class="btn-chart" onClick="changeData(13)">10a-N</button>
                            <button class="btn-chart" onClick="changeData(14)">11a-CP</button>
                        </div>
                        <div class="c-chart-wrapper">
                            <canvas id="barChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<style>
    /* Style the buttons */
    .btn-chart {
        border: none;
        outline: none;
        padding: 10px 16px;
        background-color: #f1f1f1;
        cursor: pointer;
        font-size: 18px;
    }

    /* Style the active class, and buttons on mouse-over */
    .active-btn-chart,
    .btn-chart:hover {
        background-color: #1a73e8;
        color: white;
    }
</style>
@endsection

@section('javascript')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/main.js') }}" defer></script>
<script>
    var data_grafik = <?= json_encode($data_grafik) ?>;
    var areaChartData = new Array();

    data_grafik.forEach(function(item) {
        areaChartData.push({
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                    label: '2018',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: item["nko2018"]
                },
                {
                    label: '2019',
                    backgroundColor: 'rgba(40,167,69, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: item["nko2019"]
                },
                {
                    label: '2020',
                    backgroundColor: 'rgba(255,193,7,1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: item["nko2020"]
                },
                {
                    label: '2021',
                    backgroundColor: 'rgba(220,53,69,1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: item["nko2021"]
                },
            ]
        });
    });

    //-------------
    //- BAR CHART -
    //-------------
    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData[0]);

    var barChart;
    barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });

    function changeData(index) {
        if (barChart !== undefined) {
            barChart.clear();
            barChart.destroy();
        }

        var barChartData = $.extend(true, {}, areaChartData[index]);

        barChart = new Chart(document.getElementById("barChart"), {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });

        barChart.update();
    }

    /* add active class on click */
    // Add active class to the current button (highlight it)
    var header = document.getElementById("myDIV");
    var btns = header.getElementsByClassName("btn-chart");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active-btn-chart");
            current[0].className = current[0].className.replace(" active-btn-chart", "");
            this.className += " active-btn-chart";
        });
    }
</script>
@endsection