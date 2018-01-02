<?php

namespace App\Http\Controllers\opdkegiatan1;


use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\adminpemda\OPD;
use App\Models\adminopd\KegiatanOPD;
use PDF;
use Illuminate\Http\Request;
use App\Models\opdkegiatan1\RtpKegiatan;
use App\Models\adminpemda\Pemda;


class RtpKegiatanCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rtp = DB::table('analisis_kegiatan')
                ->select('analisis_kegiatan.id as id', 'kegiatan_opd.nama_kegiatan as nama_kegiatan',
                'tbl_baganrisiko.nama_risiko as nama_risiko', 'analisis_kegiatan.tingkat_risiko as tingkat_risiko_analisis',
                'tbl_kategori.selera_risiko as selera_risiko', 'rtp_kegiatan.tingkat_risiko as tingkat_risiko')

                ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', 'identifikasi_kegiatan.id')
                ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', 'tbl_baganrisiko.id')
                ->join('tbl_kategori', 'tbl_baganrisiko.kategori_id', 'tbl_kategori.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', 'kegiatan_opd.id')

                ->leftjoin('rtp_kegiatan', 'analisis_kegiatan.id', 'rtp_kegiatan.analisis_id')

                ->whereColumn('analisis_kegiatan.tingkat_risiko', '>=', 'tbl_kategori.selera_risiko')
                ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                ->get();
        return view('opdkegiatan1.rtpkegiatan1.index', compact('rtp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idrtp)
    {
        $this->data['kegiatan'] = DB::table('analisis_kegiatan')->where('id', $idrtp)->first();
        $this->data['jadwal'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $this->data['kemungkinan'] = DB::table('ref_kemungkinan')->pluck('nama_kemungkinan', 'id');
        $this->data['dampak'] = DB::table('ref_dampak')->pluck('nama_dampak', 'id');
        $this->data['opsi'] = ['Ya', 'Tidak'];
        return view('opdkegiatan1.rtpkegiatan1.create', $this->data);

    }

    public function transaksiRTP()
    {
      $rtp = DB::table('rtp_kegiatan')
            ->select('rtp_kegiatan.id as id','kegiatan_opd.nama_kegiatan as nama_kegiatan', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'analisis_kegiatan.tingkat_risiko as tingkat_risiko_analisis', 'rtp_kegiatan.rtp_tambah as rtp_tambah', 'rtp_kegiatan.jadwal as jadwal', 'rtp_kegiatan.penanggungjawab as penanggungjawab', 'rtp_kegiatan.tingkat_risiko as tingkat_risiko_rtp', 'rtp_kegiatan.opsi as opsi')

            ->join('analisis_kegiatan', 'rtp_kegiatan.analisis_id', 'analisis_kegiatan.id')
            ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', 'identifikasi_kegiatan.id')
            ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', 'kegiatan_opd.id')
            ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', 'tbl_baganrisiko.id')
            ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
            ->get();
      return view('opdkegiatan1.rtpkegiatan1.transaksi', compact('rtp'));

    }

    public function cetakRTP()
    {
        $rtp = DB::table('rtp_kegiatan')
            ->select('rtp_kegiatan.id as id', 'kegiatan_opd.nama_kegiatan as nama_kegiatan', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'analisis_kegiatan.tingkat_risiko as tingkat_risiko_analisis', 'rtp_kegiatan.rtp_tambah as rtp_tambah', 'rtp_kegiatan.jadwal as jadwal', 'rtp_kegiatan.penanggungjawab as penanggungjawab', 'rtp_kegiatan.kemungkinan_id as kemungkinan_id', 'rtp_kegiatan.dampak_id as dampak_id', 'rtp_kegiatan.tingkat_risiko as tingkat_risiko', 'rtp_kegiatan.opsi as opsi')

            ->join('analisis_kegiatan', 'analisis_kegiatan.id', 'rtp_kegiatan.analisis_id')
            ->join('identifikasi_kegiatan', 'identifikasi_kegiatan.id', 'analisis_kegiatan.identifikasi_id')
            ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', 'kegiatan_opd.id')
            ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', 'tbl_baganrisiko.id')
            ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
            ->get();
        $nama = OPD::select('nama_opd')->where('id', Auth::user()->opd_id)->first();
        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('opdkegiatan1.rtpkegiatan1.CetakRTP',  compact('rtp', 'nama', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('rtp.pdf', array('Attachment' => false));
        exit(0);
    }

    public function chartRTP()
    {
        $chartRTP = DB::table('rtp_kegiatan')
            ->select('kegiatan_opd.nama_kegiatan', 'tbl_baganrisiko.nama_risiko', 'rtp_kegiatan.tingkat_risiko')
            ->join('analisis_kegiatan', 'analisis_kegiatan.id', 'rtp_kegiatan.analisis_id')
            ->join('identifikasi_kegiatan', 'identifikasi_kegiatan.id', 'analisis_kegiatan.identifikasi_id')
            ->join('kegiatan_opd', 'kegiatan_opd.id', 'identifikasi_kegiatan.kegiatan_id')
            ->join('tbl_baganrisiko', 'tbl_baganrisiko.id', 'identifikasi_kegiatan.risiko_id')
            ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
            ->get();
        return view('opdkegiatan1.rtpkegiatan1.chartRTP', compact('chartRTP'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*
      $save = DB::table('rtp_kegiatan')
          ->insert([
            'analisis_id'    => Request::get('analisis_id'),
            'rtp_tambah'      => Request::get('rtp_tambah'),
            'jadwal'           => Request::get('jadwal'),
            'penanggungjawab'   => Request::get('penanggungjawab'),
            'kemungkinan_id'          => Request::get('kemungkinan'),
            'dampak_id'         => Request::get('dampak'),
            'tingkat_risiko'          => Request::get('tingkat_risiko'),
            'opsi'          => Request::get('opsi'),
            ]);

        if ($save) {
            return redirect()->route('rtpkegiatan1.index');
        };

        */

        $a = new RtpKegiatan;
        $a->analisis_id = $request['analisis_id'];;
        $a->rtp_tambah = $request['rtp_tambah'];
        $a->jadwal = $request['jadwal'];
        $a->penanggungjawab = $request['penanggungjawab'];
        $a->kemungkinan_id = $request['kemungkinan'];
        $a->dampak_id = $request['dampak'];
        $a->tingkat_risiko = $request['tingkat_risiko'];
        $a->opsi = $request['opsi'];
        if ($a->save()) {
            return redirect()->route('rtpkegiatan1.index');
        }
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
        $this->data['rtp'] = DB::table('rtp_kegiatan')->find($id);
        return view('opdkegiatan1.rtpkegiatan1.edit', $this->data);
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
        $a = RtpKegiatan::find($id);
        $a->rtp_tambah = $request['rtp_tambah'];
        $a->jadwal = $request['jadwal'];
        $a->penanggungjawab = $request['penanggungjawab'];
        $a->kemungkinan_id = $request['kemungkinan_id'];
        $a->dampak_id = $request['dampak_id'];
        $a->tingkat_risiko = $request['tingkat_risiko'];
        $a->opsi = $request['opsi'];
        if ($a->update()) {
            return redirect()->route('trans_rtp', compact('a'));
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
        $a = RtpKegiatan::find($id);
        $a->delete();
        return redirect()->route('rtpkegiatan1.index');
    }
}
