  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update</h1>
          </div>
          <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create</h3>

              <div class="card-tools">
                <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button> -->
              </div>
            </div>
            <div class="card-body">
              <form id="form" action="process_update" method="POST">
                <input type="hidden" name="main" value="<?= $row->main ?>" />
                <input type="hidden" name="sub" value="<?= $row->sub ?>" />
                <input type="hidden" name="id" value="<?= $row->id ?>" />

                <div class="col-md-10">
                  <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" name="judul" class="form-control" value="<?= $row->judul ?>">
                  </div>

                  <div class="form-group">
                    <label for="nama_iku">Nama IKU</label>
                    <input type="text" id="nama_iku" name="nama_iku" class="form-control" value="<?= $row->nama_iku ?>">
                  </div>

                  <div class="form-group">
                    <label for="detail_iku">Detail IKU</label>
                    <input type="text" id="detail_iku" name="detail_iku" class="form-control" value="<?= $row->detail_iku ?>">
                  </div>

                  <div class="form-group">
                    <label for="isi_sub_judul">Isi Sub Judul</label>
                    <input class="textarea" id="isi_sub_judul" name="isi_sub_judul" placeholder="Isi Sub Judul" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></input>
                  </div>

                  <div class="form-group">
                    <label for="judul_tabel">Judul Tabel</label>
                    <input type="text" id="judul_tabel" name="judul_tabel" class="form-control" value="<?= $data_tabel["judul_tabel"] ?>">
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
                          <td><input type="text" name="tabel[target][Q1]" class="form-control" value="<?= $data_tabel["target"]["Q1"] ?>"></td>
                          <td><input type="text" name="tabel[target][Q2]" class="form-control" value="<?= $data_tabel["target"]["Q2"] ?>"></td>
                          <td><input type="text" name="tabel[target][Q3]" class="form-control" value="<?= $data_tabel["target"]["Q3"] ?>"></td>
                          <td><input type="text" name="tabel[target][Q4]" class="form-control" value="<?= $data_tabel["target"]["Q4"] ?>"></td>
                        </tr>
                        <tr>
                          <td>Realisasi</td>
                          <td><input type="text" name="tabel[realisasi][Q1]" class="form-control" value="<?= $data_tabel["realisasi"]["Q1"] ?>"></td>
                          <td><input type="text" name="tabel[realisasi][Q2]" class="form-control" value="<?= $data_tabel["realisasi"]["Q2"] ?>"></td>
                          <td><input type="text" name="tabel[realisasi][Q3]" class="form-control" value="<?= $data_tabel["realisasi"]["Q3"] ?>"></td>
                          <td><input type="text" name="tabel[realisasi][Q4]" class="form-control" value="<?= $data_tabel["realisasi"]["Q4"] ?>"></td>
                        </tr>
                        <tr>
                          <td>Capaian</td>
                          <td><input type="text" name="tabel[capaian][Q1]" class="form-control" value="<?= $data_tabel["capaian"]["Q1"] ?>"></td>
                          <td><input type="text" name="tabel[capaian][Q2]" class="form-control" value="<?= $data_tabel["capaian"]["Q2"] ?>"></td>
                          <td><input type="text" name="tabel[capaian][Q3]" class="form-control" value="<?= $data_tabel["capaian"]["Q3"] ?>"></td>
                          <td><input type="text" name="tabel[capaian][Q4]" class="form-control" value="<?= $data_tabel["capaian"]["Q4"] ?>"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div id="tabel_lain">

                </div>

                <a id="btn_tambah_tabel" type="button" class="btn btn-primary"> Tambah Tabel <i class="fas fa-plus"></i></a>

                <form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
          <input type="submit" value="Submit" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/adminlte3/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/adminlte3/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(); ?>assets/adminlte3/dist/js/demo.js"></script>
  <!-- Editor -->
  <script src="<?php echo base_url(); ?>assets/adminlte3/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url(); ?>assets/adminlte3/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?php echo base_url(); ?>assets/adminlte3/plugins/toastr/toastr.min.js"></script>
  <script>
    var main_list = new Array();
    var id = -1;

    // process the form
    $.ajax({
        type: 'POST',
        url: "<?= base_url("v2/Data/getMainList") ?>",
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
            <button type="button" onClick="hapusItemTabel(this, ' + id + ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>\
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
          type: 'POST',
          url: "<?= base_url("v2/Data/getSubMainTableList/") ?>" + value,
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
            $("select[data-tabel-id=sub-" + id + "]").append('<option value="' + item.id_tabel + '">' + item.nama_iku + " - " + item.judul_tabel + '</option>');
          });

          if (selectedValue != "") {
            $("select[data-tabel-id=sub-" + id + "]").val(selectedValue);
          }

        });
    }

    $(function() {
      // Summernote
      $('.textarea').summernote({
        height: 250
      }).on('summernote.change', function(we, contents, $editable) {
        $(this).val(contents);
      });
    })

    $('.textarea').summernote('code', "<?= $row->isi_sub_judul ?>");

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

      // var formData = {};

      // var datas = $(this).serializeArray();
      // datas.map(function(item, index, array) {
      //   formData[item.name] = item.value;
      // });

      // alert("Submitted");
      // alert(JSON.stringify(formData));

      var formUrl = "<?= base_url("{$row->main}/{$row->sub}/process_update") ?>";
      var data = new FormData(this);

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
              window.location.href = "<?= base_url("{$row->main}/{$row->sub}") ?>"; //will redirect to any page
            }, 2500); //will call the function after 2.5 secs.

          }
        });
    });

    <?php
    $id = -1;
    ?>
    <?php foreach ($tabel_list as $tabel) : ?>
      setTimeout(function() {
        $("#btn_tambah_tabel").trigger("click");
        <?php ++$id ?>
        var obj = $("select[data-main=main-<?= $id ?>]");
        obj.val("<?= $tabel["main_iku"] ?>");
        getTableList(obj, <?= $id ?>, "<?= $tabel["id_tabel"] ?>");
      }, 50 * <?= $id + 1 ?>);
    <?php endforeach; ?>
  </script>
  </body>

  </html>