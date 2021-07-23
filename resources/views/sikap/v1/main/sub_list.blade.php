@extends('dashboard.base')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4 ml-5">
                    <div class="col-sm-6">
                        <h1><?= $rows[0]->judul ?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="float-sm-right">
                            <a href="<?= url('/sikap/v1/' . "$main/create") ?>" type="button" class="btn btn-primary"> Tambah <i
                                    class="fas fa-plus"></i></a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <?php  foreach ($rows as $row): ?>

                    <?php
                    $target = explode('#', $row->target)[3]; // [3] -> Q4
                    $realisasi = explode('#', $row->realisasi)[3]; // [3] -> Q4
                    $capaian = explode('#', $row->capaian)[3]; // [3] -> Q4
                    $colors = ['#3c8dbc', '#f56954', '#0fa65a', '#f39c12', '#00c0f0'];
                    $random_color = $colors[array_rand($colors, 1)];
                    ?>

                    <div class="col-6 col-md-3 mb-4 text-center">
                        <div class="knob-label"><b><a
                                    href='<?= url('/' . $row->main . '/' . $row->sub) ?>'><?= $row->nama_iku ?></b></a>
                        </div>
                        <input type="text" class="knob" value="<?= $capaian ?>" data-min="0" data-max="120" data-width="90"
                            data-height="90" data-fgColor="<?= $random_color ?>" readonly>

                        <div class="knob-label">Target : <?= $target ?>%</div>
                        <div class="knob-label">Realisasi : <?= $realisasi ?>%</div>
                    </div>
                    <!-- ./col -->

                    <?php endforeach; ?>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('javascript')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/jquery.knob.min.js') }}"></script>
    <script>
        $(function() {
            $('.knob').knob({
                /*change : function (value) {
                 //console.log("change : " + value);
                 },
                 release : function (value) {
                 console.log("release : " + value);
                 },
                 cancel : function () {
                 console.log("cancel : " + this.value);
                 },*/
                draw: function() {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        var a = this.angle(this.cv) // Angle
                            ,
                            sa = this.startAngle // Previous start angle
                            ,
                            sat = this.startAngle // Start angle
                            ,
                            ea // Previous end angle
                            ,
                            eat = sat + a // End angle
                            ,
                            r = true

                        this.g.lineWidth = this.lineWidth

                        this.o.cursor &&
                            (sat = eat - 0.3) &&
                            (eat = eat + 0.3)

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value)
                            this.o.cursor &&
                                (sa = ea - 0.3) &&
                                (ea = ea + 0.3)
                            this.g.beginPath()
                            this.g.strokeStyle = this.previousColor
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                            this.g.stroke()
                        }

                        this.g.beginPath()
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                        this.g.stroke()

                        this.g.lineWidth = 2
                        this.g.beginPath()
                        this.g.strokeStyle = this.o.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth *
                            2 / 3, 0,
                            2 * Math.PI, false)
                        this.g.stroke()

                        return false
                    }
                }
            })
            /* END JQUERY KNOB */
        });
    </script>
@endsection
