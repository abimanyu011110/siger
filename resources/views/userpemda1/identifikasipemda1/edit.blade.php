@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Identifikasi Risiko</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('identifikasipemda1.update', $identifikasi->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="identifikasi_id" value="{{$identifikasi->id}}">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="misi_id" class="col-sm-2 control-label">Pilih Misi</label>
          <div class="col-sm-10">
            <select name="misi_id" class="form-control" id="misi_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($misi as $key => $value)
                <option value="{{$key}}" {{$identifikasi->misi_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
            <label for="tujuan_id" class="col-sm-2 control-label">Pilih Tujuan</label>
              <div class="col-sm-10">
                <select name="tujuan_id" class="form-control" id="tujuan_id">
                <option value="">-- Pilih Tujuan --</option>
                </select>
              </div>
        </div>

        <div class="form-group">
            <label for="sasaran_id" class="col-sm-2 control-label">Pilih Sasaran</label>
              <div class="col-sm-10">
                <select name="sasaran_id" class="form-control" id="sasaran_id">
                <option value="0" disabled="true" selected="true"></option>
                <option value="">-- Pilih Sasaran --</option>
                </select>
              </div>
        </div>

        <div class="form-group @if($errors->has('periode')) has-error @endif"">
          <label for="periode" class="col-sm-2 control-label">Periode</label>
          <div class="col-sm-2">
            <select class="form-control" name="periode" id="periode">
              @foreach($periode as $per)
              <option value="{{$per}}" {{$identifikasi->periode == $per ? 'selected' : ''}}>{{$per}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="risiko_id" class="col-sm-2 control-label"> Risiko</label>
          <div class="col-sm-10">
            <select class="risiko_id form-control" name="risiko_id"></select>
          </div>
        </div>
  
        <div class="form-group  @if($errors->has('uraian')) has-error @endif"">
          <label for="uraian" class="col-sm-2 control-label">Uraian</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="uraian" value="{{$identifikasi->uraian}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('uraian')}}</span>
            </div>
        </div>

        <div class="form-group @if($errors->has('sumber_risiko')) has-error @endif"">
          <label for="sumber_risiko" class="col-sm-2 control-label">Sumber Risiko</label>
          <div class="col-sm-2">
            <select class="form-control" name="sumber_risiko" id="sumber_risiko">
              @foreach($sumber_risiko as $key)
              <option value="{{$key}}" {{$identifikasi->sumber_risiko == $key ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group @if($errors->has('kontrol')) has-error @endif"">
          <label for="kontrol" class="col-sm-2 control-label">Kontrol</label>
          <div class="col-sm-2">
            <select class="form-control" name="kontrol" id="kontrol">
              @foreach($kontrol as $key)
              <option value="{{$key}}" {{$identifikasi->kontrol == $key ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group  @if($errors->has('penyebab')) has-error @endif"">
          <label for="penyebab" class="col-sm-2 control-label">Penyebab</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="penyebab" value="{{$identifikasi->penyebab}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('penyebab')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('dampak')) has-error @endif"">
          <label for="dampak" class="col-sm-2 control-label">Dampak Negatif</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="dampak" value="{{$identifikasi->dampak}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('dampak')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('pengendalian')) has-error @endif"">
          <label for="penyebab" class="col-sm-2 control-label">Pengendalian yang ada</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pengendalian" value="{{$identifikasi->pengendalian}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('pengendalian')}}</span>
            </div>
        </div>

        <div class="form-group @if($errors->has('sisa_risiko')) has-error @endif"">
          <label for="sisa_risiko" class="col-sm-2 control-label">Sisa Risiko</label>
          <div class="col-sm-2">
            <select class="form-control" name="sisa_risiko" id="sisa_risiko">
              @foreach($sisa_risiko as $key)
              <option value="{{$key}}" {{$identifikasi->sisa_risiko == $key ? 'selected' : ''}}>{{$key}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="space-4"></div>
        <div class="clearfix">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="{{route('identifikasikegiatan1.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
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
        $('#misi_id').on('change', function() {
            var misiId = $(this).val();
            if(misiId) {
                $.ajax({
                    url: '/identifikasipemda1/pilihTujuan/'+misiId,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        console.log(data);
                        $('select[name="tujuan_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="tujuan_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="tujuan_id"]').empty();
            }
        });

        $('#tujuan_id').on('click', function() {
            var tujuanId = $(this).val();
            if(tujuanId) {
                $.ajax({
                    url: '/identifikasipemda1/pilihSasaran/'+tujuanId,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        console.log(data);
                        $('select[name="sasaran_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="sasaran_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="sasaran_id"]').empty();
            }
        });

        $('.risiko_id').select2({
        placeholder: 'Pilih Risiko',
        ajax: {
          url: '/identifikasipemda1/pilihRisiko',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nama_risiko,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });
        
  });
  </script>

@endpush