@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Identifikasi Kegiatan {{$nama->nama_opd}}</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('identifikasikegiatan1.store')}}" method="post">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="sasaran_id" class="col-sm-2 control-label"> Sasaran</label>
          <div class="col-sm-10">
            <select name="sasaran_id" class="form-control" id="sasaran_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($sasaran as $key => $value)
                <option value="{{$key}}" {{old('sasaran_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
            <label for="program_id" class="col-sm-2 control-label"> Program</label>
              <div class="col-sm-10">
                <select name="program_id" class="form-control" id="program_id">
                <option value="0" disabled="true" selected="true"></option>
                <option value="">-- Pilih Program --</option>
                </select>
              </div>
        </div>

        <div class="form-group">
            <label for="kegiatan_id" class="col-sm-2 control-label"> Kegiatan</label>
              <div class="col-sm-10">
                <select name="kegiatan_id" class="form-control" id="kegiatan_id">
                <option value="0" disabled="true" selected="true"></option>
                <option value="">-- Pilih Kegiatan --</option>
                </select>
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

         <div class="form-group">
          <label for="proses_id" class="col-sm-2 control-label"> Proses</label>
          <div class="col-sm-10">
            <select name="proses_id" class="form-control" id="proses_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($proses as $key => $value)
                <option value="{{$key}}" {{old('proses_id') == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
            <label for="risiko_id" class="col-sm-2 control-label"> Risiko</label>
              <div class="col-sm-10">
                <select name="risiko_id" class="form-control" id="risiko_id">
                <option value="0" disabled="true" selected="true"></option>
                <option value="">-- Pilih Risiko --</option>
                </select>
              </div>
        </div>

        <div class="form-group  @if($errors->has('uraian')) has-error @endif"">
          <label for="uraian" class="col-sm-2 control-label">Uraian</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="uraian" value="{{old('uraian')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('uraian')}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="pemilik_risiko" class="col-sm-2 control-label">Pemilik Risiko</label>
              <div class="col-sm-10">
                <select name="pemilik_risiko" class="form-control" id="pemilik_risiko">
                <option value="0" disabled="true" selected="true"></option>
                <option value="">-- Pilih Pemilik Risiko --</option>
                </select>
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

        <div class="form-group  @if($errors->has('dampak')) has-error @endif"">
          <label for="dampak" class="col-sm-2 control-label">Dampak Negatif</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="dampak" value="{{old('dampak')}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('dampak')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('pengendalian')) has-error @endif"">
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
            <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
            <a href="{{route('identifikasikegiatan1.index')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop

@push('js')

  <script type="text/javascript">
  $(document).ready(function() {
        $('#sasaran_id').on('change', function() {
            var sasaranId = $(this).val();
            console.log(sasaranId);
            if(sasaranId) {
                $.ajax({
                    url: '/identifikasikegiatan/pilihProgram/'+sasaranId,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                      console.log(data);
                        $('select[name="program_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="program_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="program_id"]').empty();
            }
        });

        $('#program_id').on('click', function() {
            var progID = $(this).val();
            console.log(progID);
            if(progID) {
                $.ajax({
                    url: '/identifikasikegiatan/pilihKegiatan/'+progID,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        $('select[name="kegiatan_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="kegiatan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="kegiatan_id"]').empty();
            }
        });

        $('#kegiatan_id').on('click', function() {
            var kegID = $(this).val();
            console.log(kegID);
            if(kegID) {
                $.ajax({
                    url: '/identifikasikegiatan/pilihPemilik/'+kegID,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        $('select[name="pemilik_risiko"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="pemilik_risiko"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="pemilik_risiko"]').empty();
            }
        });

        $('#proses_id').select2().on('change', function() {
            var prosesID = $(this).val();
            console.log(prosesID);
            if(prosesID) {
                $.ajax({
                    url: '/identifikasikegiatan/pilihRisiko/'+prosesID,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                      console.log(data);
                        $('select[name="risiko_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="risiko_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="risiko_id"]').empty();
            }
        });

        $('#risiko_id').select2()

    });
  </script>

@endpush
