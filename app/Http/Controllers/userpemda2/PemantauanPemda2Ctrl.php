<?php

namespace App\Http\Controllers\userpemda2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;
use App\Models\userpemda2\PantauPemda;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use App\Models\adminpemda\Pemda;

class PemantauanPemda2Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dt = DB::table('rtp_pemda')
              ->select('rtp_pemda.id as id',
              'sasaran_pemda.nama_sasaran as nama_sasaran',
              'tbl_baganrisiko.nama_risiko as nama_risiko',
              'rtp_pemda.rtp_tambah as rtp_tambah',
              'rtp_pemda.kemungkinan_id as kemungkinan_id',
              'rtp_pemda.dampak_id as dampak_id', 'rtp_pemda.tingkat_risiko as tingkat_risiko_rtp',
              'rtp_pemda.opsi as opsi', 'pemantauan_pemda.tingkat_risiko as tingkat_risiko')

              ->leftjoin('pemantauan_pemda', 'rtp_pemda.id','pemantauan_pemda.rtpopd_id' )
              ->join('analisis_pemda', 'rtp_pemda.analisis_id', '=', 'analisis_pemda.id')
              ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', '=', 'identifikasi_pemda.id')
              ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', '=', 'sasaran_pemda.id')
              ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', '=', 'tbl_baganrisiko.id')
              ->where('rtp_pemda.opsi','Ya')
              ->get();
        return view('userpemda2.pemantauanpemda2.index', compact('dt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idp)
    {
        //
        $dt = DB::table('rtp_pemda')->where('id', $idp)->first();
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        $rtp = ['Ya', 'Tidak'];
        return view('userpemda2.pemantauanpemda2.create', compact('dt', 'kemungkinan', 'dampak', 'rtp'));
    }

    public function transaksi()
     {
         $dt = DB::table('pemantauan_pemda')
                ->select('pemantauan_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran',
                'tbl_baganrisiko.nama_risiko as nama_risiko', 'rtp_pemda.tingkat_risiko as tingkat_risiko_rtp', 'rtp_pemda.rtp_tambah as rtp_tambah',
                'pemantauan_pemda.tingkat_risiko as tingkat_risiko', 'pemantauan_pemda.deviasi as deviasi', 'pemantauan_pemda.rtp as rtp', 'pemantauan_pemda.rekomendasi as rekomendasi')
                ->join('rtp_pemda', 'pemantauan_pemda.rtpopd_id', 'rtp_pemda.id')
                ->join('analisis_pemda', 'rtp_pemda.analisis_id', 'analisis_pemda.id')
                ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', 'identifikasi_pemda.id')
                ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', 'sasaran_pemda.id')
                ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', 'tbl_baganrisiko.id')
                ->get();
        return view('userpemda2.pemantauanpemda2.transaksi',compact('dt'));
    }

    public function cetakPantau()
    {
      $cetak = DB::table('pemantauan_pemda')
        ->select('pemantauan_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'rtp_pemda.rtp_tambah as rtp_tambah', 'rtp_pemda.tingkat_risiko as tingkat_risiko_rtp', 'pemantauan_pemda.tingkat_risiko as tingkat_risiko', 'pemantauan_pemda.deviasi as deviasi', 'pemantauan_pemda.rtp as rtp', 'pemantauan_pemda.rekomendasi as rekomendasi')
        ->join('rtp_pemda', 'rtp_pemda.id', 'pemantauan_pemda.rtpopd_id')
        ->join('analisis_pemda', 'analisis_pemda.id', 'rtp_pemda.analisis_id')
        ->join('identifikasi_pemda', 'identifikasi_pemda.id', 'analisis_pemda.identifikasi_id')
        ->join('sasaran_pemda', 'sasaran_pemda.id', 'identifikasi_pemda.sasaran_id')
        ->join('tbl_baganrisiko', 'tbl_baganrisiko.id', 'identifikasi_pemda.risiko_id')
        ->get();

        $nama_pemda = Pemda::where('id', 1)->first();
      $pdf = PDF::loadView('userpemda2.pemantauanpemda2.cetak',  compact('cetak', 'nama_pemda'));
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
        //
        $srt = new PantauPemda();
      $srt->rtpopd_id = $request['rtpopd_id'];
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->deviasi = $request['deviasi'];
      $srt->rtp = $request['rtp'];
      $srt->rekomendasi = $request['rekomendasi'];
      $srt->save();
      return redirect()->route('pantaupemda');
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
        $pantau = PantauPemda::find($id);
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        $rtp = ['Ya', 'Tidak'];
        return view('userpemda2.pemantauanpemda2.edit', compact('kemungkinan', 'dampak', 'pantau', 'rtp'));
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
        $srt = PantauPemda::find($id);
      $srt->rtpopd_id = $request['rtpopd_id'];
      $srt->kemungkinan_id = $request['kemungkinan_id'];
      $srt->dampak_id = $request['dampak_id'];
      $srt->tingkat_risiko = $request['tingkat_risiko'];
      $srt->deviasi = $request['deviasi'];
      $srt->rtp = $request['rtp'];
      $srt->rekomendasi = $request['rekomendasi'];
      $srt->update();
      return redirect()->route('pantaupemda');
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
        $a = PantauPemda::find($id);
        $a->delete();
        return redirect()->route('pemantauankegiatan2.index');
    }
}
