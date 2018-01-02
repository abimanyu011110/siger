@extends('layout.index')



@section('isi')
    <script src="{{URL::asset('assets/js/highcharts.js')}}"></script>
    <script src="{{URL::asset('assets/js/highcharts-3d.js')}}"></script>
    <script src="{{URL::asset('assets/js/exporting.js')}}"></script>

<h1>GRAFIK ANALISIS RISIKO</h1>
    <div id="container" style="height: 400px"></div>

    <br>


        <div class="row">
            <div id="d" class="col-sm-3"></div>
            <div id="chart4" class="col-sm-3"></div>
            <div id="chart3" class="col-sm-3"></div>
            <div id="chart2" class="col-sm-3"></div>
        </div>

    <script type="text/javascript">



    Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Jumlah Risiko'
    },
    subtitle: {
        text: 'Berdasarkan tingkat risiko'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: Highcharts.getOptions().lang.shortMonths
    },
    yAxis: {
        title: {
            text: null
        }
    },
        series: [{
                name: 'jml',
                colorByPoint: true,
                data: [
                    @foreach($chart as $rst)
                    ['{{$rst->nama_risiko}}',{{$rst->tingkat_risiko}}],
                    @endforeach
                ]
        }]
});
    </script>


<a href="{{route('transaksi')}}">Kembali</a>

@endsection
