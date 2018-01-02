<?php

namespace App\Http\Controllers\useropd2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use App\Models\useropd2\PemantauanOpd2;
use App\Models\adminpemda\OPD;
use PDF;
use App\Models\adminpemda\Pemda;

class PemantauanOpd2Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rtp = DB::table('rtp_opd')
              ->select('rtp_opd.id as id',
              'sasaran_opd.nama_sasaran as nama_sasaran',
              'tbl_baganrisiko.nama_risiko as nama_risiko',
              'rtp_opd.rtp_tambah as rtp_tambah',
              'rtp_opd.kemungkinan_id as kemungkinan_id',
              'rtp_opd.dampak_id as dampak_id', 'rtp_opd.tingkat_risiko as tingkat_risiko_rtp',
              'rtp_opd.opsi as opsi', 'pemantauan_opd.tingkat_risiko as tingkat_risiko')

              ->leftjoin('pemantauan_opd', 'rtp_opd.id','pemantauan_opd.rtpopd_id' )
              ->join('analisis_opd', 'rtp_opd.analisis_id', '=', 'analisis_opd.id')
              ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', '=', 'identifikasi_opd.id')
              ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
              ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', '=', 'tbl_baganrisiko.id')
              ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
              ->where('rtp_opd.opsi','Ya')
              ->get();
        return view('useropd2.pemantauanopd2.index',compact('rtp'));
    }

    public function transaksi()
     {
         $dt = DB::table('pemantauan_opd')
                ->select('pemantauan_opd.id as id', 'sasaran_opd.nama_sasaran as nama_sasaran',
                'tbl_baganrisiko.nama_risiko as nama_risiko', 'rtp_opd.rtp_tambah as rtp_tambah', 'rtp_opd.tingkat_risiko as tingkat_risiko_rtp',
                'pemantauan_opd.tingkat_risiko as tingkat_risiko', 'pemantauan_opd.deviasi as deviasi', 'pemantauan_opd.rtp as rtp', 
                'pemantauan_opd.rekomendasi as rekomendasi')
                ->join('rtp_opd', 'pemantauan_opd.rtpopd_id', 'rtp_opd.id')
                ->join('analisis_opd', 'rtp_opd.analisis_id', 'analisis_opd.id')
                ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', 'identifikasi_opd.id')
                ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', 'sasaran_opd.id')
                ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', 'tbl_baganrisiko.id')
                ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
                ->get();
        return view('useropd2.pemantauanopd2.transaksi',compact('dt'));
    }

    public function cetakPantau()
    {
      $cetak = DB::table('pemantauan_opd')
        ->select('pemantauan_opd.id as id', 'sasaran_opd.nama_sasaran as nama_sasaran', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'rtp_opd.rtp_tambah as rtp_tambah', 'rtp_opd.tingkat_risiko as tingkat_risiko_rtp', 'pemantauan_opd.tingkat_risiko as tingkat_risiko', 'pemantauan_opd.deviasi as deviasi', 'pemantauan_opd.rtp as rtp', 'pemantauan_opd.rekomendasi as rekomendasi')
        ->join('rtp_opd', 'rtp_opd.id', 'pemantauan_opd.rtpopd_id')
        ->join('analisis_opd', 'analisis_opd.id', 'rtp_opd.analisis_id')
        ->join('identifikasi_opd', 'identifikasi_opd.id', 'analisis_opd.identifikasi_id')
        ->join('sasaran_opd', 'sasaran_opd.id', 'identifikasi_opd.sasaran_id')
        ->join('tbl_baganrisiko', 'tbl_baganrisiko.id', 'identifikasi_opd.risiko_id')
        ->get();

      $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
      $nama_pemda = Pemda::where('id', 1)->first();
      $pdf = PDF::loadView('useropd2.pemantauanopd2.cetakPantau',  compact('cetak', 'nama', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Pemantauan_Opd.pdf', array('Attachment' => false));
        exit(0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idp)
    {
        //
        $kegiatan = DB::table('rtp_opd')->where('id', $idp)->first();
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        $rtp = ['Ya', 'Tidak'];
        return view('useropd2.pemantauanopd2.create', compact('kegiatan', 'kemungkinan', 'dampak', 'rtp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $srt = new PemantauanOpd2();
      $srt->rtpopd_id = $request['rtpopd_id'];
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->deviasi = $request['deviasi'];
      $srt->rtp = $request['rtp'];
      $srt->rekomendasi = $request['rekomendasi'];
      $srt->save();
      return redirect()->route('pantauopd');
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
        $pantau = PemantauanOpd2::find($id);
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        $rtp = ['Ya', 'Tidak'];
        return view('useropd2.pemantauanopd2.edit', compact('kemungkinan', 'dampak', 'pantau', 'rtp'));
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
        $srt = PemantauanOpd2::find($id);
      $srt->rtpopd_id = $request['rtpopd_id'];
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->deviasi = $request['deviasi'];
      $srt->rtp = $request['rtp'];
      $srt->rekomendasi = $request['rekomendasi'];
      $srt->update();
      return redirect()->route('pantauopd');
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
        $a = PemantauanOpd2::find($id);
        $a->delete();
        return redirect()->route('pemantauanopd2.index');
    }
}
