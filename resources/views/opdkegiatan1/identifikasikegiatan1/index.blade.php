@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <h3 align="center">Daftar Identifikasi Risiko {{$nama->nama_opd}}</h3>
  <div style="margin-bottom: 10px">  

    <a href="{{route('identifikasikegiatan1.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

    <a href="cetakidentifikasi" class="btn btn-primary btn-xs" target="_blank">
    <span class="glyphicon glyphicon-print"></span> Cetak
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-identifikasi" class="table table-hover">
      <thead align="center">
        <tr>
          <th width="3%">No.</th>
          <th width="37%">Nama Kegiatan</th>
          <th width="40%">Nama Risiko</th>
          <th width="5%">Sisa Risiko</th>
          <th width="15%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($identifikasikegiatan as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_kegiatan}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->sisa_risiko}}</td>
          <td align="center">
            <a href="{{route('identifikasikegiatan1.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['identifikasikegiatan1.destroy', $item->id],'style'=>'display:inline']) !!}
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
  <script>
  $(document).ready(function() {
  $('#tbl-identifikasi').dataTable({
  "scrollX": true
  });
  });
  </script>
@endpush