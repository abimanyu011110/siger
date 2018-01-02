@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

    <a href="{{route('transaksipemda')}}" class="btn btn-primary btn-sm">
    <span class="glyphicon glyphicon-eye-open"></span> Data Analisis
    </a>

  </div>
  {{ csrf_field() }}
    <table id="tbl-analisis" class="table table-bordered">
      <thead align="center">
        <tr>
          <th width="3%">No.</th>
          <th>Nama Sasaran</th>
          <th>Nama Risiko</th>
          <th width="10%">Sisa Risiko</th>
          <th width="8%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($analisis as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->sisa_risiko}}</td>

            @if ($item->tingkat_risiko>0)
              <td><span class="label label-success arrowed"> Sudah Analisis</span></td>
            @else
              <td><a href="analisispemda1/create/{{$item->id}}" class="btn btn-warning btn-xs">
              <span class="glyphicon glyphicon-edit"></span> Input Analisis</a></td>
            @endif

          </tr>
          @endforeach
    </table>
  </div>
</div>

@endsection

@push('js')
  <script>
  $(document).ready(function() {
  $('#tbl-analisis').dataTable({
  "scrollX": false
  });
  });
  </script>
@endpush
