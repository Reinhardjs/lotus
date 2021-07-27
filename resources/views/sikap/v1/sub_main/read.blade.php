@extends('dashboard.base')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h3 class="col"><?= $row->judul ?></h3>
                        <div class="col">
                            <a href="<?= url("/sikap/v1/{$row->main}/{$row->sub}/update") ?>" class="btn btn-primary" style="float: right">
                                Ubah
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="callout callout-info">
                                    <h5><?= $row->nama_iku ?></h5>
                                    <?= $row->detail_iku ?>
                                </div>

                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <h4>
                                            Isu Utama/Implikasi
                                        </h4>
                                    </div>
                                    <!-- info row -->
                                    <div class="row mb-3">
                                        <?= $row->isi_sub_judul ?>
                                    </div>
                                    <!-- /.row -->

                                    <?php if (isset($tabel_list)) : ?>
                                        <?php foreach ($tabel_list as $item) : ?>
                                            <!-- Table row -->
                                            <div class="row">
                                                <h4><?= $item['judul_tabel'] ?></h4>
                                            </div>
                                            <div class="row mt-3 mb-3">
                                                <div class="col-5 table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>T/R/C</th>
                                                                <th>Q1</th>
                                                                <th>Q2</th>
                                                                <th>Q3</th>
                                                                <th>Q4</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Target</td>
                                                                <td><?= $item['target']['Q1'] ?>%</td>
                                                                <td><?= $item['target']['Q2'] ?>%</td>
                                                                <td><?= $item['target']['Q3'] ?>%</td>
                                                                <td><?= $item['target']['Q4'] ?>%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Realisasi</td>
                                                                <td><?= $item['realisasi']['Q1'] ?>%</td>
                                                                <td><?= $item['realisasi']['Q2'] ?>%</td>
                                                                <td><?= $item['realisasi']['Q3'] ?>%</td>
                                                                <td><?= $item['realisasi']['Q4'] ?>%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Capaian</td>
                                                                <td><?= $item['capaian']['Q1'] ?>%</td>
                                                                <td><?= $item['capaian']['Q2'] ?>%</td>
                                                                <td><?= $item['capaian']['Q3'] ?>%</td>
                                                                <td><?= $item['capaian']['Q4'] ?>%</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
@endsection

@section('javascript')
@endsection