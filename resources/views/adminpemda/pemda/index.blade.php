@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">  

    <a href="{{route('pemda.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-pemda" class="table table-hover">
      <thead align="center">
        <tr align="left">
          <th>No.</th>
          <th>Tahun</th>
          <th>Nama Pemda</th>
          <th>Alamat</th>
          <th>Kepala Daerah</th>
          <th>Jabatan</th>
          <th width="14%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($pemda as $item)
        <tr class="item{{$item->id}}">
          <td align="left">{{$no++}}</td>
          <td align="left">{{$item->tahun}}</td>
          <td align="left">{{$item->nama_pemda}}</td>
          <td align="left">{{$item->alamat}}</td>
          <td align="left">{{$item->kepala_daerah}}</td>
          <td align="left">{{$item->jabatan}}</td>
          <td>
            <a href="{{route('pemda.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['pemda.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-pemda').DataTable();
  });
  </script>
@endpush