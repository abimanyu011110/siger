@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Kategori</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('kategori.store')}}" method="post">
            {!! csrf_field() !!}
  
        <div class="form-group  @if($errors->has('nama_kategori')) has-error @endif"">
          <label for="nama_kategori" class="col-sm-2 control-label">Nama Kategori</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="nama_kategori" value="{{old('nama_kategori')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_kategori')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('selera_risiko')) has-error @endif"">
          <label for="selera_risiko" class="col-sm-2 control-label">Selera Risiko</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="selera_risiko" value="{{old('selera_risiko')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('selera_risiko')}}</span>
            </div>
        </div>
        
        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('kategori.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop