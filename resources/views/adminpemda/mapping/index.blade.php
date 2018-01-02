@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">  

    <a href="{{route('mapping.create')}}" class="btn btn-primary btn-sm">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-mapping" class="table table-hover">
      <thead align="center">
        <tr>
          <th width="4%">No.</th>
          <th>Sasaran Pemda</th>
          <th>Nama OPD</th>
          <th>Sasaran OPD</th>
          <th width="8%">Bobot</th>
          <th width="14%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($data as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran_pemda}}</td>
          <td>{{$item->nama_opd}}</td>
          <td>{{$item->nama_sasaran_opd}}</td>
          <td align="center">{{$item->bobot}}</td>
          <td>
            <a href="{{route('mapping.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['mapping.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-mapping').DataTable();
  });
  </script>
@endpush