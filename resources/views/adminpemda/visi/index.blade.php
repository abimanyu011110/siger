@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">  

    <a href="{{route('visi.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-visi" class="table table-hover">
      <thead align="center">
        <tr align="left">
          <th>No.</th>
          <th>Nama Visi</th>
          <th width="13%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($visi as $item)
        <tr class="item{{$item->id}}">
          <td align="left">{{$no++}}</td>
          <td align="left">{{$item->nama_visi}}</td>
          <td>
            <a href="{{route('visi.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['visi.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-visi').DataTable();
  });
  </script>
@endpush