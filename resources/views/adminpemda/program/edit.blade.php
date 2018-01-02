@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data Program Pemerintah Daerah</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('program.update', $program->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="program" value="{{$program->id}}">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="sasaran_id" class="col-sm-2 control-label">Pilih Sasaran</label>
          <div class="col-sm-10">
            <select name="sasaran_id" class="form-control" id="sasaran_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($sasaran as $key => $value)
                <option value="{{$key}}" {{$program->sasaran_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group  @if($errors->has('nama_program')) has-error @endif"">
          <label for="nama_program" class="col-sm-2 control-label">Nama Program</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_program" value="{{$program->nama_program}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_program')}}</span>
            </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="{{route('program.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
      </div>
    </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop