@extends('layout.index')

@section('isi')

  <form class="form-horizontal" action="{{url('/useropd1/rtpopd1', $rtp->id)}}" method="POST">
    {!! csrf_field() !!}

    {{ method_field('PUT') }}
    <div class="col-sm-12">
      <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data RTP</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">


        <div class="form-group  @if($errors->has('rtp_tambah')) has-error @endif">
          <label for="rtp_tambah" class="col-sm-3 control-label">RTP Tambahan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="rtp_tambah" value="{{$rtp->rtp_tambah}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('rtp_tambah')}}</span>
            </div>
        </div>

        <div class="form-group @if($errors->has('jadwal')) has-error @endif"">
          <label for="jadwal" class="col-sm-3 control-label">Jadwal</label>
          <div class="col-sm-2">
            <select class="form-control" name="jadwal" id="jadwal">
              @foreach($jadwal as $per)
              <option value="{{$per}}" {{$rtp->jadwal == $per ? 'selected' : ''}}>{{$per}}</option>
              @endforeach
            </select>
            <span id="helpBlock2" class="help-block">{{$errors->first('jadwal')}}</span>
          </div>
        </div>

        <div class="form-group  @if($errors->has('penanggungjawab')) has-error @endif"">
          <label for="rtp_tambah" class="col-sm-3 control-label">Penanggung Jawab</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="penanggungjawab" value="{{$rtp->penanggungjawab}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('penanggungjawab')}}</span>
            </div>
        </div>

        <div class="form-group">
          <label for="kemungkinan" class="col-sm-3 control-label"> Kemungkinan Setelah RTP</label>
          <div class="col-sm-3">
            <select class="form-control" id="kemungkinan" name="kemungkinan">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($kemungkinan as $key => $value)
                <option value="{{$key}}" {{$rtp->kemungkinan_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-1">
            <input type="text" name="txt_kemungkinan" id="txt_kemungkinan" class="form-control" disabled>
          </div>
        </div>

        <div class="form-group">
          <label for="dampak" class="col-sm-3 control-label"> Dampak Setelah RTP</label>
          <div class="col-sm-3">
            <select class="form-control" id="dampak" name="dampak">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($dampak as $key => $value)
                <option value="{{$key}}" {{$rtp->dampak_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
            </div>
            <div class="col-sm-1">
              <input type="text" name="txt_dampak" id="txt_dampak" class="form-control" disabled>
            </div>
        </div>

        <div class="form-group  @if($errors->has('tingkat_risiko')) has-error @endif">
          <label for="tingkat_risiko" class="col-sm-3 control-label"> Tingkat Risiko</label>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-1">
              <input id="tingkat_risiko" type="text" class="form-control" name="tingkat_risiko" value="{{$rtp->tingkat_risiko}}" readonly="true">
              <span id="helpBlock2" class="help-block">{{$errors->first('tingkat_risiko')}}</span>
            </div>
        </div>

        <div class="form-group @if($errors->has('opsi')) has-error @endif">
          <label for="opsi" class="col-sm-3 control-label">Opsi Pengendalian</label>
          <div class="col-sm-2">
            <select class="form-control" name="opsi" id="opsi">
              @foreach($opsi as $key)
              <option value="{{$key}}" {{$rtp->opsi == $key ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
            </select>
            <span id="helpBlock2" class="help-block">{{$errors->first('opsi')}}</span>
          </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            {!! csrf_field() !!}
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('rtpopd1.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

        </div>
        </div>
        </div>
        </div>


          </form>


@stop

@push('js')
  <script type="text/javascript">
  $(document).ready(function() {

        $('#kegiatan_id').on('change', function() {
            var kegID = $(this).val();
            console.log(kegID)
            if(kegID) {
                $.ajax({
                    url: '/analisiskegiatan1/pilihRisiko/'+kegID,
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

        $('#kegiatan_id').on('change', function() {
            var kegID = $(this).val();
            console.log(kegID)
            if(kegID) {
                $.ajax({
                    url: '/analisiskegiatan1/pilihPeriode/'+kegID,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        console.log(data);
                        $('select[name="periode"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="periode"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="periode"]').empty();
            }
        });



        $('#dampak').on('change', function() {
          $('#txt_dampak').val($("#dampak option:selected").val());

          $('#tingkat_risiko').val($('#dampak option:selected').val() * $('#kemungkinan option:selected').val());
        });

        $('#kemungkinan').on('change', function() {
          $('#txt_kemungkinan').val($("#kemungkinan option:selected").val());

          $('#tingkat_risiko').val($('#dampak option:selected').val() * $('#kemungkinan option:selected').val());
        });
  });
  </script>
@endpush
