@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

    <a href="trans_rtp" class="btn btn-primary btn-sm">
    <span class="glyphicon glyphicon-eye-open"></span> Data RTP
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-rtp" class="table table-hover">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th width="300px">Nama Kegiatan</th>
          <th width="300px">Nama Risiko</th>
          <th>Tingkat Risiko</th>
          <th>Selera Risiko</th>
          <th width="150px"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($rtp as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_kegiatan}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td align="center">{{$item->tingkat_risiko_analisis}}</td>
          <td align="center">{{$item->selera_risiko}}</td>
          
            @if($item->tingkat_risiko>0)
              <td><span class="label label-info arrowed-in arrowed-in-right"> Sudah RTP</span></td>
            @else
              <td><a href="rtpkegiatan1/create/{{$item->id}}" class="btn btn-warning btn-xs">
              <span class="glyphicon glyphicon-edit"></span> Input RTP</a></td>
            @endif

          </tr>
          @endforeach
    </table>
  </div>
</div>

@endsection

@push('js')
  <script>
  $(document).ready(function() {
  $('#tbl-rtp').dataTable({
  "scrollX": true
  });
  });
  </script>
@endpush
