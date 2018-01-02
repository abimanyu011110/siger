@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

    <a href="pantauopd" class="btn btn-primary btn-sm">
    <span class="glyphicon glyphicon-eye-open"></span> Data Pemantauan
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-rtp" class="table table-hover">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th width="30%">Nama Sasaran</th>
          <th width="30%">Nama Risiko</th>
          <th>RTP Tambahan</th>
          <th>Kemungkinan Tingkat RTP</th>
          <th>Dampak Tingkat RTP</th>
          <th>Tingkat Risiko RTP</th>
          <th>Opsi Pengendalian</th>
          <th width="12%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($rtp as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->rtp_tambah}}</td>
          <td align="center">{{$item->kemungkinan_id}}</td>
          <td align="center">{{$item->dampak_id}}</td>
          <td align="center">{{$item->tingkat_risiko_rtp}}</td>
          <td align="center">{{$item->opsi}}</td>

          @if($item->tingkat_risiko>0)
              <td><span class="label label-info arrowed-in arrowed-in-right"> Sudah Pemantauan</span></td>
            @else
              <td><a href="pemantauanopd2/create/{{$item->id}}" class="btn btn-warning btn-xs">
              <span class="glyphicon glyphicon-edit"></span> Input </a></td>
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
  "scrollX": false
  });
  });
  </script>
@endpush
