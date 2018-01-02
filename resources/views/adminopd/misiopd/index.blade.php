@extends('layout.index')

@section('isi')

<div class="box">
  <div class="box-body"><br>
  <h3 style="font-family: Sitka-Heading" align="center">Daftar Misi Pemerintah Daerah</h3>
  <div style="margin-bottom: 10px">
  </div>
  {{ csrf_field() }}
    <table id="tbl-misi" class="table table-hover">
      <thead align="center">
        <tr>
          <th>No.</th>
          <th>Nama Misi</th>
        </tr>
      </thead>
      <?php $no=1; ?>
      @foreach($misi as $item)
        <tr class="item{{$item->id}}">
          <td align="center">{{$no++}}</td>
          <td>{{$item->nama_misi}}</td>
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