@extends('layout.index')
@section('isi')

	<div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Mapping</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('mapping.update', $mapping->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
            {!! csrf_field() !!}

        <div class="form-group">
          <label for="sasaranpemda_id" class="col-sm-2 control-label">Sasaran Pemda</label>
          <div class="col-sm-10">
            <select class="sasaranpemda_id form-control" name="sasaranpemda_id"></select>
          </div>
        </div>

        <div class="form-group">
          <label for="opd_id" class="col-sm-2 control-label">Pilih OPD</label>
          <div class="col-sm-10">
            <select name="opd_id" class="form-control" id="opd_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($opd as $key => $value)
                <option value="{{$key}}" {{$mapping->opd_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
            <label for="sasaranopd_id" class="col-sm-2 control-label">Sasaran OPD</label>
              <div class="col-sm-10">
                <select name="sasaranopd_id" class="form-control" id="sasaranopd_id">
                <option value="0" disabled="true" selected="true"></option>
                <option value=" ">-- Pilih Sasaran --</option>
                </select>
              </div>
        </div>

        <div class="form-group  @if($errors->has('bobot')) has-error @endif"">
          <label for="bobot" class="col-sm-2 control-label">Bobot</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="bobot" value="{{$mapping->bobot}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('bobot')}}</span>
            </div>
        </div>
        
        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary btn-sm" value="Simpan">
            <a href="{{route('mapping.index')}}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Batal</a>
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

    $('.sasaranpemda_id').select2({
        placeholder: 'Select an item',
        ajax: {
          url: '/mapping/cariSasaran',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nama_sasaran,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });

    $('#opd_id').on('change', function() {
      var OpdId = $(this).val();
      if(OpdId) {
                $.ajax({
                    url: '/adminpemda/pilihSasaranOpd/'+OpdId,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                      console.log(data);
                        $('select[name="sasaranopd_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="sasaranopd_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="sasaranopd_id"]').empty();
            }
        });

  });
</script>

@endpush