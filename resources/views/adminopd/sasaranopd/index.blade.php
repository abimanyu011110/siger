@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <h3 style="font-family: Sitka-Heading" align="center">Daftar Sasaran {{$nama->nama_opd}}</h3>
  <div style="margin-bottom: 10px">  

    <a href="{{route('sasaranopd.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-sasaran" class="table table-hover">
      <thead align="center">
        <tr>
          <th width="3%">No.</th>
          <th>Nama Tujuan</th>
          <th>Nama Sasaran</th>
          <th width="12%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($sasaran as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_tujuan}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td align="center">
            <a href="{{route('sasaranopd.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['sasaranopd.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-sasaran').DataTable();
  });
  </script>
@endpush