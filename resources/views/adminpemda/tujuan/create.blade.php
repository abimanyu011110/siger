@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Tujuan Pemerintah Daerah</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('tujuan.store')}}" method="post">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="misi_id" class="col-sm-2 control-label">Pilih Misi</label>
          <div class="col-sm-10">
            <select name="misi_id" class="form-control" id="misi_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($misi as $key => $value)
                <option value="{{$key}}" {{old('misi_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
  
        <div class="form-group  @if($errors->has('nama_tujuan')) has-error @endif"">
          <label for="nama_tujuan" class="col-sm-2 control-label">Nama Tujuan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_tujuan" value="{{old('nama_tujuan')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_tujuan')}}</span>
            </div>
        </div>
        
        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('tujuan.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop