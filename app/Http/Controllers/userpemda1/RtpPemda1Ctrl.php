<?php

namespace App\Http\Controllers\userpemda1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\userpemda1\RtpPemda;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use PDF;
use App\Models\adminpemda\Pemda;

class RtpPemda1Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rtp = DB::table('analisis_pemda')
              ->select('analisis_pemda.id',
              'tbl_baganrisiko.nama_risiko', 'analisis_pemda.tingkat_risiko',
              'sasaran_pemda.nama_sasaran',
              'tbl_kategori.selera_risiko', 'rtp_pemda.tingkat_risiko as tingkat_risiko_rtp')
              ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', 'identifikasi_pemda.id')
              ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', '=', 'sasaran_pemda.id')
              ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', 'tbl_baganrisiko.id')
              ->join('tbl_kategori', 'tbl_baganrisiko.kategori_id', 'tbl_kategori.id')
              ->leftjoin('rtp_pemda', 'analisis_pemda.id', 'rtp_pemda.analisis_id')
              ->whereColumn('analisis_pemda.tingkat_risiko', '>=', 'tbl_kategori.selera_risiko')
              ->get();
      return view('userpemda1.rtppemda1.index', compact('rtp'));
    }

    public function create($id)
    {
      $this->data['dt'] = DB::table('analisis_pemda')->where('id', $id)->first();
      $this->data['jadwal'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      $this->data['kemungkinan'] = Kemungkinan::pluck('nama_kemungkinan', 'id');
      $this->data['dampak'] = Dampak::pluck('nama_dampak', 'id');
      $this->data['opsi'] = ['Ya', 'Tidak'];
      return view('userpemda1.rtppemda1.create', $this->data);
    }

    public function transaksiRTP()
    {
      $rtp = DB::table('rtp_pemda')
            ->select('rtp_pemda.id as id','sasaran_pemda.nama_sasaran as nama_sasaran', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'analisis_pemda.tingkat_risiko as tingkat_risiko_analisis', 'rtp_pemda.rtp_tambah as rtp_tambah', 'rtp_pemda.jadwal as jadwal', 'rtp_pemda.penanggungjawab as penanggungjawab', 'rtp_pemda.tingkat_risiko as tingkat_risiko_rtp', 'rtp_pemda.opsi as opsi')

            ->join('analisis_pemda', 'rtp_pemda.analisis_id', 'analisis_pemda.id')
            ->join('identifikasi_pemda', 'analisis_pemda.identifikasi_id', 'identifikasi_pemda.id')
            ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', 'sasaran_pemda.id')
            ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', 'tbl_baganrisiko.id')
            ->get();
      return view('userpemda1.rtppemda1.transaksi', compact('rtp'));
    }

    public function cetakRTP()
    {
        $rtp = DB::table('rtp_pemda')
            ->select('rtp_pemda.id as id', 'sasaran_pemda.nama_sasaran as nama_sasaran', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'analisis_pemda.tingkat_risiko as tingkat_risiko_analisis', 'rtp_pemda.rtp_tambah as rtp_tambah', 'rtp_pemda.jadwal as jadwal', 'rtp_pemda.penanggungjawab as penanggungjawab', 'rtp_pemda.kemungkinan_id as kemungkinan_id', 'rtp_pemda.dampak_id as dampak_id', 'rtp_pemda.tingkat_risiko as tingkat_risiko', 'rtp_pemda.opsi as opsi')

            ->join('analisis_pemda', 'analisis_pemda.id', 'rtp_pemda.analisis_id')
            ->join('identifikasi_pemda', 'identifikasi_pemda.id', 'analisis_pemda.identifikasi_id')
            ->join('sasaran_pemda', 'identifikasi_pemda.sasaran_id', 'sasaran_pemda.id')
            ->join('tbl_baganrisiko', 'identifikasi_pemda.risiko_id', 'tbl_baganrisiko.id')
            ->get();

        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('userpemda1.rtppemda1.cetak',  compact('rtp', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('rtp_pemda.pdf', array('Attachment' => false));
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
        $a = new RtpPemda();
        $a->analisis_id = $request['analisis_id'];
        $a->rtp_tambah = $request['rtp_tambah'];
        $a->jadwal = $request['jadwal'];
        $a->penanggungjawab = $request['penanggungjawab'];
        $a->kemungkinan_id = $request['kemungkinan_id'];
        $a->dampak_id = $request['dampak_id'];
        $a->tingkat_risiko = $request['tingkat_risiko'];
        $a->opsi = $request['opsi'];
        $a->save();
        return redirect()->route('transRtpPemda');
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
        $this->data['jadwal'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $this->data['kemungkinan'] = Kemungkinan::pluck('nama_kemungkinan', 'id');
        $this->data['dampak'] = Dampak::pluck('nama_dampak', 'id');
        $this->data['opsi'] = ['Ya', 'Tidak'];
        $this->data['rtp'] = DB::table('rtp_pemda')->find($id);
        return view('userpemda1.rtppemda1.edit', $this->data);
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
        $a = RtpPemda::find($id);
        $a->rtp_tambah = $request['rtp_tambah'];
        $a->jadwal = $request['jadwal'];
        $a->penanggungjawab = $request['penanggungjawab'];
        $a->kemungkinan_id = $request['kemungkinan_id'];
        $a->dampak_id = $request['dampak_id'];
        $a->tingkat_risiko = $request['tingkat_risiko'];
        $a->opsi = $request['opsi'];
        if ($a->update()) {
            return redirect()->route('transRtpPemda', compact('a'));
        };
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
        $a = RtpPemda::find($id);
        $a->delete();
        return redirect()->route('rtppemda1.index');
    }
}
