@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data Tujuan {{Auth::user()->nama}}</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('tujuanopd.update', $tujuan->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="tujuan_id" value="{{$tujuan->id}}">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="opd_id" class="col-sm-2 control-label">Nama OPD</label>
          <div class="col-sm-10">
            <select name="opd_id" class="form-control" id="opd_id">
              @foreach($opd as $key => $value)
                <option value="{{$key}}" {{$tujuan->opd_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="misi_id" class="col-sm-2 control-label">Pilih Misi Pemda</label>
          <div class="col-sm-10">
            <select name="misi_id" class="form-control" id="misi_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($misi as $key => $value)
                <option value="{{$key}}" {{$tujuan->misi_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group  @if($errors->has('nama_tujuan')) has-error @endif"">
          <label for="nama_tujuan" class="col-sm-2 control-label">Nama Tujuan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_tujuan" value="{{$tujuan->nama_tujuan}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_tujuan')}}</span>
            </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="{{route('tujuanopd.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
      </div>
    </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop