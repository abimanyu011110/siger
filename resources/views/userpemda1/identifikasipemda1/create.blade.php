@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Identifikasi Risiko Sasaran</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('identifikasipemda1.store')}}" method="post">
            {!! csrf_field() !!}

            <input type="hidden" name="analisis_id" value="{{ $sasaran->id }}">
            <input type="hidden" name="sasaran_id" value=" {{ $sasaran->sasaran_id }}">
            <input type="hidden" name="risiko_id" value="{{ $sasaran->risiko_id }}">
            
            <div class="form-group @if($errors->has('sasaran_id')) has-error @endif">
              <label for="sasaran_id" class="col-sm-2 control-label">Nama Sasaran</label>
              <div class="col-sm-10">
                <label class="form-control">{{ $sasaran->nama_sasaran }}</label>
              </div>
            </div>

            <div class="form-group @if($errors->has('risiko_id')) has-error @endif">
              <label for="risiko_id" class="col-sm-2 control-label">Nama Risiko</label>
              <div class="col-sm-10">
                <textarea id="risiko_id" name="risiko_id" class="form-control" disabled>{{ $sasaran->nama_risiko }}</textarea>
              </div>
            </div>

        <div class="form-group @if($errors->has('periode')) has-error @endif">
          <label for="periode" class="col-sm-2 control-label">Periode</label>
          <div class="col-sm-2">
            <select class="form-control" name="periode" id="periode">
              @foreach($periode as $per)
              <option value="{{$per}}" {{old('periode') == $per ? 'selected' : ''}}>{{$per}}</option>
              @endforeach
            </select>
            <span id="helpBlock2" class="help-block">{{$errors->first('periode')}}</span>
          </div>
        </div>


        <div class="form-group  @if($errors->has('uraian')) has-error @endif">
          <label for="uraian" class="col-sm-2 control-label">Uraian</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="uraian" value="{{old('uraian')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('uraian')}}</span>
            </div>
        </div>


        <div class="form-group @if($errors->has('sumber_risiko')) has-error @endif">
          <label for="sumber_risiko" class="col-sm-2 control-label">Sumber Risiko</label>
          <div class="col-sm-2">
            <select class="form-control" name="sumber_risiko" id="sumber_risiko">
              @foreach($sumber_risiko as $key)
              <option value="{{$key}}" {{old('sumber_risiko') == $key ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
            </select>
            <span id="helpBlock2" class="help-block">{{$errors->first('sumber_risiko')}}</span>
          </div>
        </div>

        <div class="form-group @if($errors->has('kontrol')) has-error @endif">
          <label for="kontrol" class="col-sm-2 control-label">Kontrol</label>
          <div class="col-sm-2">
            <select class="form-control" name="kontrol" id="kontrol">
              @foreach($kontrol as $key)
              <option value="{{$key}}" {{old('kontrol') == $key ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
            </select>
            <span id="helpBlock2" class="help-block">{{$errors->first('kontrol')}}</span>
          </div>
        </div>

        <div class="form-group  @if($errors->has('penyebab')) has-error @endif">
          <label for="penyebab" class="col-sm-2 control-label">Penyebab</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penyebab" value="{{old('penyebab')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('penyebab')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('dampak')) has-error @endif">
          <label for="dampak" class="col-sm-2 control-label">Dampak Negatif</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="dampak" value="{{old('dampak')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('dampak')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('pengendalian')) has-error @endif">
          <label for="penyebab" class="col-sm-2 control-label">Pengendalian yang ada</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pengendalian" value="{{old('pengendalian')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('pengendalian')}}</span>
            </div>
        </div>

        <div class="form-group @if($errors->has('sisa_risiko')) has-error @endif">
          <label for="sisa_risiko" class="col-sm-2 control-label">Sisa Risiko</label>
          <div class="col-sm-2">
            <select class="form-control" name="sisa_risiko" id="sisa_risiko">
              @foreach($sisa_risiko as $key)
              <option value="{{$key}}" {{old('sisa_risiko') == $key ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
            </select>
            <span id="helpBlock2" class="help-block">{{$errors->first('sisa_risiko')}}</span>
          </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('identifikasipemda1.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop
