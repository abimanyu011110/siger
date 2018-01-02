@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

<a href="{{route('identifikasipemda1.index')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Data Identifikasi</a>

    <a href="cetakidentifikasipemda" class="btn btn-primary btn-sm" target="_blank">
    <span class="glyphicon glyphicon-print"></span> Cetak
    </a>

  </div>

    <table id="tbl-identifikasi" class="table table-boder">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Sasaran</th>
          <th>Nama Risiko</th>
          <th>Periode</th>
          <th>Uraian</th>
          <th>Sumber Risiko</th>
          <th>Kontrol</th>
          <th>Penyebab</th>
          <th>Dampak</th>
          <th>Pengendalian</th>
          <th>Sisa Risiko</th>
          <th> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($data as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->periode}}</td>
          <td>{{$item->uraian}}</td>
          <td>{{$item->sumber_risiko}}</td>
          <td>{{$item->kontrol}}</td>
          <td>{{$item->penyebab}}</td>
          <td>{{$item->dampak}}</td>
          <td>{{$item->pengendalian}}</td>
          <td>{{$item->sisa_risiko}}</td>
          <td>
            <a href="{{route('identifikasipemda1.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['identifikasipemda1.destroy', $item->id],'style'=>'display:inline']) !!}
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
      $('#tbl-identifikasi').dataTable({
          "scrollX": false
      });
    });
  </script>
@endpush