@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">  

    <a href="{{route('opd.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-opd" class="table table-hover">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th>Nama Urusan</th>
          <th>Nama Bidang</th>
          <th>Nama OPD</th>
          <th>Kepala OPD</th>
          <th>Jabatan</th>
          <th width="14%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($opd as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_urusan}}</td>
          <td>{{$item->nama_bidang}}</td>
          <td>{{$item->nama_opd}}</td>
          <td>{{$item->kepala_opd}}</td>
          <td>{{$item->jabatan}}</td>
          <td>
            <a href="{{route('opd.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['opd.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-opd').dataTable( {
        "scrollX": true
    });
} );
  </script>
@endpush