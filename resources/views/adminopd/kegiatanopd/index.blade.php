@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <h3 style="font-family: Sitka-Heading" align="center">Daftar Kegiatan {{$nama->nama_opd}}</h3>
  <div style="margin-bottom: 10px">  

    <a href="{{route('kegiatanopd.create')}}" class="btn btn-primary btn-xs">
    <span class="glyphicon glyphicon-plus"></span> Tambah
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-kegiatan" class="table table-hover">
      <thead align="center">
        <tr>
          <th width="2%">No.</th>
          <th width="33%">Nama Program</th>
          <th width="33%">Nama Kegiatan</th>
          <th width="7%">Bobot</th>
          <th width="13%">Pemilik Risiko</th>
          <th width="12%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($kegiatan as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_program}}</td>
          <td>{{$item->nama_kegiatan}}</td>
          <td align="center">{{$item->bobot}}</td>
          <td>{{$item->pemilik_risiko}}</td>
          <td>
            <a href="{{route('kegiatanopd.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['kegiatanopd.destroy', $item->id],'style'=>'display:inline']) !!}
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

  $('#tbl-kegiatan').dataTable( {
  "scrollX": true
  });
  </script>
@endpush