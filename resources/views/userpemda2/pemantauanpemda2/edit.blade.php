@extends('layout.index')

@section('isi')

  <form class="form-horizontal" action="{{url('/userpemda2/pemantauanpemda2', $pantau->id)}}" method="POST">
    {!! csrf_field() !!}

    {{ method_field('PUT') }}
    <div class="col-sm-12">
      <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data Pemantauan</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">

        <div class="form-group">
          <label for="dampak" class="col-sm-2 control-label"> Nilai Dampak</label>
          <div class="col-sm-1">
            <input type="text" name="txt_dampak" id="txt_dampak" class="form-control" disabled>
          </div>
          <div class="col-sm-3">
            <select class="form-control" id="dampak_id" name="dampak_id">

              @foreach($dampak as $key => $value)
                <option value="{{$key}}" {{$pantau->dampak_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
            </div>
        </div>

        <div class="form-group">
          <label for="kemungkinan" class="col-sm-2 control-label"> Nilai Kemungkinan</label>
          <div class="col-sm-1">
            <input type="text" name="txt_kemungkinan" id="txt_kemungkinan" class="form-control" disabled>
          </div>
          <div class="col-sm-3">
            <select class="form-control" id="kemungkinan_id" name="kemungkinan_id">

              @foreach($kemungkinan as $key => $value)
                <option value="{{$key}}" {{$pantau->kemungkinan_id == $key ? 'selected' : ''}}>{{$value}}</option>

              @endforeach
            </select>
          </div>

        </div>

        <div class="form-group  @if($errors->has('tingkat_risiko')) has-error @endif">
          <label for="tingkat_risiko" class="col-sm-2 control-label"> Tingkat Risiko</label>
            <div class="col-sm-1">
              <input id="tingkat_risiko" type="text"  readonly="true" class="form-control" name="tingkat_risiko" value="{{$pantau->tingkat_risiko}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('tingkat_risiko')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('tingkat_risiko')) has-error @endif">
          <label for="tingkat_risiko" class="col-sm-2 control-label"> Tingkat Risiko RTP</label>
            <div class="col-sm-1">
              <input id="tingkat_risiko1" type="text" class="form-control" name="tingkat_risiko1"
               value="{{$pantau->tingkat_risiko1}}" readonly="true">
            </div>

        </div>

        <div class="form-group  @if($errors->has('deviasi')) has-error @endif">
          <label for="deviasi" class="col-sm-2 control-label"> Deviasi</label>
            <div class="col-sm-1">
              <input id="deviasi" type="text"  readonly="true" class="form-control" name="deviasi" value="{{$pantau->deviasi}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('deviasi')}}</span>
            </div>
        </div>

        <div class="form-group @if($errors->has('rtp')) has-error @endif"">
          <label for="rtp" class="col-sm-2 control-label">Pelaksanaan RTP</label>
          <div class="col-sm-2">
            <select class="form-control" name="rtp" id="rtp">
              @foreach($rtp as $per)
              <option value="{{$per}}" {{$pantau->rtp == $per ? 'selected' : ''}}>{{$per}}</option>
              @endforeach
            </select>
            <span id="helpBlock2" class="help-block">{{$errors->first('rtp')}}</span>
          </div>
        </div>

        <div class="form-group  @if($errors->has('rekomendasi')) has-error @endif">
          <label for="rekomendasi" class="col-sm-2 control-label"> Rekomendasi</label>
            <div class="col-sm-10">
              <textarea id="rekomendasi" type="text"  class="form-control" name="rekomendasi" value="{{$pantau->rekomendasi}}"></textarea>
              <span id="helpBlock2" class="help-block">{{$errors->first('rekomendasi')}}</span>
            </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">

            <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-save"></i>
Simpan </button>
            <a href="{{route('pantaupemda')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a>
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

        $('#kemungkinan_id').on('change', function() {
          $('#txt_kemungkinan').val($("#kemungkinan_id option:selected").val());

          $('#tingkat_risiko').val($('#dampak_id option:selected').val() * $('#kemungkinan_id option:selected').val());
          $('#deviasi').val($('#tingkat_risiko').val() - $('#tingkat_risiko1').val());
        });

        $('#dampak_id').on('change', function() {
          $('#txt_dampak').val($("#dampak_id option:selected").val());

          $('#tingkat_risiko').val($('#dampak option:selected').val() * $('#kemungkinan_id option:selected').val());
        });

  });
  </script>
@endpush
