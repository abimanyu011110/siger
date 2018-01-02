<?php

namespace App\Http\Controllers\opdkegiatan2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use Auth;
use App\Models\adminpemda\OPD;
use PDF;
use App\Models\opdkegiatan2\PantauKegiatan;
use App\Models\adminpemda\Pemda;

class PemantauanKegiatan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $rtpkegiatan = DB::table('rtp_kegiatan')
              ->select('rtp_kegiatan.id as id',
              'kegiatan_opd.nama_kegiatan as nama_kegiatan',
              'tbl_baganrisiko.nama_risiko as nama_risiko',
              'rtp_kegiatan.rtp_tambah as rtp_tambah',
              'rtp_kegiatan.kemungkinan_id as kemungkinan_id',
              'rtp_kegiatan.dampak_id as dampak_id', 'rtp_kegiatan.tingkat_risiko as tingkat_risiko_rtp',
              'rtp_kegiatan.opsi as opsi', 'pemantauan_kegiatan.tingkat_risiko as tingkat_risiko')

              ->join('analisis_kegiatan', 'rtp_kegiatan.analisis_id', '=', 'analisis_kegiatan.id')
              ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', '=', 'identifikasi_kegiatan.id')
              ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', 'kegiatan_opd.id')
              ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', 'tbl_baganrisiko.id')
              ->join('pemantauan_kegiatan', 'rtp_kegiatan.id','pemantauan_kegiatan.rtpkegiatan_id' )
              ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
              ->get();
        return view('opdkegiatan2.pemantauankegiatan2.index',compact('rtpkegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idp)
    {
        //
        $kegiatan = DB::table('rtp_kegiatan')->where('id', $idp)->first();
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        $rtp = ['Ya', 'Tidak'];
        return view('opdkegiatan2.pemantauankegiatan2.create', compact('kegiatan', 'kemungkinan', 'dampak', 'rtp'));
    }

    public function transaksi()
     {
         $dt = DB::table('pemantauan_kegiatan')
                ->select('pemantauan_kegiatan.id as id', 'kegiatan_opd.nama_kegiatan as nama_kegiatan',
                'tbl_baganrisiko.nama_risiko as nama_risiko', 'rtp_kegiatan.tingkat_risiko as tingkat_risiko_rtp', 'rtp_kegiatan.rtp_tambah as rtp_tambah', 
                'pemantauan_kegiatan.tingkat_risiko as tingkat_risiko', 'pemantauan_kegiatan.deviasi as deviasi', 'pemantauan_kegiatan.rtp as rtp', 'pemantauan_kegiatan.rekomendasi as rekomendasi')
                ->join('rtp_kegiatan', 'pemantauan_kegiatan.rtpkegiatan_id', 'rtp_kegiatan.id')
                ->join('analisis_kegiatan', 'rtp_kegiatan.analisis_id', 'analisis_kegiatan.id')
                ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', 'identifikasi_kegiatan.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', 'kegiatan_opd.id')
                ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', 'tbl_baganrisiko.id')
                ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                ->get();
        return view('opdkegiatan2.pemantauankegiatan2.transaksi',compact('dt'));
    }

    public function cetakPantau()
    {
      $cetak = DB::table('pemantauan_kegiatan')
        ->select(
          'pemantauan_kegiatan.id as id', 
          'kegiatan_opd.nama_kegiatan as nama_kegiatan', 
          'tbl_baganrisiko.nama_risiko as nama_risiko', 
          'rtp_kegiatan.rtp_tambah as rtp_tambah', 
          'rtp_kegiatan.tingkat_risiko as tingkat_risiko_rtp', 
          'pemantauan_kegiatan.tingkat_risiko as tingkat_risiko', 
          'pemantauan_kegiatan.deviasi as deviasi', 
          'pemantauan_kegiatan.rtp as rtp', 
          'pemantauan_kegiatan.rekomendasi as rekomendasi')
        ->join('rtp_kegiatan', 'rtp_kegiatan.id', 'pemantauan_kegiatan.rtpkegiatan_id')
        ->join('analisis_kegiatan', 'analisis_kegiatan.id', 'rtp_kegiatan.analisis_id')
        ->join('identifikasi_kegiatan', 'identifikasi_kegiatan.id', 'analisis_kegiatan.identifikasi_id')
        ->join('kegiatan_opd', 'kegiatan_opd.id', 'identifikasi_kegiatan.kegiatan_id')
        ->join('tbl_baganrisiko', 'tbl_baganrisiko.id', 'identifikasi_kegiatan.risiko_id')
        ->get();

      $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
      $nama_pemda = Pemda::where('id', 1)->first();
      $pdf = PDF::loadView('opdkegiatan2.pemantauankegiatan2.cetakPantau',  compact('cetak', 'nama', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Pemantauan.pdf', array('Attachment' => false));
        exit(0);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $srt = new PantauKegiatan();
      $srt->rtpkegiatan_id = $request['rtpkegiatan_id'];
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->deviasi = $request['deviasi'];
      $srt->rtp = $request['rtp'];
      $srt->rekomendasi = $request['rekomendasi'];
      $srt->save();
      return redirect()->route('pantaukegiatan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pantau = PantauKegiatan::find($id);
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        $rtp = ['Ya', 'Tidak'];
        return view('opdkegiatan2.pemantauankegiatan2.edit', compact('kemungkinan', 'dampak', 'pantau', 'rtp', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $srt = PantauKegiatan::find($id);
      $srt->rtpkegiatan_id = $request['rtpkegiatan_id'];
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->deviasi = $request['deviasi'];
      $srt->rtp = $request['rtp'];
      $srt->rekomendasi = $request['rekomendasi'];
      $srt->update();
      return redirect()->route('pantaukegiatan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $a = PantauKegiatan::find($id);
        $a->delete();
        return redirect()->route('pemantauankegiatan2.index');
    }

}