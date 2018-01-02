@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data Visi</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('visi.update', $visi->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="visi_id" value="{{$visi->id}}">
            {!! csrf_field() !!}

        <div class="form-group  @if($errors->has('nama_visi')) has-error @endif"">
          <label for="nama_visi" class="col-sm-2 control-label">Nama Visi</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama_visi" value="{{$visi->nama_visi}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_visi')}}</span>
            </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="{{route('visi.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
      </div>
    </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop