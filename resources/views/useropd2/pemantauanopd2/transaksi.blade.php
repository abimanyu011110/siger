@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body">
  <div style="margin-bottom: 10px">

<a href="{{route('pemantauanopd2.index')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Data Pemantauan</a>

    <a href="cetakpantauopd" class="btn btn-primary btn-sm" target="_blank">
    <span class="glyphicon glyphicon-print"></span> Cetak
    </a>

  </div>

    <table id="tbl-pemantauan" class="table table-boder">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Sasaran</th>
          <th>Nama Risiko</th>
          <th>RTP Tambahan</th>
          <th>Tingkat Risiko RTP</th>
          <th>Tingkat Risiko Pemantauan</th>
          <th>Deviasi</th>
          <th>Pelaksanaan RTP</th>
          <th>Rekomendasi</th>
          <th width="14%"> </th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($dt as $item)
        <tr class="item{{$item->id}}">
          <td>{{$no++}}</td>
          <td>{{$item->nama_sasaran}}</td>
          <td>{{$item->nama_risiko}}</td>
          <td>{{$item->rtp_tambah}}</td>
          <td align="center">{{$item->tingkat_risiko_rtp}}</td>
          <td align="center">{{$item->tingkat_risiko}}</td>
          <td align="center">{{$item->deviasi}}</td>
          <td align="center">{{$item->rtp}}</td>
          <td>{{$item->rekomendasi}}</td>
          <td>
            <a href="{{route('pemantauanopd2.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['pemantauanopd2.destroy', $item->id],'style'=>'display:inline']) !!}
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
      $('#tbl-pemantauan').dataTable({
          "scrollX": false
      });
    });
  </script>
@endpush
