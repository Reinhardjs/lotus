@extends('dashboard.base')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3> Update </h3>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form id="form" action="process_update" method="POST">
                                    <input type="hidden" name="table_name" value="<?= $table_name ?>" />
                                    <input type="hidden" name="id" value="<?= $row->id ?>" />

                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label for="nama_importir">Nama Importir</label>
                                                <input type="text" id="nama_importir" name="nama_importir" class="form-control" value="<?= $row->nama_importir ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" id="alamat" name="alamat" class="form-control" value="<?= $row->alamat ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="penanggungjawab_perusahaan">Penanggung Jawab Perusahaan</label>
                                                <input type="text" id="penanggungjawab_perusahaan" name="penanggungjawab_perusahaan" class="form-control" value="<?= $row->penanggungjawab_perusahaan ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="riwayat_pemberitahuan_pabean">Riwayat Pemberitahuan Pabean</label>
                                                <input type="text" id="riwayat_pemberitahuan_pabean" name="riwayat_pemberitahuan_pabean" class="form-control" value="<?= $row->riwayat_pemberitahuan_pabean ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
                            <input type="submit" value="Submit" class="btn btn-success float-right">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- /.content-wrapper -->
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/summernote-bs4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
<style>
    .form-control {
        color: #000
    }
</style>
@endsection

@section('javascript')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/tnow3o3blitquq67bvgt5yejcbl3ctjb1sgwmmhox043m8xt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 5000
    });

    $('form[id=form').submit(function(e) {
        e.preventDefault();

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text
        $('.alert-success').remove();

        var formUrl = "<?= url("/crud/process_update") ?>";
        var data = new FormData(this);
        data.append("_token", "{{ csrf_token() }}");

        // process the form
        $.ajax({
                type: 'POST',
                url: formUrl,
                data: data, //penggunaan FormData
                dataType: 'json', // what type of data do we expect back from the serverss
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                error: function(data) {
                    alert("AJAX ERROR")
                    alert(JSON.stringify(data));
                }
            })

            // using the done promise callback
            .done(function(data) {

                // here we will handle errors and validation messages
                if (!data.success) {

                    Toast.fire({
                        type: 'error',
                        title: data.message
                    });

                } else {

                    // ALL GOOD! just show the success message!
                    Toast.fire({
                        type: 'success',
                        title: data.message
                    });

                    setTimeout(function() {
                        window.location.href =
                            "<?= str_replace("/{$row->id}/update", "", Request::url()) ?>"; //will redirect to any page
                    }, 2500); //will call the function after 2.5 secs.

                }
            });
    });
</script>
@endsection