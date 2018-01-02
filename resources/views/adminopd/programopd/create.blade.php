@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Program {{Auth::user()->nama}}</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('programopd.store')}}" method="post">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="opd_id" class="col-sm-2 control-label">Nama OPD</label>
          <div class="col-sm-10">
            <select name="opd_id" class="form-control" id="opd_id">
              @foreach($opd as $key => $value)
                <option value="{{$key}}" {{old('opd_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="sasaran_id" class="col-sm-2 control-label">Pilih Sasaran</label>
          <div class="col-sm-10">
            <select name="sasaran_id" class="form-control" id="sasaran_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($sasaran as $key => $value)
                <option value="{{$key}}" {{old('sasaran_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
  
        <div class="form-group  @if($errors->has('nama_program')) has-error @endif"">
          <label for="nama_program" class="col-sm-2 control-label">Nama Program</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_program" value="{{old('nama_program')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_program')}}</span>
            </div>
        </div>
        
        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('programopd.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop