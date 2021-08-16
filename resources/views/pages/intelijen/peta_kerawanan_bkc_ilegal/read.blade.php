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
            <div id="map"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('css')
<style>
  #map {
    height: 500px;
  }
</style>
@endsection

@section('javascript')
<script>
  function initMap() {

    var locations = [];

    <?php
    $count = 1;
    foreach ($rows as $row) :
    ?>
      locations.push({
        id: <?= $row->id ?>,
        lat: <?= explode(",", $row->koordinat)[0] ?>,
        lng: <?= explode(",", $row->koordinat)[1] ?>,
        label: '<?= $count ?>',
        deskripsi: '<?= $row->deskripsi ?> ',
        img_url: '<?= $row->img_url ?> ',
      });
    <?php
      ++$count;
    endforeach;
    ?>

    var map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: -8.5830695,
        lng: 116.3202515
      },
      zoom: 8
    });
    var markers = locations.map(function(location, i) {
      var contentString = "\
      <div>\
      <div style='font-size: 15px; margin-bottom: 10px;'>" + location.deskripsi + "</div>\
      <img style='max-width: 200px' src='" + location.img_url + "'/>\
      <br/>\
      <a style='float: right; margin-top: 10px;' href='<?= Request::url() ?>/" + location.id + "/update'>Edit here</a></div>";
      var infoWindow = new google.maps.InfoWindow({
        content: contentString,
      });
      var marker = new google.maps.Marker({
        position: location,
        label: location.label,
        map: map,
        title: location.title,
        contentString: contentString
      });
      marker.addListener('click', function() {
        infoWindow.open(map, marker);
      });
      return marker;
    });

  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASyYRBZmULmrmw_P9kgr7_266OhFNinPA&amp;callback=initMap">
</script>
@endsection