@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">  

    <a href="{{route('kategori.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-kategori" class="table table-hover">
      <thead align="center">
        <tr align="left">
          <th>No.</th>
          <th>Nama Kategori</th>
          <th>Selera Risiko</th>
          <th width="13%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($kategori as $item)
        <tr class="item{{$item->id}}">
          <td align="left">{{$no++}}</td>
          <td align="left">{{$item->nama_kategori}}</td>
          <td align="left">{{$item->selera_risiko}}</td>
          <td>
            <a href="{{route('kategori.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['kategori.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-kategori').DataTable();
  });
  </script>
@endpush