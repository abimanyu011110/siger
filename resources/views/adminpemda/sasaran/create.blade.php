@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Sasaran Pemerintah Daerah</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('sasaran.store')}}" method="post">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="tujuan_id" class="col-sm-2 control-label">Pilih Tujuan</label>
          <div class="col-sm-10">
            <select name="tujuan_id" class="form-control" id="tujuan_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($tujuan as $key => $value)
                <option value="{{$key}}" {{old('tujuan_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>
  
        <div class="form-group  @if($errors->has('nama_sasaran')) has-error @endif"">
          <label for="nama_sasaran" class="col-sm-2 control-label">Nama Sasaran</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_sasaran" value="{{old('nama_sasaran')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_sasaran')}}</span>
            </div>
        </div>
        
        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('sasaran.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop