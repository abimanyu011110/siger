<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Daftar Analisis Risiko</title>
    <style>

        body { margin: 0.5cm 0.5cm 0.5cm 0.5cm;
        }
        .biodata tr td{vertical-align: top}

        table {
            border-collapse: collapse;
            width: 100%;
            font-size;10px;
        }

        th, td {
            padding: 8px;
            border: 0.5px solid black;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
        background-color: #81DAF5;
        color: white;
        }

    </style>
</head>
<body>

  <label align="center" style="font-size: 18px; font-weight: bold; font-family: sans-serif">{{$nama_pemda->nama_pemda}}</label><br>
  <label align="center" style="font-size:14px; font-weight: bold; font-family: sans-serif">Daftar Analisis Risiko</label><br>

    <div style="overflow:auto;">
      <table style="font-family: sans-serif; font-size: 10px">
      <thead>
        <tr>
          <th align="center">No.</th>
          <th align="center">Nama Sasaran</th>
          <th align="center">Nama Risiko</th>
          <th align="center">Nilai Kemungkinan</th>
          <th align="center">Nilai Dampak</th>
          <th align="center">Tingkat Risiko</th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($dt as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td align="center">{{$item->kemungkinan}}</td>
          <td align="center">{{$item->dampak}}</td>
          <td align="center">{{$item->tingkat_risiko}}</td>
        </tr>
          @endforeach
      </table>
    </div>

</body>
</html>