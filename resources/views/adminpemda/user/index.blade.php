@extends('layout.index')
@section('isi')

<div class="col-sm-12">

		<div style="margin-bottom: 10px">
	    	<a href="{{route('manajemen-user.create')}}" class="btn btn-primary btn-xs">
	    	<span class="glyphicon glyphicon-plus"></span> Tambah
	    	</a>
  		</div>

	<div>
  		{{ csrf_field() }}
    	<table id="tbl-user" class="table table-hover">
      	<thead align="center">
        	<tr>
          		<th>No.</th>
          		<th>Nama</th>
          		<th>Username</th>
          		<th>Nama OPD</th>
          		<th>Nama Role</th>
          		<th width="13%"> </th>
        	</tr>
      	</thead>
      <?php $no=1; ?>
      @foreach($user as $item)
        	<tr class="item{{$item->id}}">
          	<td>{{$no++}}</td>
          	<td>{{$item->nama}}</td>
          	<td>{{$item->username}}</td>
          	<td>{{$item->nama_opd}}</td>
          	<td>{{$item->nama_role}}</td>
            <td>
            <a href="{{route('manajemen-user.edit', $item->id)}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <input type="hidden" name="_method" value="delete">
            {!! Form::open(['method' => 'DELETE','route' => ['manajemen-user.destroy', $item->id],'style'=>'display:inline']) !!}
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
    $('#tbl-user').DataTable();
  });
  </script>
@endpush