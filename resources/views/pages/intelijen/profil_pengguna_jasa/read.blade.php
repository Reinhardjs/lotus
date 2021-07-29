@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row mb-4">
            <div class="col-sm-10">
                <h1>Intelijen</h1>
            </div>
            <div class="col-sm-2">
                <a href="<?= Request::url() ?>/create">
                    <button class="btn btn-primary">
                        Tambah Data
                    </button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Profil Pengguna Jasa</div>
                    <div class="card-body">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Nama Importir</th>
                                    <th>Alamat</th>
                                    <th>Penanggung Jawab Perusahaan</th>
                                    <th>Riwayat Pemberitahuan Pabean</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row) : ?>
                                    <tr>
                                        <td><?= $row->nama_importir ?></td>
                                        <td><?= $row->alamat ?></td>
                                        <td><?= $row->penanggungjawab_perusahaan ?></td>
                                        <td><?= $row->riwayat_pemberitahuan_pabean ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="<?= Request::url() ?>/<?= $row->id ?>/update">
                                                        <button class="btn btn-warning" style="color: white">
                                                            Ubah
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a href="<?= Request::url() ?>/<?= $row->id ?>/delete">
                                                        <button class="btn btn-danger">
                                                            Hapus
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Importir</th>
                                    <th>Alamat</th>
                                    <th>Penanggung Jawab Perusahaan</th>
                                    <th>Riwayat Pemberitahuan Pabean</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
@endsection

@section('javascript')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var thArray = $('#myTable tfoot th');
        for (let i = 0; i < thArray.length - 1; i++) {
            var obj = thArray[i];
            var title = $(obj).text();
            $(obj).html('<input type="text" placeholder="Search..." />');
        }

        $('#myTable').DataTable({
            initComplete: function() {
                // Apply the search
                this.api().columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change clear', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });
                });
            }
        });
    });
</script>

@endsection