@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

<a href="{{route('analisispemda1.index')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Kembali</a>

    <a href="cetakanalisispemda" class="btn btn-primary btn-sm" target="_blank">
    <span class="glyphicon glyphicon-print"></span> Cetak
    </a>

    <a href="/analisispemda1/googlechart" class="btn btn-primary btn-sm">
    <span class="glyphicon glyphicon-signal"></span> Chart
    </a>

  </div>

    <table id="tbl-analisis" class="table table-hover">
      <thead align="center">
        <tr>
          <th width="3%">No.</th>
          <th>Nama Sasaran</th>
          <th>Nama Risiko</th>
          <th width="5%">Kemungkinan</th>
          <th width="4%">Dampak</th>
          <th width="5%">Tingkat Risiko</th>
          <th width="13%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($dt as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td align="center">{{$item->kemungkinan_id}}</td>
          <td align="center">{{$item->dampak_id}}</td>
          <td align="center">{{$item->tingkat_risiko}}</td>
          <td>
            <a href="{{route('analisispemda1.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['analisispemda1.destroy', $item->id],'style'=>'display:inline']) !!}
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
<script type="text/javascript">
    $(document).ready(function() {
      $('#tbl-analisis').dataTable({
          "scrollX": false
      });
    });
  </script>
@endpush