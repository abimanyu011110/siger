@extends('layout.index')

@section('isi')

  <form class="form-horizontal" action="{{url('/userpemda1/analisispemda1', $analisis->id)}}" method="POST">
    {!! csrf_field() !!}

    {{ method_field('PUT') }}
  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data Analisis</h4>
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
                <option value="{{$key}}" {{$analisis->dampak_id == $key ? 'selected' : ''}}>{{$value}}</option>
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
                <option value="{{$key}}" {{$analisis->kemungkinan_id == $key ? 'selected' : ''}}>{{$value}}</option>

              @endforeach
            </select>
          </div>

        </div>

        <div class="form-group  @if($errors->has('tingkat_risiko')) has-error @endif">
          <label for="tingkat_risiko" class="col-sm-2 control-label"> Tingkat Risiko</label>
            <div class="col-sm-1">
              <input id="tingkat_risiko" type="text"  readonly="true" class="form-control" name="tingkat_risiko" value="{{$analisis->tingkat_risiko}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('tingkat_risiko')}}</span>
            </div>
            <div class="col-sm-6">
              <label class="col-sm-8"><font color="red">Keterangan :</font></label>
              <label class="col-sm-8">* Ekstrem  &emsp; &emsp; &emsp; &nbsp;: &nbsp; 20 - 25</label>
              <label class="col-sm-8">* Tinggi &emsp; &emsp; &emsp; &emsp; : &nbsp; 12 - 19,9</label>
              <label class="col-sm-8">* Moderate &emsp;&emsp;&emsp;&nbsp;: &emsp; 8 - 11,9</label>
              <label class="col-sm-8">* Rendah &emsp; &emsp; &emsp; &nbsp; : &emsp; 4 - 7,9</label>
              <label class="col-sm-8">* Tidak Signifikan &nbsp; : &emsp; 0 - 3,9</label>
              </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">

              <button type="submit" class="btn btn-primary btn-sm">Simpan </button>
            <a href="{{route('transaksipemda')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a>
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

        $('#dampak_id').on('change', function() {
          $('#txt_dampak').val($("#dampak_id option:selected").val());

          $('#tingkat_risiko').val($('#dampak option:selected').val() * $('#kemungkinan_id option:selected').val());
        });

        $('#kemungkinan_id').on('change', function() {
          $('#txt_kemungkinan').val($("#kemungkinan_id option:selected").val());

          $('#tingkat_risiko').val($('#dampak_id option:selected').val() * $('#kemungkinan_id option:selected').val());
        });
  });
  </script>
@endpush
