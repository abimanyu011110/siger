@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Kegiatan {{Auth::user()->nama}}</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('kegiatanopd.store')}}" method="post">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="opd_id" class="col-sm-3 control-label">Nama OPD</label>
          <div class="col-sm-9">
            <select name="opd_id" class="form-control" id="opd_id">
              @foreach($opd as $key => $value)
                <option value="{{$key}}" {{old('opd_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="program_id" class="col-sm-3 control-label">Pilih Program</label>
          <div class="col-sm-9">
            <select name="program_id" class="form-control" id="program_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($program as $key => $value)
                <option value="{{$key}}" {{old('program_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
  
        <div class="form-group  @if($errors->has('nama_kegiatan')) has-error @endif"">
          <label for="nama_kegiatan" class="col-sm-3 control-label">Nama Kegiatan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_kegiatan" value="{{old('nama_kegiatan')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_kegiatan')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('bobot')) has-error @endif"">
          <label for="bobot" class="col-sm-3 control-label">Bobot Terhadap Sasaran</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="bobot" value="{{old('bobot')}}" placeholder="angka dalam (%)">
              <span id="helpBlock2" class="help-block">{{$errors->first('bobot')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('nama')) has-error @endif"">
          <label for="nama" class="col-sm-3 control-label">Pemilik Risiko </label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" value="{{old('nama')}}" placeholder="Nama">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('jabatan')) has-error @endif"">
          <label for="jabatan" class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="jabatan" value="{{old('jabatan')}}" placeholder="Jabatan">
              <span id="helpBlock2" class="help-block">{{$errors->first('jabatan')}}</span>
            </div>
        </div>
        
        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('kegiatanopd.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop