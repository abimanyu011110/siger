@extends('layout.index')
@section('isi')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ID', 'Kemungkinan', 'Dampak', 'Tingkat Risiko'],
          @foreach ($chart as $charts)
            ['{{$charts->id}}', {{$charts->kemungkinan}}, {{$charts->dampak}}, {{$charts->tingkat_risiko}}],
          @endforeach
        ]);

        var options = {
          colorAxis: {minValue: 0, maxValue: 25, colors: ['green',  'yellow', 'orange', 'red']},
          title: '',
          hAxis: {title: 'KEMUNGKINAN', viewWindow: { min: 0,max: 6,},ticks: [0, 1, 2, 3, 4, 5], gridlines: {backgroundColor: ['transparent']},},        
          vAxis: {title: 'DAMPAK', viewWindow: { min: 0,max: 6},ticks: [0, 1, 2, 3, 4, 5], gridlines: {backgroundColor: ['transparent']},},
          bubble:  {textStyle: {auraColor: 'none' }, opacity: 0.9},
          animation: {startup : true, duration: 3000, easing: 'out'},
          explorer: { actions: ['dragToZoom', 'rightClickToReset'] },
        };

        var chart = new google.visualization.BubbleChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

      function drawChart2()
      {

        var data = google.visualization.arrayToDataTable([
          ['ID', 'Kemungkinan', 'Dampak', 'Tingkat Risiko'],
          @foreach ($chart as $charts)
            ['{{$charts->id}}', {{$charts->kemungkinan}}, {{$charts->dampak}}, {{$charts->tingkat_risiko}}],
          @endforeach
        ]);

        var options = {
        hAxis: {title: 'KEMUNGKINAN'},
        vAxis: {title: 'DAMPAK'},
        seriesType: 'bars',
        series: {3: {type: 'line'}}
        
      };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }


    </script>

    <p align="center" style="font-size:18px; font-weight: bold; font-family: sans-serif">PETA RISIKO</p>

    <div id="chart_div" style="width: 900px; height: 500px;" align="center"></div>
    <div id="chart_div2" style="width: 900px; height: 500px;" align="center"></div>

    <div class="col-sm-12">
    <table id="tbl-analisis" class="table table-bordered">
      <thead align="center">
        <tr>
          <th width="4%">No.</th>
          <th width="4%">ID.</th>
          <th width="35%">Nama Sasaran</th>
          <th width="35%">Nama Risiko</th>
          <th width="5%">Kemungkinan</th>
          <th width="4%">Dampak</th>
          <th width="5%">Tingkat Risiko</th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($dt as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td align="center">{{$item->id}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td align="center">{{$item->kemungkinan_id}}</td>
          <td align="center">{{$item->dampak_id}}</td>
          <td align="center">{{$item->tingkat_risiko}}</td>
        </tr>
          @endforeach
    </table>
    </div>

@endsection