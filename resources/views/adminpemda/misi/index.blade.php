@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">  

    <a href="{{route('misi.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-misi" class="table table-hover">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th>Nama Visi</th>
          <th>Nama Misi</th>
          <th width="13%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($misi as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_visi}}</td>
          <td>{{$item->nama_misi}}</td>
          <td>
            <a href="{{route('misi.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['misi.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-misi').DataTable();
  });
  </script>
@endpush