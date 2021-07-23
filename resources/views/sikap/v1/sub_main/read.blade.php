<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $row->judul ?></h1>
        </div>
        <div class="col-sm-5">
          <ol class="breadcrumb float-sm-right">
            <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li> -->
            <a href="<?= base_url("{$row->main}/{$row->sub}/update") ?>" type="button" class="btn btn-primary"> Ubah <i class="fas fa-plus"></i></a>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
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
              <div class="col-12">
                <h4>
                  Isu Utama/Implikasi
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-12 invoice-col">
                
                <?= $row->isi_sub_judul ?>

              </div>
              
            </div>
            <!-- /.row -->

            <?php if (isset($tabel_list)) : ?>
              <?php foreach ($tabel_list as $item) : ?>
                <!-- Table row -->
                <h4><?= $item["judul_tabel"] ?></h4>
                <div class="row">
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
                          <td><?= $item["target"]["Q1"] ?>%</td>
                          <td><?= $item["target"]["Q2"] ?>%</td>
                          <td><?= $item["target"]["Q3"] ?>%</td>
                          <td><?= $item["target"]["Q4"] ?>%</td>
                        </tr>
                        <tr>
                          <td>Realisasi</td>
                          <td><?= $item["realisasi"]["Q1"] ?>%</td>
                          <td><?= $item["realisasi"]["Q2"] ?>%</td>
                          <td><?= $item["realisasi"]["Q3"] ?>%</td>
                          <td><?= $item["realisasi"]["Q4"] ?>%</td>
                        </tr>
                        <tr>
                          <td>Capaian</td>
                          <td><?= $item["capaian"]["Q1"] ?>%</td>
                          <td><?= $item["capaian"]["Q2"] ?>%</td>
                          <td><?= $item["capaian"]["Q3"] ?>%</td>
                          <td><?= $item["capaian"]["Q4"] ?>%</td>
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->