@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

    <a href="{{route('createnew')}}" class="btn btn-primary btn-sm">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

    <a href="tranIdentifikasiOpd" class="btn btn-primary btn-sm">
    <span class="glyphicon glyphicon-eye-open"></span> Data
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-identifikasi" class="table table-hover">
      <thead align="center">
        <tr>
          <th width="3%">No.</th>
          <th width="35%">Sasaran</th>
          <th width="35%">Nama Risiko</th>
          <th width="10%">Tk Risiko Komposit</th>
          <th width="8%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($identifikasiopd as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->tk1}}</td>
          @if ($item->sisa_risiko=='Ada')
            <td><span class="label label-info arrowed-in arrowed-in-right"> Sudah Identifikasi</span></td>
          @else
            <td><a href="identifikasiopd1/create/{{$item->id}}" class="btn btn-warning btn-xs">
            <span class="glyphicon glyphicon-edit"></span> Input Identifikasi</a></td>
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
  $('#tbl-identifikasi').dataTable({
  "scrollX": false
  });
  });
  </script>
@endpush
