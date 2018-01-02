@extends('layout.index')

@section('isi')


  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data OPD</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('opd.update', $opd->id)}}" method="post">
          <input type="hidden" name="_method" value="put">
          <input type="hidden" name="opd_id" value="{{$opd->id}}">
            {!! csrf_field() !!}
          <div class="form-group">
            <label for="urusan_id" class="col-sm-2 control-label">Pilih Urusan</label>
              <div class="col-sm-4">
                <select name="urusan_id" class="form-control" id="urusan_id">
                <option value="0" disabled="true" selected="true"></option>
              @foreach($urusan as $key => $value)
                <option value="{{$key}}" {{$opd->urusan_id == $key ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
                </select>
              </div>
          </div>

          <div class="form-group">
            <label for="bidang_id" class="col-sm-2 control-label">Pilih Bidang</label>
              <div class="col-sm-6">
                <select name="bidang_id" class="form-control" id="bidang_id">
                <option value="0" disabled="true" selected="true"></option>
                <option value="">-- Pilih Bidang --</option>
                </select>
              </div>
        </div>

        <div class="form-group  @if($errors->has('nama_opd')) has-error @endif"">
          <label for="nama_opd" class="col-sm-2 control-label">Nama OPD</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="nama_opd" value="{{$opd->nama_opd}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama_opd')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('kepala_opd')) has-error @endif"">
          <label for="kepala_opd" class="col-sm-2 control-label">Kepala OPD</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="kepala_opd" value="{{$opd->kepala_opd}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('kepala_opd')}}</span>
            </div>
        </div>

        <div class="form-group  @if($errors->has('jabatan')) has-error @endif"">
          <label for="jabatan" class="col-sm-2 control-label">Jabatan</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" name="jabatan" value="{{$opd->jabatan}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('jabatan')}}</span>
            </div>
        </div>

        
        <div class="space-4"></div>
        <div class="clearfix">
      <div class="pull-right">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <a href="{{route('opd.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
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
        $('#urusan_id').on('change', function() {
            var urusanID = $(this).val();
            if(urusanID) {
                $.ajax({
                    url: '/opd/pilihBidang/'+urusanID,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        console.log(data);
                        $('select[name="bidang_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="bidang_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            } else {
                $('select[name="bidang_id"]').empty();
            }
        });
    });
</script>

@endpush