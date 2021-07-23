<footer class="main-footer">
  <strong>Copyright &copy; 2021 <a href="http://bcmeulaboh.beacukai.go.id/">KPPBC TMP C Meulaboh</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0
  </div>
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
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/adminlte3/plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Knob -->
<script src="<?php echo base_url(); ?>assets/adminlte3/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/adminlte3/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/adminlte3/dist/js/demo.js"></script>
<script>
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  /* jQueryKnob */

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
        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
        this.g.stroke()

        return false
      }
    }
  })
  /* END JQUERY KNOB */



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
</body>

</html>