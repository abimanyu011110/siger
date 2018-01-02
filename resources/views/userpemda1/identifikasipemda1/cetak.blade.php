<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Daftar Identifikasi Risiko Pemerintah Daerah</title>
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
            border: 0.2px solid black;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        th {
        background-color: #81DAF5;
        color: white;
        }

    </style>
</head>
<body>

<div>
  <label align="center" style="font-size: 18px; font-weight: bold; font-family:sans-serif">{{$nama_pemda->nama_pemda}}</label><br/>
  <label align="center" style="font-size:14px; font-weight: bold; font-family:sans-serif">Daftar Identifikasi Risiko</label><br/>

</div>
    <div style="overflow:auto;">
      <table style="font-family: sans-serif; font-size: 10px">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th>Nama Sasaran</th>
          <th>Nama Risiko</th>
          <th>Periode</th>
          <th>Uraian</th>
          <th>Sumber Risiko</th>
          <th>Kontrol</th>
          <th>Penyebab</th>
          <th>Dampak Negatif</th>
          <th>Pengendalian</th>
          <th>Sisa Risiko</th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($identifikasipemda as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->periode}}</td>
          <td>{{$item->uraian}}</td>
          <td>{{$item->sumber_risiko}}</td>
          <td>{{$item->kontrol}}</td>
          <td>{{$item->penyebab}}</td>
          <td>{{$item->dampak}}</td>
          <td>{{$item->pengendalian}}</td>
          <td align="center">{{$item->sisa_risiko}}</td>
        </tr>
          @endforeach
      </table>
    </div>

</body>
</html>