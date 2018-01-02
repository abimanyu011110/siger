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
  <label style="font-size:18px; font-weight: bold; font-family:sans-serif">Daftar Identifikasi Risiko</label><br/>
  <label style="font-size:16px; font-weight: bold; font-family:sans-serif">{{$nama_opd->nama_opd}}</label><br><br>
</div>

   <div>
      <table width="100%" style="font-family: sans-serif; font-size: 12px; font-weight: bold;">
        <tr align="center">
          <th rowspan="2">No</th>
          <th rowspan="2">Sasaran</th>
          <th rowspan="2">Proses</th>
          <th rowspan="2">Pernyataan Risiko</th>
          <th rowspan="2">Pemilik Risiko</th>
          <th colspan="3">Penyebab</th>
          <th rowspan="2">Dampak Negatif</th>
          <th rowspan="2">Pengendalian</th>
          <th rowspan="2">Sisa Risiko</th>
        </tr>
        <tr align="center">
          <th>Sumber Risiko</th>
          <th width="4%">C/ U</th>
          <th>Uraian</th>
        </tr>
        <tr style="background-color: #BDBDBD; font-style: italic; font-size: 8px" align="center">
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          <th>6</th>
          <th>7</th>
          <th>8</th>
          <th>9</th>
          <th>10</th>
          <th>11</th>
        </tr>
        <?php $no=1; ?>
        @foreach($data as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td align="center">{{$item->nama_proses}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->pemilik_risiko}}</td>
          <td align="center">{{$item->sumber_risiko}}</td>
          <td align="center">{{$item->kontrol}}</td>
          <td>{{$item->uraian}}</td>
          <td>{{$item->dampak}}</td>
          <td>{{$item->pengendalian}}</td>
          <td align="center">{{$item->sisa_risiko}}</td>
        </tr>
        @endforeach
      </table>
    </div>

</body>
</html>