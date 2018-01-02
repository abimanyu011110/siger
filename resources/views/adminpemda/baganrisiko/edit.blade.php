@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data Risiko Pemerintah Daerah</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('baganrisiko.update', $baganrisiko->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="baganrisiko_id" value="{{$baganrisiko->id}}">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="kategori_id" class="col-sm-2 control-label">Pilih Kategori</label>
          <div class="col-sm-6">
            <select name="kategori_id" class="form-control" id="kategori_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($kategori as $key => $value)
                <option value="{{$key}}" {{$baganrisiko->kategori_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="proses_id" class="col-sm-2 control-label">Pilih Proses</label>
          <div class="col-sm-6">
            <select name="proses_id" class="form-control" id="proses_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($proses as $key => $value)
                <option value="{{$key}}" {{$baganrisiko->proses_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group  @if($errors->has('nama_risiko')) has-error @endif"">
          <label for="nama_risiko" class="col-sm-2 control-label">Nama Risiko</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_risiko" value="{{$baganrisiko->nama_risiko}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_risiko')}}</span>
            </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="{{route('baganrisiko.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
      </div>
    </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop