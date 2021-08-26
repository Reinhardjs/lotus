@extends('dashboard.base')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3> Create </h3>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <form id="form" action="process_create" method="POST">
                  <input type="hidden" name="main" value="<?= $main ?>" />

                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="nama_iku">Nama IKU</label>
                        <input type="text" id="nama_iku" name="nama_iku" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="detail_iku">Detail IKU</label>
                        <input type="text" id="detail_iku" name="detail_iku" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="link_iku">Link IKU</label>
                        <input type="text" id="link_iku" name="sub" class="form-control">
                      </div>

                      <div class="form-group">
                        <label for="isi_sub_judul">Isi Sub Judul</label>
                        <input class="textarea" id="isi_sub_judul" name="isi_sub_judul" placeholder="Isi Sub Judul" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></input>
                      </div>

                      <div class="form-group">
                        <label for="judul_tabel">Judul Tabel</label>
                        <input type="text" id="judul_tabel" name="judul_tabel" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 table-responsive">
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
                            <td><input type="text" name="tabel[target][Q1]" class="form-control"></td>
                            <td><input type="text" name="tabel[target][Q2]" class="form-control"></td>
                            <td><input type="text" name="tabel[target][Q3]" class="form-control"></td>
                            <td><input type="text" name="tabel[target][Q4]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td>Realisasi</td>
                            <td><input type="text" name="tabel[realisasi][Q1]" class="form-control"></td>
                            <td><input type="text" name="tabel[realisasi][Q2]" class="form-control"></td>
                            <td><input type="text" name="tabel[realisasi][Q3]" class="form-control"></td>
                            <td><input type="text" name="tabel[realisasi][Q4]" class="form-control"></td>
                          </tr>
                          <tr>
                            <td>Capaian</td>
                            <td><input type="text" name="tabel[capaian][Q1]" class="form-control"></td>
                            <td><input type="text" name="tabel[capaian][Q2]" class="form-control"></td>
                            <td><input type="text" name="tabel[capaian][Q3]" class="form-control"></td>
                            <td><input type="text" name="tabel[capaian][Q4]" class="form-control"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <div id="tabel_lain">

                  </div>

                  <button type="button" id="btn_tambah_tabel" class="btn btn-primary">
                    Tambah Tabel
                  </button>
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
  var main_list = new Array();
  var id = -1;

  var tinymceReference = "#isi_sub_judul";
  tinymce.init({
    height: 350,
    selector: tinymceReference,
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
    toolbar_mode: 'wrap',
    force_br_newlines: true,
    force_p_newlines: false,
    forced_root_block: '',
    setup: function(editor) {
      editor.on('init', function() {

        $(tinymceReference).val(editor.getContent());
      });
      editor.on('change', function(e) {
        $(tinymceReference).val(editor.getContent());
      });
    }
  });

  const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 5000
  });

  // process the form
  $.ajax({
      type: 'GET',
      url: "<?= url('/kinerja/dashboard/Data/getMainList') ?>",
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

      data.forEach(function(value, index, array) {
        main_list.push(value);
      })

    });

  $("#btn_tambah_tabel").click(function() {
    ++id;

    var main_option_list = "";
    main_list.forEach(function(value, index, array) {
      main_option_list += '<option value="' + value.main + '">' + value.judul + '</option>';
    });

    $("#tabel_lain").append(
      '\
                <div id="tabel-' + id + '" class="row py-3">\
                <div class="col-5 px-0">\
                    <select name="tabel_lain[' + id + '][main]" onchange="getTableList(this, ' + id + ')" class="form-control" data-main="main-' + id + '">\
                    <option value="">Pilih...</option>' + main_option_list + '</select>\
                </div>\
                <div class="col-5 px-0">\
                    <select name="tabel_lain[' + id + '][id_tabel]" class="form-control" data-tabel-id="sub-' + id + '">\
                    </select>\
                </div>\
                <div class="col-2 px-0">\
                    <button type="button" onClick="hapusItemTabel(this, ' + id + ')" class="btn btn-danger">Hapus</button>\
                </div>\
                </div>'
    );
  });

  function hapusItemTabel(btnObject, id, selectedValue = "") {
    $("#tabel-" + id).remove();
  }

  function getTableList(selectObject, id, selectedValue = "") {
    $("select[data-tabel-id=sub-" + id + "]").find('option').remove().end();

    var value = "";

    if (selectObject instanceof jQuery) {
      value = selectObject.val();
    } else {
      value = selectObject.value;
    }

    if (value == "") return;

    $.ajax({
        type: 'GET',
        url: "<?= url('/kinerja/dashboard/Data/getSubMainTableList') ?>/" + value,
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

        data.forEach(function(item) {
          $("select[data-tabel-id=sub-" + id + "]").append('<option value="' + item.id_tabel +
            '">' + item.nama_iku + " - " + item.judul_tabel + '</option>');
        });

        if (selectedValue != "") {
          $("select[data-tabel-id=sub-" + id + "]").val(selectedValue);
        }

      });
  }

  $('form[id=form').submit(function(e) {
    e.preventDefault();

    $('.form-group').removeClass('has-error'); // remove the error class
    $('.help-block').remove(); // remove the error text
    $('.alert-success').remove();

    var formUrl = "<?= url("/kinerja/dashboard/{$main}/process_create") ?>";
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
              "<?= url("/kinerja/dashboard/{$main}") ?>"; //will redirect to any page
          }, 2500); //will call the function after 2.5 secs.

        }
      });
  });
</script>
@endsection