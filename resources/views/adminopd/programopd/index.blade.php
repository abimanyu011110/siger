@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <h3 style="font-family: Sitka-Heading" align="center">Daftar Program {{$nama->nama_opd}}</h3>
  <div style="margin-bottom: 10px">  

    <a href="{{route('programopd.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-program" class="table table-hover">
      <thead align="center">
        <tr>
          <th width="3%">No.</th>
          <th>Nama Sasaran</th>
          <th>Nama Program</th>
          <th width="12%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($program as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_program}}</td>
          <td>
            <a href="{{route('programopd.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['programopd.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-program').DataTable();
  });
  </script>
@endpush