<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Daftar Analisis Risiko</title>
    <style type="text/css">
    table {
    border-collapse: collapse;
    }
    table, th, td {
    border: 1px solid;
    }
    th, td {
    padding: 3;
    }
    </style>
</head>
<body>

  <div align="center">
  <label style="font-size: 18px; font-weight: bold; font-family:sans-serif">{{$nama_pemda->nama_pemda}}</label><br/>
  <label style="font-size:18px; font-weight: bold; font-family:sans-serif">Daftar Analisis Risiko</label><br/>
  <label style="font-size:16px; font-weight: bold; font-family:sans-serif">{{$nama_opd->nama_opd}}</label><br><br>
  </div>

    <div>
      <table style="font-family: sans-serif; font-size: 12px; font-weight: bold;" width="100%">
      <tr align="center">
          <th>No.</th>
          <th>Nama Kegiatan</th>
          <th>Nama Risiko</th>
          <th>Nilai Kemungkinan</th>
          <th>Nilai Dampak</th>
          <th>Tingkat Risiko</th>
        </tr>
        <tr style="background-color: #BDBDBD; font-style: italic; font-size: 8px" align="center">
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          <th>6</th>
        </tr>
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