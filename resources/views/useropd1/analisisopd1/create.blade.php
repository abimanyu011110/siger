@extends('layout.index')

@section('isi')

  <form class="form-horizontal" action="{{url('useropd1/analisisopd1')}}" method="POST">
    {!! csrf_field() !!}

    {{ method_field('POST') }}
  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Tambah Data Analisis</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">

        <input type="hidden" name="identifikasi_id" value="{{ $kegiatan->id }}">

        <div class="form-group">
          <label for="dampak" class="col-sm-2 control-label"> Nilai Dampak</label>
          <div class="col-sm-1">
            <input type="text" name="txt_dampak" id="txt_dampak" class="form-control" disabled>
          </div>
          <div class="col-sm-3">
            <select class="form-control" id="dampak_id" name="dampak_id">

              @foreach($dampak as $key => $value)
                <option value="{{$key}}" {{old('dampak_id') == $key ? 'selected' : ''}}>{{$value}}</option>
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
                <option value="{{$key}}" {{old('kemungkinan_id') == $key ? 'selected' : ''}}>{{$value}}</option>

              @endforeach
            </select>
          </div>

        </div>

        <div class="form-group  @if($errors->has('tingkat_risiko')) has-error @endif">
          <label for="tingkat_risiko" class="col-sm-2 control-label"> Tingkat Risiko</label>
            <div class="col-sm-1">
              <input id="tingkat_risiko" type="text"  readonly="true" class="form-control" name="tingkat_risiko" value="{{old('tingkat_risiko')}}">
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

              <button type="submit" class="btn btn-primary">Simpan </button>
            <a href="{{route('transaksiopd')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-12">
    <table class="table table-bordered">

    <tr>
      <caption><h3>Referensi Kriteria Dampak</h3></caption>
      <th rowspan="2">Level Dampak</th>
      <th colspan="7" style="text-align: center;">Area Dampak</th>
    </tr>
    <tr>
      <th>Kerugian/ Kejadian Penyimpangan</th>
      <th>Publikasi Negatif</th>
      <th>Kerusakan Lingkungan</th>
      <th>Hambatan Pencapaian Sasaran Strategis</th>
      <th>Gangguan Pencapaian Kinerja</th>
      <th>Pelaporan Keuangan</th>
      <th>Ketidakpatuhan/ Tuntutan Hukum</th>
    </tr>
    <tr>
        <th scope="row">Tidak Signifikan</th>
        <td>Jumlah kerugian ≤ Rp10 Juta atau Jumlah penyimpangan ≤ 5 kali dalam satu tahun</td>
        <td>Munculnya publikasi negatif di lingkungan internal Pemerintah Provinsi Lampung atau OPD</td>
        <td>Areal Kerusakan Lingkungan setara dengan luas satu desa</td>
        <td>Terdapat hambatan terhadap pencapaian 1 IKU dalam 1 </td>
        <td>Pencapaian target kinerja ≥ 100% </td>
        <td>Seluruh koreksi atas ketidaksesuaian  akuntansi dapat diselesaikan</td>
        <td>Jumlah tuntutan hukum atau temuan ketidakpatuhan dari lembaga berwenang ≤ 5 kali dalam satu periode</td>
    </tr>
    <tr>
      <th scope="row">Kecil</th>
      <td>Jumlah kerugian lebih dari Rp10 Juta s.d Rp50 Juta atau jumlah penyimpangan di atas 5 kali s.d 15 kali dalam satu tahun</td>
      <td>Munculnya publikasi negatif di Media Lokal Kabupaten</td>
      <td>Areal Kerusakan Lingkungan setara dengan luas satu kecamatan</td>
      <td>Terdapat hambatan terhadap pencapaian lebih dari 1 IKU dalam 1 sasaran strategis</td>
      <td>Pencapaian target kinerja di atas 80% s.d 100% </td>
      <td>Seluruh koreksi atas ketidaksesuaian  akuntansi dapat diselesaikan</td>
      <td>Jumlah tuntutan hukum atau temuan ketidakpatuhan dari lembaga berwenang di atas 5 kali s.d 15 kali dalam satu periode</td>
    </tr>
    <tr>
      <th scope="row">Menengah</th>
      <td>Jumlah kerugian lebih dari Rp50 Juta s.d Rp100 Juta atau jumlah penyimpangan di atas 15 kali s.d 30 kali dalam satu periode</td>
      <td>Pemberitaan negatif di media massa lokal Provinsi</td>
      <td>Areal Kerusakan Lingkungan setara dengan luas satu kabupaten</td>
      <td>Terdapat hambatan terhadap pencapaian lebih dari 1 IKU dalam 2 sasaran strategis</td>
      <td>Pencapaian target kinerja di atas 50% s.d 80% </td>
      <td>Pelayanan tertunda di atas 5 hari s.d 15 hari</td>
      <td>Jumlah tuntutan hukum atau temuan ketidakpatuhan dari lembaga berwenang di atas 15 kali s.d 30 kali dalam satu periode</td>
    </tr>
    <tr>
      <th scope="row">Tinggi</th>
      <td>Jumlah kerugiann negara lebih dari Rp100 Juta s.d Rp500 Juta atau jumlah penyimpangan di atas 30 kali s.d 50 kali dalam satu tahun</td>
      <td>Pemberitaan negatif di media massa nasional</td>
      <td>Areal Kerusakan Lingkungan setara dengan luas satu provinsi</td>
      <td>Terdapat hambatan terhadap pencapaian lebih dari 1 IKU dalam 3 sasaran strategis</td>
      <td>Pencapaian target kinerja di atas 25% s.d 50% </td>
      <td>Pelayanan tertunda di atas 15 hari s.d 30 hari</td>
      <td>Jumlah tuntutan hukum atau temuan ketidakpatuhan dari lembaga berwenang di atas 30 kali s.d 50 kali dalam satu periode</td>
    </tr>
    <tr>
      <th scope="row">Sangat Tinggi</th>
      <td>Jumlah kerugian lebih dari Rp500 Juta atau jumlah penyimpangan lebih dari 50 kali dalam satu tahun</td>
      <td>Pemberitaan negatif di media massa lokal dan nasional</td>
      <td>Areal Kerusakan Lingkungan setara dengan luas lebih dari satu provinsi</td>
      <td>Terdapat hambatan terhadap pencapaian lebih dari 1 IKU dalam lebih dari 3 sasaran strategis</td>
      <td>Pencapaian target kinerja ≤ 25% </td>
      <td>Pelayanan tertunda lebih dari 30 hari</td>
      <td>Jumlah tuntutan hukum atau temuan ketidakpatuhan dari lembaga berwenang lebih dari 50 kali dalam satu periode</td>
    </tr>

    </table>
    </div>

  <div class="col-sm-12">
  <table class="table table-bordered">
      <caption><h3>Referensi Kriteria Kemungkinan</h3></caption>
      <thead>
        <tr>
          <th width="5%">No.</th>
          <th width="35%">Level Kemungkinan</th>
          <th width="60%">Kriteria Kemungkinan</th>
        </tr>
      </thead>
        <tr>
          <td align="center">1</td>
          <td>Sangat Jarang Terjadi</td>
          <td>
          > Kemungkinan terjadinya sangat jarang (kurang dari 2 kali dalam 5 tahun)<br>
          > Persentase kemungkinan terjadinya kurang dari 5% dari volume transaksi dalam 1 periode
          </td>
        </tr>
        <tr>
          <td align="center">2</td>
          <td>Jarang Terjadi</td>
          <td>
          > Kemungkinan terjadinya jarang (2 kali s.d 10 kali dalam 5 tahun)<br>
          > Persentase kemungkinan terjadinya 5% s.d 10% dari volume transaksi dalam 1 periode
          </td>
        </tr>
        <tr>
          <td align="center">3</td>
          <td>Kadang Terjadi</td>
          <td>
          > Kemungkinan terjadinya cukup sering (di atas 10 kali s.d 18 kali dalam 5 tahun)<br>
          > Persentase kemungkinan terjadinya di atas 10% s.d 20% dari volume transaksi dalam 1 periode
          </td>
        </tr>
        <tr>
          <td align="center">4</td>
          <td>Sering Terjadi</td>
          <td>
          > Kemungkinan terjadinya sering (di atas 18 kali s.d 26 kali dalam 5 tahun)<br>
          > Persentase kemungkinan terjadinya di atas 20% s.d 50% dari volume transaksi dalam 1 periode
          </td>
        </tr>
        <tr>
          <td align="center">5</td>
          <td>Hampir Pasti Terjadi</td>
          <td>
          > Kemungkinan terjadinya sangat sering (di atas 26 kali dalam 5 tahun)<br>
          > Persentase kemungkinan terjadinya lebih dari 50% dari volume transaksi dalam 1 periode
          </td>
        </tr>
    </table>
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
