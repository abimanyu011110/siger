@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Misi</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('misi.store')}}" method="post">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="visi_id" class="col-sm-2 control-label">Pilih Visi</label>
          <div class="col-sm-10">
            <select name="visi_id" class="form-control" id="visi_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($visi as $key => $value)
                <option value="{{$key}}" {{old('visi_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
  
        <div class="form-group  @if($errors->has('nama_misi')) has-error @endif"">
          <label for="nama_misi" class="col-sm-2 control-label">Nama Misi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_misi" value="{{old('nama_misi')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_misi')}}</span>
            </div>
        </div>
        
        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('misi.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop