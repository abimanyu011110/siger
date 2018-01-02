<?php

namespace App\Http\Controllers\opdkegiatan1;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\opdkegiatan1\IdentifikasiKegiatan;
use App\Models\opdkegiatan1\Dampak;
use App\Models\opdkegiatan1\Kemungkinan;
use App\Models\opdkegiatan1\AnalisisKegiatan;
use App\Http\Requests\opdkegiatan1\reqAnalisisKegiatan;
use App\Models\adminpemda\OPD;
use App\Models\adminopd\SasaranOPD;
use App\Models\adminopd\KegiatanOPD;
use App\Models\adminpemda\Pemda;
use PDF;
use Illuminate\Http\Request;


class AnalisisKegiatanCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $analisis = DB::table('identifikasi_kegiatan')
                ->select('identifikasi_kegiatan.id as id', 'tbl_opd.nama_opd as nama_opd',
                'sasaran_opd.nama_sasaran as nama_sasaran', 'program_opd.nama_program as nama_program',
                'kegiatan_opd.nama_kegiatan as nama_kegiatan',
                'identifikasi_kegiatan.periode as periode', 'tbl_baganrisiko.nama_risiko as nama_risiko',
                'kegiatan_opd.jabatan as pemilik_risiko','identifikasi_kegiatan.uraian as uraian',
                'identifikasi_kegiatan.sumber_risiko as sumber_risiko', 'identifikasi_kegiatan.kontrol as kontrol',
                 'identifikasi_kegiatan.penyebab as penyebab',
                'identifikasi_kegiatan.dampak as dampak', 'identifikasi_kegiatan.pengendalian as pengendalian',
                'identifikasi_kegiatan.sisa_risiko as sisa_risiko','analisis_kegiatan.tingkat_risiko')
                ->join('tbl_opd', 'identifikasi_kegiatan.opd_id', '=', 'tbl_opd.id')
                ->join('sasaran_opd', 'identifikasi_kegiatan.sasaran_id', '=', 'sasaran_opd.id')
                ->join('program_opd', 'identifikasi_kegiatan.program_id', '=', 'program_opd.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                ->leftjoin('analisis_kegiatan', 'identifikasi_kegiatan.id','analisis_kegiatan.identifikasi_id' )
                ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                ->where('identifikasi_kegiatan.sisa_risiko','Ada')
                ->groupBy('identifikasi_kegiatan.id')
                ->get();

        return view('opdkegiatan1.analisiskegiatan1.index', compact('analisis', 'nama_opd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

  public function transaksi()
     {
         $dt = DB::table('analisis_kegiatan')
                ->select('analisis_kegiatan.id as id','kegiatan_opd.nama_kegiatan as nama_kegiatan',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan_id',
                  'ref_dampak.id as dampak_id', 'analisis_kegiatan.tingkat_risiko')
                ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', '=', 'identifikasi_kegiatan.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                 ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_kegiatan.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_kegiatan.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                 ->where('identifikasi_kegiatan.sisa_risiko','Ada')
                 ->get();
        return view('opdkegiatan1.analisiskegiatan1.transaksi',compact('dt'));
    }


    public function create($idk)
    {

        $kegiatan = DB::table('identifikasi_kegiatan')->where('id', $idk)->first();
        $risiko = DB::table('identifikasi_kegiatan')
                ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                ->select('tbl_baganrisiko.nama_risiko','tbl_baganrisiko.id as id')
                ->where('identifikasi_kegiatan.opd_id',Auth::user()->opd_id)
                ->get()
                ->pluck('nama_risiko','id');
        $kemungkinan = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $dampak = Dampak::pluck('nama_dampak', 'id');
        return view('opdkegiatan1.analisiskegiatan1.create', compact('risiko','kemungkinan','dampak','kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $srt = new AnalisisKegiatan;
        $srt->identifikasi_id = $request['identifikasi_id'];
        $srt->kemungkinan_id = $request['kemungkinan_id'];
        $srt->dampak_id = $request['dampak_id'];
        $srt->tingkat_risiko = $request['tingkat_risiko'];
        $srt->save();
        return redirect()->route('transaksi');
    }

    public function pilihPeriode($id)
    {
        $periode = DB::table('identifikasi_kegiatan')
                ->select('identifikasi_kegiatan.periode', 'identifikasi_kegiatan.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                ->where('identifikasi_kegiatan.kegiatan_id', $id)
                ->where('identifikasi_kegiatan.sisa_risiko', '=', 'Ada')
                ->get()
                ->pluck('periode', 'id');
        return json_encode($periode);
    }

    public function pilihRisiko($id)
    {
        $risiko =  DB::table('identifikasi_kegiatan')
                        ->select('tbl_baganrisiko.nama_risiko', 'tbl_baganrisiko.id')
                        ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                        ->where('identifikasi_kegiatan.kegiatan_id', $id)
                        ->where('identifikasi_kegiatan.sisa_risiko', '=', 'Ada')
                        ->get()
                        ->pluck('nama_risiko', 'id');

        return json_encode($risiko);
    }

    public function googlechart()

    {
        $chart = DB::table('analisis_kegiatan')
                ->select('analisis_kegiatan.id as id','kegiatan_opd.nama_kegiatan as nama_kegiatan',
                 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan',
                  'ref_dampak.id as dampak', 'analisis_kegiatan.tingkat_risiko')
                ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', '=', 'identifikasi_kegiatan.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                 ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                 ->join('ref_kemungkinan', 'analisis_kegiatan.kemungkinan_id', '=', 'ref_kemungkinan.id')
                 ->join('ref_dampak', 'analisis_kegiatan.dampak_id', '=', 'ref_dampak.id')
                 ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                 ->where('identifikasi_kegiatan.sisa_risiko','Ada')
                 ->orderBy('analisis_kegiatan.tingkat_risiko', 'desc')
                 ->limit(10)
                 ->get();

        $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
        return view('opdkegiatan1.analisiskegiatan1.googlechart', compact('chart', 'nama_opd'));
    }

    public function CetakAnalisis()
    {
        $analisis = DB::table('analisis_kegiatan')
                ->select('analisis_kegiatan.id as id', 'kegiatan_opd.nama_kegiatan as nama_kegiatan', 'tbl_baganrisiko.nama_risiko as nama_risiko', 'ref_kemungkinan.nilai as kemungkinan', 'ref_dampak.nilai as dampak', 'analisis_kegiatan.tingkat_risiko as tingkat_risiko')

                ->join('identifikasi_kegiatan', 'analisis_kegiatan.identifikasi_id', 'identifikasi_kegiatan.id')
                ->join('kegiatan_opd', 'identifikasi_kegiatan.kegiatan_id', '=', 'kegiatan_opd.id')
                ->join('tbl_baganrisiko', 'identifikasi_kegiatan.risiko_id', '=', 'tbl_baganrisiko.id')
                ->join('ref_kemungkinan', 'analisis_kegiatan.kemungkinan_id', '=', 'ref_kemungkinan.id')
                ->join('ref_dampak', 'analisis_kegiatan.dampak_id', '=', 'ref_dampak.id')
                ->where('identifikasi_kegiatan.opd_id', Auth::user()->opd_id)
                ->orderBy('analisis_kegiatan.id', 'asc')
                ->get();

        $nama_opd = OPD::where('id', Auth::user()->opd_id)->first();
        $nama_pemda = Pemda::where('id', 1)->first();
        $pdf = PDF::loadView('opdkegiatan1.analisiskegiatan1.CetakAnalisis',  compact('analisis', 'nama_opd', 'nama_pemda'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('analisis.pdf', array('Attachment' => false));
        exit(0);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\ResponseS
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
        $this->data['kemungkinan'] = Kemungkinan::pluck( 'nama_kemungkinan', 'id');
        $this->data['dampak'] = Dampak::pluck('nama_dampak', 'id');
        $this->data['analisis'] = AnalisisKegiatan::find($id);
        return view('opdkegiatan1.analisiskegiatan1.edit', $this->data);
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
        $a = AnalisisKegiatan::find($id);
        $a->kemungkinan_id = $request['kemungkinan_id'];
        $a->dampak_id = $request['dampak_id'];
        $a->tingkat_risiko = $request['tingkat_risiko'];
        if ($a->update()) {
            return redirect()->route('transaksi', compact('a'));
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
        $a = AnalisisKegiatan::find($id);
        $a->delete();
        return redirect()->route('analisiskegiatan1.index');
    }
}
