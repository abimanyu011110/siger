@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data Pemerintah Daerah</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('pemda.update', $pemda->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="pemda_id" value="{{$pemda->id}}">
            {!! csrf_field() !!}

        <div class="form-group  @if($errors->has('tahun')) has-error @endif"">
          <label for="tahun" class="col-sm-2 control-label">Tahun</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="tahun" value="{{$pemda->tahun}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('tahun')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('nama_pemda')) has-error @endif"">
          <label for="nama_pemda" class="col-sm-2 control-label">Nama Pemda</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="nama_pemda" value="{{$pemda->nama_pemda}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_pemda')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('alamat')) has-error @endif"">
          <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="alamat" value="{{$pemda->alamat}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('alamat')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('kepala_daerah')) has-error @endif"">
          <label for="kepala_daerah" class="col-sm-2 control-label">Kepala Daerah</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="kepala_daerah" value="{{$pemda->kepala_daerah}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('kepala_daerah')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('jabatan')) has-error @endif"">
          <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="jabatan" value="{{$pemda->jabatan}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('jabatan')}}</span>
            </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="{{route('pemda.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
      </div>
    </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop