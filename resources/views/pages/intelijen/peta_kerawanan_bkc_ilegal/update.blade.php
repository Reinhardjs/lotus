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
                                                <label for="deskripsi">Deskripsi</label>
                                                <input type="text" id="deskripsi" name="deskripsi" class="form-control" value="<?= $row->deskripsi ?>">
                                            </div>

                                            <div class="form-group">
                                                <img id="preview" style="max-width: 100%" src="<?= $row->img_url ?>" />
                                                <label for="alamat">Lampiran Gambar</label>
                                                <input type="file" id="img_url" name="img_url" class="form-control" value="<?= $row->img_url ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="koordinat">Koordinat</label>
                                                <input type="text" id="koordinat" name="koordinat" class="form-control" value="<?= $row->koordinat ?>" disabled>
                                            </div>

                                            <div id="googleMap" style="width:100%;height:500px;"></div>

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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASyYRBZmULmrmw_P9kgr7_266OhFNinPA"></script>
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
    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img_url").change(function() {
        filePreview(this);
    });
</script>
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

        $("#koordinat").prop('disabled', false);

        var formUrl = "<?= url("/crud/process_update") ?>";
        var data = new FormData(this);
        data.append("_token", "{{ csrf_token() }}");

        $("#koordinat").prop('disabled', true);

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

<script>
    // variabel global marker
    var marker;

    function taruhMarker(peta, posisiTitik) {
        if (marker) {
            // pindahkan marker
            marker.setPosition(posisiTitik);
        } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta
            });
        }
    }

    function initialize() {
        var lat = <?= explode(",", $row->koordinat)[0] ?>;
        var lng = <?= explode(",", $row->koordinat)[1] ?>;

        var propertiPeta = {
            center: new google.maps.LatLng(lat, lng),
            zoom: 9,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        var location = {
            lat: lat,
            lng: lng,
        };

        var infoWindow = new google.maps.InfoWindow({
            content: "Marker",
        });

        marker = new google.maps.Marker({
            position: location,
            map: peta,
            title: "Mark",
            contentString: "Mark"
        });

        marker.addListener('click', function() {
            infoWindow.open(map, marker);
        });

        // even listner ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
            var lat = event.latLng.toJSON().lat;
            var lng = event.latLng.toJSON().lng;
            $("#koordinat").val(lat + "," + lng)
        });

    }

    // event jendela di-load
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection