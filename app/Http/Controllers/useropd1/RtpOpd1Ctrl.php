<?php

namespace App\Http\Controllers\useropd1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\adminpemda\OPD;
use App\Models\adminopd\KegiatanOPD;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use App\Models\useropd1\RtpOpd;
use PDF;
use App\Models\adminpemda\Pemda;


class RtpOpd1Ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $rtp = DB::table('analisis_opd')
              ->select('analisis_opd.id',
              'tbl_baganrisiko.nama_risiko', 'analisis_opd.tingkat_risiko',
              'sasaran_opd.nama_sasaran',
              'tbl_kategori.selera_risiko', 'rtp_opd.tingkat_risiko as tingkat_risiko_rtp')
              ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', 'identifikasi_opd.id')
              ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', '=', 'sasaran_opd.id')
              ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', 'tbl_baganrisiko.id')
              ->join('tbl_kategori', 'tbl_baganrisiko.kategori_id', 'tbl_kategori.id')
              ->leftjoin('rtp_opd', 'analisis_opd.id', 'rtp_opd.analisis_id')
              ->whereColumn('analisis_opd.tingkat_risiko', '>=', 'tbl_kategori.selera_risiko')
              ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
              ->get();
      return view('useropd1.rtpopd1.index', compact('rtp'));
    }

    public function cetakRTP()
    {
        $rtp = DB::table('rtp_opd')
            ->select('rtp_opd.id as id', 'sasaran_opd.nama_sasaran as nama_sasaran', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'analisis_opd.tingkat_risiko as tingkat_risiko_analisis', 'rtp_opd.rtp_tambah as rtp_tambah', 'rtp_opd.jadwal as jadwal', 'rtp_opd.penanggungjawab as penanggungjawab', 'rtp_opd.kemungkinan_id as kemungkinan_id', 'rtp_opd.dampak_id as dampak_id', 'rtp_opd.tingkat_risiko as tingkat_risiko', 'rtp_opd.opsi as opsi')

            ->join('analisis_opd', 'analisis_opd.id', 'rtp_opd.analisis_id')
            ->join('identifikasi_opd', 'identifikasi_opd.id', 'analisis_opd.identifikasi_id')
            ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', 'sasaran_opd.id')
            ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', 'tbl_baganrisiko.id')
            ->get();
        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('useropd1.rtpopd1.cetak',  compact('rtp', 'nama', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('rtp_opd.pdf', array('Attachment' => false));
        exit(0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idopd)
    {
      $this->data['kegiatan'] = DB::table('analisis_opd')->where('id', $idopd)->first();
      $this->data['jadwal'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      $this->data['kemungkinan'] = DB::table('ref_kemungkinan')->pluck('nama_kemungkinan', 'id');
      $this->data['dampak'] = DB::table('ref_dampak')->pluck('nama_dampak', 'id');
      $this->data['opsi'] = ['Ya', 'Tidak'];
      return view('useropd1.rtpopd1.create', $this->data);
    }

    public function transaksiRTP()
    {
      $rtp = DB::table('rtp_opd')
            ->select('rtp_opd.id as id','sasaran_opd.nama_sasaran as nama_sasaran', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'analisis_opd.tingkat_risiko as tingkat_risiko_analisis', 'rtp_opd.rtp_tambah as rtp_tambah', 'rtp_opd.jadwal as jadwal', 'rtp_opd.penanggungjawab as penanggungjawab', 'rtp_opd.tingkat_risiko as tingkat_risiko_rtp', 'rtp_opd.opsi as opsi')

            ->join('analisis_opd', 'rtp_opd.analisis_id', 'analisis_opd.id')
            ->join('identifikasi_opd', 'analisis_opd.identifikasi_id', 'identifikasi_opd.id')
            ->join('sasaran_opd', 'identifikasi_opd.sasaran_id', 'sasaran_opd.id')
            ->join('tbl_baganrisiko', 'identifikasi_opd.risiko_id', 'tbl_baganrisiko.id')
            ->where('identifikasi_opd.opd_id', Auth::user()->opd_id)
            ->get();
      return view('useropd1.rtpopd1.transaksi', compact('rtp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $save = DB::table('rtp_opd')
          ->insert([
            'analisis_id' 	     => Request::get('analisis_id'),
            'rtp_tambah' 	       => Request::get('rtp_tambah'),
            'jadwal'		         => Request::get('jadwal'),
            'penanggungjawab'    => Request::get('penanggungjawab'),
            'kemungkinan_id'	 	 => Request::get('kemungkinan'),
            'dampak_id'	 				 => Request::get('dampak'),
            'tingkat_risiko'	 	 => Request::get('tingkat_risiko'),
            'opsi'	 				     => Request::get('opsi'),
            ]);

        if ($save) {
            return redirect()->route('rtpopd1.index');
        };
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
        $this->data['kemungkinan'] = DB::table('ref_kemungkinan')->pluck('nama_kemungkinan', 'id');
        $this->data['dampak'] = DB::table('ref_dampak')->pluck('nama_dampak', 'id');
        $this->data['opsi'] = ['Ya', 'Tidak'];
        $this->data['rtp'] = DB::table('rtp_opd')->find($id);
        return view('useropd1.rtpopd1.edit', $this->data);
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
        $a = RtpOpd::find($id);
        $a->rtp_tambah = $request['rtp_tambah'];
        $a->jadwal = $request['jadwal'];
        $a->penanggungjawab = $request['penanggungjawab'];
        $a->kemungkinan_id = $request['kemungkinan_id'];
        $a->dampak_id = $request['dampak_id'];
        $a->tingkat_risiko = $request['tingkat_risiko'];
        $a->opsi = $request['opsi'];
        if ($a->update()) {
            return redirect()->route('tranRtpOpd', compact('a'));
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
      $a = RtpOpd::find($id);
        $a->delete();
        return redirect()->route('rtpopd1.index');
    }
}
