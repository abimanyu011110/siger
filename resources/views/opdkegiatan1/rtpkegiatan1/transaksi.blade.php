@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

<a href="{{route('rtpkegiatan1.index')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Kembali</a>

    <a href="cetakRTP" class="btn btn-primary btn-sm" target="_blank">
    <span class="glyphicon glyphicon-print"></span> Cetak
    </a>

  </div>

    <table id="tbl-rtp" class="table table-hover">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th>Nama Kegiatan</th>
          <th>Nama Risiko</th>
          <th>Tingkat Risiko Analisis</th>
          <th>RTP Tambahan</th>
          <th>Jadwal</th>
          <th>Penganggungjawab</th>
          <th>Tingkat Risiko RTP</th>
          <th>Opsi Pengendalian</th>
          <th> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($rtp as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_kegiatan}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td align="center">{{$item->tingkat_risiko_analisis}}</td>
          <td>{{$item->rtp_tambah}}</td>
          <td>{{$item->jadwal}}</td>
          <td>{{$item->penanggungjawab}}</td>
          <td align="center">{{$item->tingkat_risiko_rtp}}</td>
          <td align="center">{{$item->opsi}}</td>
          <td>
            <a href="{{route('rtpkegiatan1.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['rtpkegiatan1.destroy', $item->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
            {!! Form::close() !!}
          </td>
          </tr>
          @endforeach
    </table>
  </div>
</div>

@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
      $('#tbl-rtp').dataTable({
          "scrollX": true
      });
    });
  </script>
@endpush