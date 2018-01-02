@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

<a href="{{route('identifikasiopd1.index')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Kembali</a>

    <a href="cetakidentifikasiopd" class="btn btn-primary btn-sm" target="_blank">
    <span class="glyphicon glyphicon-print"></span> Cetak
    </a>

  </div>

    <table id="tbl-identifikasiopd" class="table table-boder">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Sasaran</th>
          <th>Periode</th>
          <th>Nama Risiko</th>
          <th>Uraian</th>
          <th>Pemilik Risiko</th>
          <th>Sumber Risiko</th>
          <th>C/ U</th>
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
          <td align="center">{{$item->periode}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->uraian}}</td>
          <td>{{$item->pemilik_risiko}}</td>
          <td>{{$item->sumber_risiko}}</td>
          <td align="center">{{$item->kontrol}}</td>
          <td>{{$item->penyebab}}</td>
          <td>{{$item->dampak}}</td>
          <td>{{$item->pengendalian}}</td>
          <td align="center">{{$item->sisa_risiko}}</td>
          <td>
            <a href="{{route('identifikasiopd1.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['identifikasiopd1.destroy', $item->id],'style'=>'display:inline']) !!}
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
      $('#tbl-identifikasiopd').dataTable({
          "scrollX": false
      });
    });
  </script>
@endpush