@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">  

    <a href="{{route('baganrisiko.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-baganrisiko" class="table table-hover">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th>Nama Kategori</th>
          <th>Nama Proses</th>
          <th>Nama Risiko</th>
          <th width="14%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($baganrisiko as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_kategori}}</td>
          <td>{{$item->nama_proses}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>
            <a href="{{route('baganrisiko.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['baganrisiko.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-baganrisiko').DataTable();
  });
  </script>
@endpush